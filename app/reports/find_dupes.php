<?php
require_once('config.php');
$error = "";
$threshold = 200;
$action = isset($_REQUEST['action']) ? $_REQUEST['action'] : "";
if ($action == 'list') {

	$dupes = dbLookupArray("select ids from dupe_check");

	$query = "select id, first_name, last_name, preferred_name, email, replace(replace(phone_mobile, '-', ''), '.', '') as phone_mobile, arrest_date from arrestees";
	$entities = dbLookupArray($query);
	foreach ($entities as &$entity) { 
		$entity['pieces'] = array();
		$pieces = array_merge(preg_split("/[\s\-]+/", trim($entity['first_name'])), preg_split("/[\s\-]+/", trim($entity['last_name'])));
		foreach(array('last_name', 'first_name', 'preferred_name') as $field) { 
			foreach (preg_split("/[\s\-]+/", trim($entity[$field])) as $piece) {
				$piece = strtolower($piece);
				if ($piece == 'n/a' || $piece == 'unknown' || $piece == "") { continue; }
				$entity['pieces'][] = array(
					'name'=>$piece,
					'soundex'=>soundex($piece),
					'metaphone'=>metaphone($piece),
					'last'=>$field == 'last_name'
				);
			}
		}
	}

	$scores = array();

	foreach ($entities as $one) {
		foreach ($entities as $two) {
			if ($two['id'] <= $one['id'] || $two['id'] == $one['id']) { continue; }
			if (isset($dupes[$one['id'].$two['id']])) { continue; }
			if (abs(strtotime($one['arrest_date'])- strtotime($two['arrest_date'])) > 60*60*24) { continue; }
			$score = 0;
			if($one['email'] && $one['email'] == $two['email']) { $score += 400; }
			if($one['phone_mobile'] && $one['phone_mobile'] == $two['phone_mobile']) { $score += 300; }
			foreach($one['pieces'] as $p1) {
				foreach($two['pieces'] as $p2) {
					$piece_score = 0;
					if ($p1['name'] == $p2['name']) { $piece_score = 90; }
					else if (levenshtein($p1['name'], $p2['name']) == 1 ) { $piece_score = 70; }
					else if (levenshtein($p1['name'], $p2['name']) == 2 ) { $piece_score = 50; }
					//else if (levenshtein($p1['name'], $p2['name']) == 3 ) { $piece_score = 30; }
					else if ($p1['metaphone'] == $p2['metaphone']) { $piece_score = 30; }
					else if ($p1['soundex'] == $p2['soundex']) { $piece_score = 15; }
					if($p1['last'] && $p2['last']) { $piece_score *= 4; }
					if(! $p1['last'] && ! $p2['last']) { $piece_score *= 2; }
					$score += $piece_score;
				}
			}

			if ($score >= $threshold) { 
				$scores[] = array(
					'score'=>$score,
					'id_1'=>$one['id'],
					'id_2'=>$two['id'],
					'name_1'=>"$one[last_name], $one[first_name] ".($one['preferred_name'] ? "($one[preferred_name])" : ""),
					'name_2'=>"$two[last_name], $two[first_name] ".($two['preferred_name'] ? "($two[preferred_name])" : ""),
				);
			}
		}
	}
	usort($scores, function($a, $b){
		if ($a['score'] == $b['score']) return 0;
		return ($a['score'] > $b['score']) ? -1 : 1;
	});
	$output = array();
	foreach($scores as $score) {
		$one = $entities[$score['id_1']];
		$two = $entities[$score['id_2']];
		$row['score'] = $score['score'];
		$row['compare'] = "<button onclick=\"parent.compare('$one[id]', '$two[id]');\">Compare</button>";
		$row['name_1'] = $score['name_1'];
		$row['name_2'] = $score['name_2'];
		$row['date_1'] = $one['arrest_date'];
		$row['date_2'] = $two['arrest_date'];
		$row['confirm'] =  "<button onclick=\"nomatch(this, '$one[id]$two[id]');\">Confirm these aren't the same (forever)</button>";
		//$row['pieces1'] = print_r($one['pieces'], true);
		$output[] = $row;
	}
?>
<html><head>
	<title></title>
	<link rel='stylesheet' href='style.css' media="all" type='text/css'/>
	<link rel="stylesheet" type="text/css" media="all" href="js/tablesort/style.css" />
	<script src="js/prototype.js" type="text/javascript"></script>
	<script src="js/scriptaculous.js" type="text/javascript"></script>
	<script type="text/javascript" src="js/tablesort/fastinit.js"></script>
	<script type="text/javascript" src="js/tablesort/tablesort.js"></script>	
	<script type="text/javascript">
		var nomatch = function(e, id) {
			new Ajax.Request('find_dupes.php', {
				parameters: {id: id, action: 'confirm'},
				onComplete: function(res) { 
					var response = res.response;
					if (response == 'ok') {
						Element.remove(e.parentNode.parentNode);
					} else {
						console.log(res.response);
					}	
				}
			});
		}
	</script>
	</head><body style='text-align: center;'>


<?php
	$table = tableize($output);
	$table = str_replace('<table', "<table class='sortable' style='width: 98%;' id='querytable'", $table);
	print $table;
?> </body></html><?php
} elseif ($action == 'confirm') {
	$id = $db->quote($_REQUEST['id']);
	$query = "insert ignore into dupe_check set ids='$id'";
	dbQuery($query);
	if ($error) { 
		print $error;
	} else {
		print "ok";
	}
} else {
?>
<html style='margin: 0px; padding: 0px;'>
<head>
<title>Find Duplicates</title>
<script type='text/javascript'>

window.onload = function() {
	var lframe = document.getElementById('lframe');
	var rframe = document.getElementById('rframe');
}

var compare = function(id1, id2) {
	lframe.src='../index.php?module=legal_arrestees&return_module=legal_arrestees&action=EditView&record='+id1;
	rframe.src='../index.php?module=legal_arrestees&return_module=legal_arrestees&action=EditView&record='+id2;
}

setup = function() {
	var lframe = document.getElementById('lframe');
	var rframe = document.getElementById('rframe');
	if (lframe) { 
		lframe.contentWindow.onscroll =  function() {
			var x = lframe.contentWindow.scrollX;
			var y = lframe.contentWindow.scrollY;
			rframe.contentWindow.scrollTo(x,y);
		}
	}
	if (rframe) { 
		rframe.contentWindow.onscroll =  function() {
			var x = rframe.contentWindow.scrollX;
			var y = rframe.contentWindow.scrollY;
			lframe.contentWindow.scrollTo(x,y);
		}
	}
}

</script>
<style>
html, body { height: 100%; margin: 0px; padding: 0px;}
iframe { border: 1px solid;  box-sizing: border-box;}
#lframe, #rframe { height: 80%; width: 50%;  position: absolute; top: 20%; left: 0px;}
#rframe { left: 50%; }
#top { height: 20%; width: 100%; }
</style>
</head>
<body style='margin: 0px; padding: 0px;'>
<iframe id='top' src='find_dupes.php?action=list'></iframe>
<iframe id='lframe' onload='setup();' src='../index.php'></iframe>
<iframe id='rframe' onload='setup();' src='../index.php'></iframe>
</body>
</html>
<?php }

exit; 
?>
