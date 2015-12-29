<?php 
require_once('config.php');
if (array_key_exists('year', $_REQUEST)) { 
	$db = dbconnect();
	$year = $db->escape_string($_REQUEST['year']);
	$month = $db->escape_string($_REQUEST['month']);
	$day = $db->escape_string($_REQUEST['day']);
	$date = "$year-$month-$day";
	$days = $db->escape_string($_REQUEST['days']);
	$jurisdiction  = $db->escape_string($_REQUEST['jurisdiction']);
	$jurisdiction_select = "";
	$jurisdiction_where = " and jurisdiction_c = '$jurisdiction' ";
	if ($jurisdiction == 'all') { 
		$jurisdiction_select = ", jurisdiction_c as jurisdiction ";
		$jurisdiction_where = "";
	}

	$contact = $_REQUEST['contact'] == 1 ? ", a.phone_mobile as 'Phone 1', a.phone_work as 'Phone 2', a.email, support_person_c as 'Support Person', support_contact_c as 'Support Phone' " : "";
	$type = $_REQUEST['type'] == 'a' ? 'arrest_date' : 'first_appearance_date_c';
	$range = "$type = '$date'";
	if ($days > 1) {
		$range = "$type between '$date' and date_add('$date', interval ".($days-1)." day)";
	}
	$query = "select a.last_name, a.first_name, cant_attend_c as 'can\'t attend' $jurisdiction_select, booking_number_c, docket_c, citation_number,date_of_birth, first_appearance_date_c, next_hearing_time_c, support_needs_c as charges, concat(l.last_name, ', ', l.first_name) as lawyer $contact, bail_c as bail, case_status_c as 'case status', release_type_c as 'release type',  '' as Notes
	from legal_arrestees a join legal_arrestees_cstm on a.id = id_c left join legal_lawyers l on account_id = l.id
	where a.deleted = 0 and disposition_c = 'open' and first_appearance_date_c is not null
	and $range
	$jurisdiction_where
	order by str_to_date(first_appearance_date_c, '%Y-%m-%d %h:%i%s'), last_name, first_name";
	//and (jurisdiction_c = '$jurisdiction' or ('$jurisdiction' = 'A' and (arrest_city_c = 'Oakland' or arrest_city_c = 'Berkeley')) or ('$jurisdiction' = 'SF' and arrest_city_c = 'San Francisco'))
	$res = dbQuery($query);
	if ($res) { 
		if($_REQUEST['csv'] == 1) { 
			// send response headers to the browser
			header( 'Content-Type: text/csv' );
			header( "Content-Disposition: attachment;filename=\"Docket Sheet - $date.csv\"");
			$fp = fopen('php://output', 'w');
			$row = $res->fetch_assoc();
			if($row) { fputcsv($fp, array_keys($row)); }
			// reset pointer back to beginning
			$res->data_seek(0);
			while($row = $res->fetch_assoc()) {
			    fputcsv($fp, $row);
			}
			fclose($fp);
		} else {
			$info =  'Query successfully returned '.$res->num_rows.' rows.'; 
			echo exportHTML($res, "Docket Sheet for $date");
		}
	}
	exit;
} else {
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
   "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<title>Report Manager</title>
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
<body>
<h2>Docket Sheet Generator</h2>
<form style='text-align: center;'>
<input type='radio' name='type' value='c' checked='true'>Court Date <br/>
<input type='radio' name='type' value='a'> Arrest Date <br/>
Select a date and jurisdiction.
<br/>
<select id='month' name='month'>
	<option>01</option>
	<option>02</option>
	<option>03</option>
	<option>04</option>
	<option>05</option>
	<option>06</option>
	<option>07</option>
	<option>08</option>
	<option>09</option>
	<option>10</option>
	<option>11</option>
	<option>12</option>
</select> - 
<select id='day' name='day'>
	<option>01</option>
	<option>02</option>
	<option>03</option>
	<option>04</option>
	<option>05</option>
	<option>06</option>
	<option>07</option>
	<option>08</option>
	<option>09</option>
	<option>10</option>
	<option>11</option>
	<option>12</option>
	<option>13</option>
	<option>14</option>
	<option>15</option>
	<option>16</option>
	<option>17</option>
	<option>18</option>
	<option>19</option>
	<option>20</option>
	<option>21</option>
	<option>22</option>
	<option>23</option>
	<option>24</option>
	<option>25</option>
	<option>26</option>
	<option>27</option>
	<option>28</option>
	<option>29</option>
	<option>30</option>
	<option>31</option>
</select> - 
<select id='year' name='year'>
	<option>2019</option>
	<option>2018</option>
	<option>2017</option>
	<option>2016</option>
	<option>2015</option>
	<option selected='selected'>2014</option>
</select>
<br />
Jurisdiction: <select name='jurisdiction'>
	<option value='all'>All Jurisdictions</option>
	<option value='A'>Alameda</option>
	<option value='SF'>San Francisco</option>
</select>
<br/>
<input type='input' name='days' value='1' style='width:20px'> Days of court dates
<br/>
<input type='checkbox' name='contact' value='1'>Include contact info (be nice with this!)
<br/>
<input type='checkbox' name='csv' value='1'>Download as CSV (spreadsheet)
<br/>
<br/>
<input type='submit' value='Generate Docket Sheet'>
</form>
  <script>
    var pad = function(x) {
      if (x.length = 1) { 
        x = '0'+x; 
      }
      return x;
    }
    var d = new Date();
    $('year').value = d.getFullYear();
    $('month').value = pad(d.getMonth()+1);
    $('day').value = pad(d.getDate());
  </script>

</body></html>
<?php 

}
function exportHTML($res,$name) {
	global $month;
	global $year;
	global $day;
	global $days;
	global $jurisdiction;
?>  <html><head>
	<title><?php echo $name; ?></title>
	<link rel='stylesheet' href='style.css' media="all" type='text/css'/>
	<link rel="stylesheet" type="text/css" media="all" href="js/tablesort/style.css" />
	<script src="js/prototype.js" type="text/javascript"></script>
	<script src="js/scriptaculous.js" type="text/javascript"></script>
	<script type="text/javascript" src="js/tablesort/fastinit.js"></script>
	<script type="text/javascript" src="js/tablesort/tablesort.js"></script>	


	</head><body><h2><?php echo $name; ?></h2>
<?php
	echo "<h4>(".$res->num_rows." records)</h4><br/>";
	echo "<div style='text-align: center;'> <a href='dockets.php?year=$year&day=$day&month=$month&jurisdiction=$jurisdiction&csv=1&days=$days'>Download as CSV file (spreadsheet)</a></div><br/>";
	echo "<table class='sortable' style='width: 98%;' id='querytable'><thead><tr>";
	
	$x = 0;
	#foreach (array_keys($res->fetch_array(MYSQLI_ASSOC)) as $key) {
	while ($info = $res->fetch_field()) {
		$x++;
		$key = $info->name;
		$type = $info->type;
		$key = preg_replace('/first_appearance/', 'next_hearing', $key);
		$key = preg_replace('/_c$/', '', $key);
		$key = preg_replace('/_/', ' ', $key);
		echo "<th id='$key' class='sortcol text'>$key</th>";
	}
		echo "</tr></thead>";
	$res->data_seek(0);
	while ($row = $res->fetch_row()) { 
		echo "<tr>";
		foreach ($row as $field) {
			echo "<td>$field</td>";
		}
		echo "</tr>";
	}	
	echo "</table>";
	echo "</html>";
	exit;
	return $output;
}
?>
