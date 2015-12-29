<?php 
require_once('config.php');
$db = dbconnect();
$action = isset($_REQUEST['action']) ? $_REQUEST['action'] : '';
$error = "";
$message = "";
$info = "";
if ($action == 'editquery') {
	if ($_POST[query_id] > 1) {
		$fields = fetchRow('select * from queries where query_id='.$_POST[query_id]);	
		$query_id = $fields[0];
		$name = $fields[1];
		$description = $fields[2];
		$query = $fields[3];
	}
	editQuery($name, $description, $query, $query_id) ;
	exit;	
} else if ($action == 'delete') {
	$res = dbQuery('delete from queries where query_id='.$_GET[query_id]);	
	if ($db->affected_rows >= 1) { 
		$info = 'Query deleted.';
	} else { $error = "Unable to delete query: <br/> $error"; }
} else if ($action == 'copyquery') {
	$res = dbQuery("insert into queries select null, concat(b.name, '_copy'), b.description, b.query, NOW(), NULL, NULL from queries b where b.query_id = $_GET[query_id]");
	if ($res) { $info = "Query copied."; }
} else if ($action == 'savequery') {
	foreach (array('name', 'description', 'query') as $field) {
		//$_POST[$field] = "'".$db->real_escape_string(stripslashes(urldecode($_POST[$field])))."'";
		$_POST[$field] = "'".$db->real_escape_string($_POST[$field])."'";
	}	
	if ($_POST['query_id'] > 1) {
		$res = dbQuery("update queries set name=$_POST[name], description=$_POST[description], query=$_POST[query], query_id=$_POST[query_id] where query_id=".$_POST['query_id']);
		$query_id = $_POST['query_id'];
	} else {
		$res = dbQuery("insert into queries  (name, description, query, created) values($_POST[name], $_POST[description], $_POST[query], NOW())");
		$query_id = $db->insert_id;
	}
	if ($db->affected_rows >= 1) { 
		$info = "Query saved";
	} 
} else if ($action == 'runquery') {
	$query = fetchRow("select query,name from queries where query_id=".$_REQUEST['query_id']);
	$res = dbQuery($query[0]);
	if ($res) { 
		$info =  'Query successfully returned '.$res->num_rows.' rows.'; 
		
		$output = exportHTML($res, $query[1]);
		//$output = exportTSV($res);
		#$info.= "<pre>".str_replace("\n", '<br/>', $output)."</pre>";
		$res = dbQuery('update queries set executed=NOW() where query_id='.$_REQUEST[query_id]);
		$executed =fetchItem('select executed from queries where query_id = '.$_REQUEST[query_id]);
	}
	echo $output;
	echo "error = \"$error\"; info=\"$info\"; executed=\"".str_replace(' ', '<br/>', $executed)."\";";
	exit;
} else if ($action == 'csv') {
	$query = fetchRow("select query,name from queries where query_id=".$_REQUEST['query_id']);
	$result = dbQuery($query[0]);
	if ($result) { 
		// send response headers to the browser
		header( 'Content-Type: text/csv' );
		header( 'Content-Disposition: attachment;filename="'.$query[1].'.csv"');
		$fp = fopen('php://output', 'w');
		$row = $result->fetch_assoc();
		if($row) { fputcsv($fp, array_keys($row)); }
		// reset pointer back to beginning
		$result->data_seek(0);
		while($row = $result->fetch_assoc()) {
		    fputcsv($fp, $row);
		}
		fclose($fp);
	}
	exit;
}
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
	<script type="text/javascript">
	function setup() {
		var error = "<?php echo str_replace('"', '\"', $error); ?>";
		var info = "<?php echo str_replace('"', '\"', $info); ?>";
		showInfo(error, 1);
		showInfo(info, 0);
		pointers = document.getElementsByClassName('pointer');
		Event.observe($('querylist'), 'mousemove', mousemove);
		Event.observe($('newQuery'), 'mousemove', mousemove);
		for(var point in pointers) {
			var elem = pointers[point];
			var alt = elem.alt;
			if (alt) {
				Event.observe(elem, 'mouseover', showTooltip.bindAsEventListener(alt, alt));
				Event.observe(elem, 'mouseout', hideTooltip);
			}
		} 
	}
	</script>
</head>
<body onload='setup();'>
<h2>Report Manager</h2>
<div style='text-align: right; margin: 0px auto; width:80%;' ><a href='database.txt'>Table Definition Info</a></div>
<div id='tooltip' style='padding: 3px; z-index: 100; position: absolute; visibility: hidden; background-color: white; top: 0px; left: 0px; filter:alpha(opacity=70);-moz-opacity:.70;opacity:.70; font-weight: bold; font-size: .8em; border: 1px solid black;'></div>
<div id='message'>
<div id='progress'><img src='icons/loading.png' alt='Loading' /> Query is running...<br/><img src='icons/progress_bar.gif' alt='Progress' /></div>
<div id='error'><img src='icons/error.png' alt='Error' /> An error occured: <div id='errorstring'></div></div>
<div id='info'><img src='icons/info.png' alt='Information' /> <div id='infostring'></div></div>
</div>
<?php
if ($action != 'editquery') {

?><div id='newQuery'><span class='button pointer' id='new_query_span' onclick="showDetails(); "><img height='24' src='icons/new.png' alt='New Query' /> <span>Create New Query</span></span></div>
<?php 
getQueryList();
}
 ?>

</body>
</html>

<?php 

function getQueryList() {
	?>
	<div id='querylist'>
	<table class='sortable' id='querytable'>
		<thead>
			<tr><th>Name</th><th>Description</th><th>Created</th><th>Modified</th><th>Executed</th><th></th></tr>
		</thead>
		<tbody>
	<?php $queries = dbLookupArray("select * from queries order by modified desc"); 
	foreach($queries as $storedquery) {
		$query_id =$storedquery['query_id'];
		echo "<tr id='row_$query_id'>
			<td id='name_$query_id'>
				<img class='pointer' onclick='showDetails($query_id);' onmouseover='showTooltip(\"Edit this query\");' onmouseout='hideTooltip();' src='icons/edit.png' alt='Edit this query' />
				<!--<div class='queryname pointer' onclick='showDetails($query_id);'>$storedquery[name]</div>-->
				<div class='queryname pointer'><a target='_new' href='index.php?query_id=$query_id&action=runquery'>$storedquery[name]</a></div>
			</td>
			<td id='description_$query_id'>$storedquery[description]</td>
			<td id='created_$query_id'>".str_replace(' ', '<br/>', $storedquery['created'])."</td>
			<td id='modified_$query_id'>".str_replace(' ', '<br/>', $storedquery['modified'])."</td>
			<td id='executed_$query_id'>".str_replace(' ', '<br/>', $storedquery['executed'])."</td>
			<td style='white-space: nowrap;' id='controls_$query_id'><a href='index.php?action=delete&amp;query_id=$query_id'><img class='pointer' src='icons/delete.png' alt='Delete this query'/></a><a href='index.php?action=copyquery&amp;query_id=$query_id'><img class='pointer' src='icons/copy.png' alt='Copy this query' /></a>
<a href='index.php?query_id=$query_id&action=csv' target='_csv'><img class='pointer' src='icons/edit.png' alt='Download as CSV' /></a>
<a target='_new' href='index.php?query_id=$query_id&action=runquery'><img class='pointer' src='icons/run.png' alt='Run this query' /></a>
</td>
			</tr>";
	}
	?>
		</tbody>
	</table>
	</div>
<?php
}

function exportHTML($res,$name) {
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
		echo "<th class='sortcol text'>$key</th>";
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

function exportTSV($res) {
	while ($row = $res->fetch_row()) { 
		foreach ($row as $$field) {
			$field = str_replace('"', '\"', $field);
		}
		$output.= join("\t", $row)."\n";
	}	
	return $output;
}

function editQuery($name, $description, $query, $query_id) {
	?>
	<div id='editquery'>
	<form name='editquery' method='post' action='index.php'>
	<div id='qleft'><span class='qelement'>Query Name: </span><input name='name' value="<?php echo $name; ?>" />
	<br/><br/><br/><img class='pointer' onmouseover='showTooltip("Toggle Fancy Editor");' onmouseout='hideTooltip();' onclick='code.toggleEditor();' src='icons/editor.png' alt='Toggle Fancy Editor'/>
	</div>
	<div id='qright'><span class='qelement'>Description: </span><textarea style='width: 70%;' rows='4' name='description'><?php echo $description; ?></textarea></div>
	<div style='clear: both;'>
	<textarea style='width: 100%;' rows='10' id='code' name='queryedit' class="codepress sql linenumbers-off autocomplete-on"><?php echo $query; ?></textarea>
	</div>
	<input id='query' name='query' type='hidden'/>
	<div id='suggest'></div>
	<div style='margin: 10px;'><span class='button pointer' onclick="$('query').value = code.getCode(); document.editquery.submit(); "><img height='24' src='icons/save.png' /> <span>Save Query</span></span>
	<span class='button pointer' onclick="showDetails(<?php echo $query_id; ?>); "><img height='24' src='icons/cancel.png' />Cancel</span></div>
	<input name='query_id' type='hidden' value="<?php echo $query_id; ?>"/>
	<input name='action' type='hidden' value="savequery"/>

	</form>
	</div>
	<?php
}
