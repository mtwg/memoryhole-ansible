<?php 
/************************************************************
Name:	config.php
Version:
Date:
config.php contains global configuration variables and shared functions that are common throughout
the application. 
************************************************************/
if (! $skipauth) {
	require_once('../thirdpartyauth.php');
} else {
	define('sugarEntry', true);
	$current_directory = getcwd();
	chdir('../');
	require_once('config.php');
	$startTime = microtime(true);

	require_once('include/database/DBManagerFactory.php');
	require_once('include/TimeDate.php');
	require_once('include/SugarLogger/LoggerManager.php');
	require_once 'include/SugarObjects/SugarConfig.php';
	require_once('include/utils.php');
	require_once('include/utils/file_utils.php');

	$GLOBALS['log'] = LoggerManager::getLogger('SugarCRM');
	$timedate = TimeDate::getInstance();
	$db = DBManagerFactory::getInstance();
	chdir($current_directory);
}
//Define Global Configuration Options
$logdir = "./log";
$datapath = "./data/";

//writelog: writes string out to logfile
function writelog($string) {
	global $logdir, $logfile;
	if (!$logfile) {  //open logfile if it isn't open
			$logfilename = "$logdir/".basename($_SERVER['PHP_SELF']).".log";
			$logfile= fopen($logfilename, 'a'); 
	}
	fwrite($logfile, time()." - $string\n");
}	

//dbconnect: open db connection, return connection pointer
function dbconnect() {
	global $sugar_config;
	$db = new mysqli("localhost",$sugar_config['dbconfig']['db_user_name'],$sugar_config['dbconfig']['db_password'], $sugar_config['dbconfig']['db_name']);
	$db->query('SET SESSION group_concat_max_len = 100000000');
	return $db;
}

//dbwrite: perform db query, return query result
//FIXME: rename this to dbquery
function dbQuery($query) {
	global $db;
	global $error;
	global $errorreport;
	/*if (substr_count($query, ';') > 1) { 
		$error .= "Attempted to run multiple queries: <br/><br/>$query";
		return;
	}*/
	if ($query) { 
		$res = $db->query($query) or $error.= ($db->lastDbError()."<br/><br/>$query");
	} else { $error .= 'Attempted to run empty query'; return; }
	if ($error && $errorreport == 1) { print $error; exit; }
	return $res;	
}

//insertclean: takes assoc. array and inserts data into contribs_clean db
function insertclean($row) {
	global $db;
	$query = "replace into contribs_clean set ";
	foreach (array_keys($row) as $key) { 
		$query .= " $key='".$db->escape_string($row[$key])."',";
	}
	$query = substr($query, 0, -1);
	$res = dbQuery($query);
	return $res;
}

//fetchRow: performs query and returns single row result
function fetchRow($query, $assoc=false) {
	global $db;
	$res = dbQuery($query);

	if ($res) { 
		if ($assoc) {
			return $res->fetch_assoc();
		} else {
			return $res->fetch_row(); 
		}
	}
}

function fetchItem($query) {
	$res = fetchRow($query);
	if ($res && $res[0]) { return $res[0]; }
}

function fetchCol($query) {
	global $db;
	$array = array();
	$res = dbQuery($query);
	if ($res) { 
		while ($row = $res->fetch_row()) {
			$array[] = $row[0];
		}
		return $array;
	}
}
	
//dbLookupArray: performs query and returns associative array
function dbLookupArray($query) {
	$res = dbQuery($query);
	$array = Array();
	if ($res) { 
		while($row = $res->fetch_assoc()) {
			$key = current($row);
			$array[$key] = $row;
		}
	}
	return $array;
}

//tableize: accepts assoc. array, returns html table string
function tableize($data) {
	$table = "<table border=1>";
	$first = 0;
	foreach ($data as $row) {
		if (! $first) {
			$table .="<tr>";
			foreach (array_keys($row) as $name) { 
				$name = ucwords(str_replace('_', ' ', $name));
				$table.="<th>$name</th>\n"; 
			}
			$first = 1;
			$table .="</tr>";
		}
		$table .="<tr>";
		foreach($row as $col) { 
			$table .="<td>".$col."</td>\n";
		}
		$table .="</tr>";
	}
	$table .="</table>";
	return $table;
}

function updateArrestee($data, $id=null) {
	global $db;
  $newdata = $data;
  if ($id) {
  	$a = fetchRow("select * from arrestees where id = '".$db->quote($id)."'", true);
	  foreach($data as $key => $val) {
  		if ($key == 'first_appearance_date_c' && $val != $a['first_appearance_date_c']) {
		  	$newdata['legal_strategy_c'] = $a['legal_strategy_c']."\n".$a['first_appearance_date_c']." - ".$a['next_hearing_time_c'] . ' - ' . $a['first_appearance_location_c'];
  		}
  		if (in_array($key, array('legal_strategy_c', 'medical_needs_c', 'contacts_c', 'property_issues_c', 'description', 'messages_c'))) {
  			if ($val != $a[$key]) {
	  			$newdata[$key] = $a[$key]."\n".$val;
  			}
  		}
  	}	
  }

	dbUpdate('legal_arrestees', $newdata, $id);
}

function dbUpdate($table, $data, $id=null) {
  $tableData = array();
  $customData = array();
  foreach($data as $key => $val) {
    if (preg_match("/_c$/", $key)) {
      $customData[$key] = $val;
    } else {
      $tableData[$key] = $val;
    }
  }
  $insert = false;
  if (!$id) {
  	$id = exec('uuidgen');
  	$insert = true;
  }
  dbUpdateTable($table, $tableData, $id, $insert);
  dbUpdateTable($table.'_cstm', $customData, $id, $insert);
}

function dbUpdateTable($table, $data, $id, $insert=false) {
  global $db;
  $idfield = preg_match("/_cstm$/", $table) ? 'id_c' : 'id';

  $sql = "update $table set ";
  if ($insert) {
  	$sql = "insert into $table set ";
  	$data[$idfield] = $id;
  }
  $sep = "";
  $args = array('');

  foreach($data as $key => $val) {
    $sql .= $sep.$key." = ?";
    $args[0] .= "s"; // you'll need to map these based on name
    $args[] = $val;
    $sep = ", ";
  }
  if (! $insert) { 
  	$sql .= " WHERE $idfield = ?";
  	$args[] = $id;
  	$args[0] .= "s"; // you'll need to map these based on name
	}

  $realdb = $db->getDatabase();
  $stmt = $realdb->stmt_init();
  if ($stmt->prepare($sql)) {
    call_user_func_array(array($stmt, 'bind_param'), refValues($args));
    if (! $stmt->execute()) { 
    	print $realdb->error;
    }
    $stmt->close();
  } else {
    print $realdb->error;
  }
  // $id = $id == null ? $realdb->insert_id : $id;
  // return $id;
}

function refValues($arr) {
  //Reference is required for PHP 5.3+
  if (strnatcmp(phpversion(), '5.3') >= 0) {
    $refs = array(); 
    foreach ($arr as $key => $value) {
      $refs[$key] = & $arr[$key];
    }
    return $refs;
  }
  return $arr;
}


if (isset($db)) {
	dbQuery("update arrestees set jurisdiction_c = 'A' where jurisdiction_c = '-blank-' and arrest_city_c in ('Oakland', 'Dublin', 'Berkeley', 'Emeryville')");
	dbQuery("update arrestees set jurisdiction_c = 'SF' where jurisdiction_c = '-blank-' and arrest_city_c in ('San Francisco')");
}
?>
