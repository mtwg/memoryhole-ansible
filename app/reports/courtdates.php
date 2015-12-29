<?php

require_once('config.php');
require_once('simpletest/browser.php');
require_once('simple_html_dom.php');
@ini_set('zlib.output_compression',0);
@ini_set('implicit_flush',1);
@ob_end_clean();
set_time_limit(0);
ob_implicit_flush(1);
session_write_close();
#dbQuery("update arrestees set jurisdiction_c = 'A' where jurisdiction_c = '-blank-' and arrest_city_c in ('Oakland', 'Dublin', 'Berkeley', 'Emeryville')");
#dbQuery("update arrestees set jurisdiction_c = 'SF' where jurisdiction_c = '-blank-' and arrest_city_c in ('San Francisco')");

$names = dbLookupArray("select id, first_name, last_name, docket_c, first_appearance_date_c from arrestees where disposition_c = 'open' and jurisdiction_c = 'A' and (first_appearance_date_c is null or first_appearance_date_c <= DATE_ADD(NOW(), interval 7 DAY)) order by last_name, first_name");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
   "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <title>Court Date Tool</title>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
  <link rel='stylesheet' href='style.css' type='text/css'/>
  <link rel="stylesheet" type="text/css" media="all" href="js/tablesort/style.css" />
  <script src="codepress/codepress.js" type="text/javascript"></script>
  <script src="js/prototype.js" type="text/javascript"></script>
  <script src="js/scriptaculous.js" type="text/javascript"></script>
  <script type="text/javascript" src="js/tablesort/fastinit.js"></script>
  <script type="text/javascript" src="js/tablesort/tablesort.js"></script>  
  <script type="text/javascript" src='lib.js'></script>
</head>
<body style=''>
<h2>Alameda County Upcoming Court Date Tool</h2>
<p style='width:60%; margin: auto;'>
This program looks up each person's name from our database and checks them against the alameda county court computer. 
If they have a hearing in the next 4 court days, they will appear in this list. 
It's also possible that people with the same or similiar names will appear, as well as non-protest-related cases.
 For those we have case numbers for, you can compare the two case numbers to verify the correct date.
 <br/><b>Note - this might take a bit</b>
<?php 
print "<br/><br/>Searching ".count($names)." names - <span id='count'>0</span>% complete</p></br/>";

$output = array();
$browser = &new SimpleBrowser();
$x = 1;
$fields = array('name', 'court_name', 'court_date', 'dept', 'hearing_type', 'docket', 'docket_link');
print "<table class='sortable'><tr><th>".implode("</th><th>", $fields)."</th><tr>";
$count = 0;
foreach($names as $name) {
  print "<script>document.getElementById('count').innerHTML = ".round($x/count($names)* 100).";</script>"; 
  //ob_flush();
  $x++;

  $browser->get('http://apps2.alameda.courts.ca.gov/findyourcourtdate/views/query-listing.aspx');
  $browser->setField('ctl00$ContentPlaceholder1$txtLastName', $name['last_name']);
  $browser->setField('ctl00$ContentPlaceholder1$rblSearchType','Find name beginning with letters entered');
  $browser->setField('ctl00$ContentPlaceholder1$rblSearchRange','Today plus the next four court dates');
  $browser->setField('ctl00$ContentPlaceholder1$txtFirstName',substr($name['first_name'], 0, 3));
  $browser->click('Search');
  
  $html = str_get_html($browser->getContent());
  if (strpos($html, 'No records found.') != false) { continue; }
  $table = $html->find('#ctl00_ContentPlaceholder1_gvCourt', 0);
  if (! $table) { continue; }
  foreach ($table->find('tr') as $row) {
    if ($row->getAttribute('valign') != 'top') { 
      continue; 
    }
    $outrow = array();
    $info = array();
    foreach($row->find('td') as $cell) {
      $info[] = $cell->plaintext;
    }
    $outrow['name'] = "$name[last_name], $name[first_name]<br>$name[docket_c] - $name[first_appearance_date_c] - <a href='../index.php?module=legal_arrestees&return_module=legal_arrestees&action=EditView&record=$name[id]' target='_blank'>DB Link</a>";
    $outrow['court_name'] = $info[0];
    $outrow['court_date'] = $info[1];
    $outrow['dept'] = $info[2];
    $outrow['hearing_type'] = $info[3];
    $outrow['docket'] = $info[4];
    $outrow['docket_link'] = "<a href='docketFinder.php?docketNumber=$info[4]&id=$name[id]' target='_blank'>Docket Finder Link</a>";
    if (strpos($outrow['hearing_type'], 'Civil') == false) {
      $style = '';
      if (!$name['docket_c'] || !$name['first_appearance_date_c']) { $style = "style='background:#c99;'"; }
      print "<tr $style>";
      foreach ($fields as $field) {
        print "<td>".$outrow[$field]."</td>";
      }     
      print "</tr>";
      $count++;
    }
  }
}
print "</table>";
if ($count == 0) {
  print "No names found";
}
// $table = tableize($output);
// $table = str_replace('<table', "<table class='sortable' ", $table);
// print "<br/>";
// print $table;

?>
</body></html>
<?php exit(); ?>
