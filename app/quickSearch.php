<?php
require_once('include/entryPoint.php');
global $db;
$results = array();


$name = $db->quote($_REQUEST['name']);
$module = $db->quote($_REQUEST['module']);
if ($module == 'legal_arrestees') {
        $query = "select id as value, concat(last_name, ', ', first_name, if(preferred_name != '', concat(' \(', preferred_name, '\)'), '')) as name, concat(arrest_date, ' - ', arrest_city_c) as details from legal_arrestees join legal_arrestees_cstm on id=id_c where (last_name like '%$name%' or first_name like '%$name%' or preferred_name like '%$name%') and deleted = 0  order by if(last_name like '$name%', 100, 0) + if(last_name like '%$name%', 10, 0) + if(first_name like '$name%', 20,0) + if(first_name like '%$name%', 5, 0) + if(preferred_name like '$name%', 50, 0) desc, last_name, first_name, details desc limit 10";
} elseif ($module == 'legal_events' || $module == 'legal_evidence') {
        $query = "select id as value, name, '' as details from $module where name like '%$name%' and deleted = 0  order by if(name like '$name%', 100, 0) + if(name like '%$name%', 10, 0) desc, name limit 10";
} else {
        $query = "select id as value, concat(last_name, ', ', first_name) as name, '' as details from $module where last_name like '%$name%' or first_name like '%$name%' and deleted = 0  order by if(last_name like '$name%', 100, 0) + if(last_name like '%$name%', 10, 0) + if(first_name like '$name%', 5,0) desc, last_name, first_name limit 10";
}
$res = $db->query($query);
while ($row = $res->fetch_assoc()) {
	$row['label'] = "$row[name]<span class='details'>$row[details]</span>";
	$results[] = $row;
}
if (! count($results)) {
	$results[] = array('name'=>'', 'label'=>'No results found', 'value'=>'NOTFOUND');
}
print json_encode($results);
?>

