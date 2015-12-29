<?php 
require_once('config.php');
$db = dbconnect();
$action = $_REQUEST['action'];
$error = "";
$message = "";
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
		$_POST[$field] = "'".$db->real_escape_string(stripslashes(urldecode($_POST[$field])))."'";
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
	$query = fetchItem("select query from queries where query_id=".$_POST['query_id']);
	$res = dbQuery($query);
	if ($res) { 
		$info =  'Query successfully returned '.$res->num_rows.' rows.'; 
		
		$output = exportTSV($res);
		#$info.= "<pre>".str_replace("\n", '<br/>', $output)."</pre>";
		$res = dbQuery('update queries set executed=NOW() where query_id='.$_POST[query_id]);
		$executed =fetchItem('select executed from queries where query_id = '.$_POST[query_id]);
	}
	echo "error = \"$error\"; info=\"$info\"; executed=\"".str_replace(' ', '<br/>', $executed)."\";";
	exit;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
   "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<title>Minerva Project Query Manager</title>
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
<h2>Minerva Project Query Manager</h2>
<h4>Report errors to <a href='mailto:michalec@stanford.edu'>michalec@stanford.edu</a></h4>
<div id='tooltip' style='padding: 3px; z-index: 100; position: absolute; visibility: hidden; background-color: white; top: 0px; left: 0px; filter:alpha(opacity=70);-moz-opacity:.70;opacity:.70; font-weight: bold; font-size: .8em; border: 1px solid black;'></div>
<div id='message'>
<div id='progress'><img src='icons/loading.png' alt='Loading' /> Query is running...<br/><img src='icons/progress_bar.gif' alt='Progress' /></div>
<div id='error'><img src='icons/error.png' alt='Error' /> An error occured: <div id='errorstring'></div></div>
<div id='info'><img src='icons/info.png' alt='Information' /> <div id='infostring'></div></div>
</div>
<div id='help' style='width: 400px; height: 80%; border: 1px solid gray; z-index: 200; background-color: #FFFFBB;'>
<h3>Minerva Query Manager Documentations</h3>

<h5>SUMMARY:</h5>
This web application provides a simple interface to store, manage, and execute MySQL queries in order to generate flatfile reports from Stanford faculty, student, and grant data. 

<h5>USAGE:</h5> 
<p>Creating new queries/editing existing queries:</p>
<p>Clicking on the 'Create New Query' button (upper-left) or clicking on either the 'Edit Query' icon or name of an existing query will open the query editing window. This allows you to change the name and description of a query, or edit the query itself. When editing the query itself, typing either reserved MySQL words or known table or field names will result in syntax highlighting (coloring) of these words. Additionally, when typing the first letters of a field or table name and then pressing tab, the word will either auto-complete, or complete to a point and offer suggestions in a box below the editor. If these features cause problems, they can be disabled by clicking on the 'Toggle Fancy Editor' button. For further reference, clicking on the 'View DB Diagram' button (next to 'Create New Query') will open a new window containing an image of the database layout - all the tables, their fields, and relationships between them.</p>
<p>To save a query, click the 'Save Query' button on the lower right. NOTE: A query must be saved before it can be run. To check for common errors (syntax errors, non-existent fields, etc.) or to check the efficiency of the query, click the 'Describe (Test) Query' button. This will bring up a dialog at the top of the page showing the result of 'describe <query>', or any errors if they occur.</p>

<p>Running a query:</p>
<p>A query can be executed by clicking the 'run' button (right-facing triangle), either on the right side of the query list or at the bottom of the edit query view. Feedback will be show at the top of the browser window while the query is running. On completion, the feedback will give an error message if an error occurred, or a confirmation message if it finished successfully. The confirmation message will contain information about how many rows were returned, as well as the location of the generated flatfile.</p>

<p>Flatfiles:</p>
<p>The results of the queries are stored in text files in CSV (comma-separated value) format, with the first row of the file containing the column names. The files themselves are stored in '/afs/ir/group/minerva/data/', under a directory named for the SUnet ID for the user running the query. The file will be named with a unix timestamp followed by the name of the query. For example, if I run the query 'Test Query', the output will be saved to '/afs/ir/group/minerva/data/michalec/1196820796-Test_Query.csv'</p>

<p>Other Features</p>
<p>Queries can be deleted or copied from the respective buttons on the right side of the query list. Copied queries will have the original query name plus 'copy'  ('Test Query' becomes 'Test Query copy'). The query list itself can be sorted via the various columns by clicking on the column header.</p>

<p>Security</p>
<p>A number of measures have been implemented in order to maintain the security of the minerva dataset. Access to the web frontend is restricted to members of the Minerva group through the WebAuth authorization system. Additionally, no output from the MySQL queries (except describe query statements and error messages) is accessible via the web – it is only stored in the flatfiles. Only select and describe (read-only) queries are permitted to be run via the frontend. All files in the minerva group directory, including the output data files (csv's), are only readable by members of the group, via the AFS file system ACL system. The connection between the web frontend and the database is tunneled through SSH encryption.</p>
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
	<?php $queries = dbLookupArray("select * from queries"); 
	foreach($queries as $storedquery) {
		$query_id =$storedquery[query_id];
		echo "<tr id='row_$query_id'>
			<td id='name_$query_id'>
				<img class='pointer' onclick='showDetails($query_id);' onmouseover='showTooltip(\"Edit this query\");' onmouseout='hideTooltip();' src='icons/edit.png' alt='Edit this query' />
				<div class='queryname pointer' onclick='showDetails($query_id);'>$storedquery[name]</div>
			</td>
			<td id='description_$query_id'>$storedquery[description]</td>
			<td id='created_$query_id'>".str_replace(' ', '<br/>', $storedquery[created])."</td>
			<td id='modified_$query_id'>".str_replace(' ', '<br/>', $storedquery[modified])."</td>
			<td id='executed_$query_id'>".str_replace(' ', '<br/>', $storedquery[executed])."</td>
			<td style='white-space: nowrap;' id='controls_$query_id'><a href='index.php?action=delete&amp;query_id=$query_id'><img class='pointer' src='icons/delete.png' alt='Delete this query'/></a><a href='index.php?action=copyquery&amp;query_id=$query_id'><img class='pointer' src='icons/copy.png' alt='Copy this query' /></a><a href='index.php' onclick='runQuery($query_id); return false;'><img class='pointer' src='icons/run.png' alt='Run this query' /></a></td>
			</tr>";
	}
	?>
		</tbody>
	</table>
	</div>
<?php
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
