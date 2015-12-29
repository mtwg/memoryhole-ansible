<?php
$skipauth = true;
chdir("../");
require_once('config.php');

set_include_path(get_include_path() . PATH_SEPARATOR . './lib/src/');
require_once 'lib/autoload.php';
$key = 'AIzaSyDmo3fPBJO17GfQdKNdzuO5b8MHl2ZIuZs';
$calId = 'dn6kgjk8avv7sve1vu9u5v9lj8@group.calendar.google.com';
$keyFile = '/home/nlg/googlekey.p12';
$service_account_name = '273209826267-nj5bgnmmdbi7uljdtr9kq3bmalr9gokr@developer.gserviceaccount.com';

$client = new Google_Client();
$client->setApplicationName("Legal Support");
$key = file_get_contents($keyFile);
$cred = new Google_Auth_AssertionCredentials(
  $service_account_name,
  array('https://www.googleapis.com/auth/calendar'),
  $key
);
$client->setAssertionCredentials($cred);

if($client->getAuth()->isAccessTokenExpired()) {    
   $client->getAuth()->refreshTokenWithAssertion($cred);    
} 

$service = new Google_Service_Calendar($client);

$datequery = "select concat(first_appearance_date_c, jurisdiction_c, afternoon) as id, first_appearance_date_c date, if(jurisdiction_c = 'A', 'AC', jurisdiction_c) jurisdiction, afternoon, sum(felony_charges) as fel, count(*) - sum(felony_charges) as mis from 
(select first_appearance_date_c, jurisdiction_c, if(next_hearing_time_c rlike '2[:00 ]*pm', 1, 0) as afternoon, felony_charges from arrestees where (disposition_c='open' or first_appearance_date_c <= CURDATE()) and first_appearance_date_c is not null and jurisdiction_c != '-blank-' ) a
group by first_appearance_date_c, jurisdiction_c, afternoon";
$dates = dbLookupArray($datequery); 

$existing = array();

//$client->setDeveloperKey($key);
$calendarList = $service->events->ListEvents($calId);
while(true) {
  foreach ($calendarList->getItems() as $calendarListEntry) {
    $id = $calendarListEntry['id'];
    //$service->events->delete($calId, $id);
    $title = $calendarListEntry->getSummary();
    $j = substr($title, 0, 2) == 'AC' ? 'A' : substr($title, 0, 2);
    $d = substr($calendarListEntry['start']['dateTime'], 0, 10);
    $t = substr($calendarListEntry['start']['dateTime'], 11, 2) == '09' ? 0 : 1;
    if (isset($existing[$d.$j.$t])) { 
      $service->events->delete($calId, $id);
    } else {
      $existing[$d.$j.$t] = $id;
    }
  }
  $pageToken = $calendarList->getNextPageToken();
  if ($pageToken) {
    $optParams = array('pageToken' => $pageToken);
    $calendarList = $service->events->ListEvents($calId, $optParams);
  } else {
    break;
  }
}

foreach($dates as $date) {
  addDate($date);
}
foreach($existing as $id) {
  $service->events->delete($calId, $id);
  continue;
  $event = $service->events->get($calId, $id);
  $j = $event->getSummary();
  $j = substr($j, 0, 2);
  $event->setSummary("$j - (empty)");
  $event = $service->events->update($calId, $id, $event);
}
#print_r($existing);

//addDate('2014-12-26', 12);
function addDate($date) { 
  global $service;
  global $calId;
  global $existing;

  $time = $date['afternoon'] ? '14' : '09';
  $event = new Google_Service_Calendar_Event();
  $id = isset($existing[$date['id']]) ? $existing[$date['id']] : false;
  $time_test = $date['afternoon'] ? "" : 'NOT';
  #print $date['id'];
  $details = join(fetchCol("
SELECT 
    CONCAT('*', SUBSTRING(a.first_name, 1, 1),
      SUBSTRING(a.last_name, 1, 1),
      if (account_id != '', 
        concat(
          ' (',
          if(l.last_name is not NULL, l.last_name, ''),
          ', ',
          if(l.first_name is not null, l.first_name, ''),
          ') '
        ), ''
      ),
      ': ',
      a.support_needs_c
      ) AS info
FROM
    arrestees a LEFT JOIN legal_lawyers l ON account_id = l.id
WHERE
    first_appearance_date_c = '$date[date]'
        AND jurisdiction_c = IF('$date[jurisdiction]' = 'SF', 'SF', 'A')
        AND if(next_hearing_time_c $time_test rlike '2[:00 ]*pm', 1, 0)
GROUP BY a.id    
   "), "\n"); 
    //SELECT 
    //concat(l.last_name, ', ', l.first_name, ': ', sum(felony_charges), 'F/', (count(*) - sum(felony_charges)), 'M: ',
    //  group_concat( concat( substring(a.first_name, 1, 1), substring(a.last_name, 1, 1), if(felony_charges, '*', ''), ': ', a.charges_c))
   // )
    //as info FROM arrestees a join legal_lawyers l on account_id = l.id where first_appearance_date_c = '$date[date]' and jurisdiction_c = if('$date[jurisdiction]' = 'SF', 'SF', 'A') and next_hearing_time_c rlike '2[:00 ]*pm' group by account_id"), "\n");
  $notes = "";
  if($id) { 
    $event = $service->events->get($calId, $id);
    $notes = preg_replace("/.* line====!/ms", "", $event->getDescription()); 
    unset($existing[$date['id']]);
  } else {
    $start = new Google_Service_Calendar_EventDateTime();
    $start->setDateTime($date['date'].'T'.$time.':00:00.000-08:00');
    $event->setStart($start);
    $end = new Google_Service_Calendar_EventDateTime();
    $end->setDateTime($date['date'].'T'.($time+1).':00:00.000-08:00');
    $event->setEnd($end);
  }
  $event->setSummary("$date[jurisdiction] - $date[mis] Mis. $date[fel] Fel.");
  $event->setDescription("$details\n!====Don't edit above this line====!$notes");
  if($id) { 
    $event = $service->events->update($calId, $id, $event);
  } else {
    $event = $service->events->insert($calId, $event);
  }
  return $event->getId();
}
