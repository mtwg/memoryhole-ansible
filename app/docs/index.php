<?php
require_once('../thirdpartyauth.php');
error_reporting(E_ERROR | E_WARNING | E_PARSE);
#import_request_variables("gp");
extract($_REQUEST, EXTR_REFS); 
$max_file_size = return_bytes(ini_get('upload_max_filesize'));

$upload_errors = array(
        0=>"There is no error, the file uploaded with success",
        1=>"The uploaded file is larger than ".round($max_file_size/1024/1024, 2)."MB",
        2=>"The uploaded file is larger than ".round($max_file_size/1024/1024, 2)."MB",
        3=>"The uploaded file was only partially uploaded",
        4=>"No file was uploaded",
        6=>"Missing a temporary folder"
); 

if ($dir) {
	if (preg_replace("/\.\./", "", $x)) {
		echo "Error: File and directory names cannot contain '..'";
		exit;
	}
} else { $dir = '/'; }
if (! $sort) { $sort = 'mdate'; $desc = '1'; }
$cols = array(
	'Name' => array('', 'name'),
	'Size' => array(8, 'size'),
	'Modified' => array(8, 'mdate'),
	'Created' => array(8, 'cdate'),
	'Comment' => array(32, 'comment'),
	'Action' => array(4, '')
);
$filetypes = array(
	'.png'=>'image',
	'.gif'=>'image',
	'.jpg'=>'image',
	'.svg'=>'image',
	'.jpeg'=>'image',
	'.pdf'=>'pdf',
	'.html'=>'html',
	'.doc'=>'doc',
	'.sxw'=>'doc',
	'.odt'=>'doc',
	'.mp3'=>'audio',
	'.mp4'=>'audio',
	'.m4a'=>'audio',
	'.ogg'=>'audio',
	'.wav'=>'audio',
);
$bad_exts = array(".php", ".pl", ".sh", ".cgi", ".htaccess");
$page="index.php";
$startdir = "./files/";
$webdir = "./files";
#$startdir = "/home/dameat/public_html/files/";
#$webdir = "/~dameat/files/";
$localdir = "$startdir$dir";
//chmod("$startdir", 0777);
$time_format = "m/d/y";
$message = "";
if ($createdir != "") {
	if (! file_exists("$localdir/$dirname")) {
		mkdir(urldecode("$localdir/$dirname"), 0777);
		chmod(urldecode("$localdir/$dirname"), 0777);
	} else { $error = "File $localdir/$dirname already exists"; }
}

if ($_FILES["infiles"]["name"][0]) {
	$x = 0;
	foreach ($_FILES["infiles"]["error"] as $key => $error) {

		$tmp_name = $_FILES["infiles"]["tmp_name"][$key];
		$name = $_FILES["infiles"]["name"][$key];
		if ($error == UPLOAD_ERR_OK) {
			$bad =0;
			foreach($bad_exts as $ext) {
				if (preg_match("/$ext$/i", $name)) { 
					$message = "Invalid file name. Cannot end in $ext";
					$bad = 1;
				}
			}
			if (! $bad) {
				move_uploaded_file($tmp_name, "$localdir/$name");
				chmod("$localdir/$name", 0666);
				if ($_POST["comment$x"]) {
				   if ($handle = fopen("$localdir/.$name", 'w')) { fwrite($handle, $_POST["comment$x"]); }
				}
			}
		} else {
			$message = "Unable to upload file '$name': $upload_errors[$error]";
			$bad = 1;
			continue;
		}
		$x++;
	} 
}

print_header();
?>
	<form action='index.php'><div id='searchhead' style='position: absolute;top: 5px; right: 10px; text-align: center;line-height: 24px;'>Search <input name='search_pattern' value='<?=htmlentities($search_pattern)?>'></div></form>
<div id='actions' style='width: 300px;text-align: left; position: relative; top: 0px; left: 0px; border: 1px solid #ff8800;margin-bottom: 10px; '>
<div id='dirhead' style='width: 150px; text-align: center;line-height: 24px;'><a href='javascript:createDir()'><img src='images/foldernew.png'>Create Directory</a></div>
<div id='uploadhead' style='position: absolute;top: 0px; left: 150px; width: 150px; text-align: center;line-height: 24px;'><a href='javascript:addUpload()'><img src='images/filenew.png'>Upload Files</a></div>

<div style='width: 300px;'>
<form name="createdir" action="<?=$page; ?>">
<div id='createdir' style='display: none; background: #FFE3B5; text-align: left; padding: 5px;'>
<input type="hidden" name="dir" value="<?=$dir ?>">
<input type="hidden" name="sort" value="<?=$sort; ?>" />
<input type="hidden" name="desc" value="<?=$desc; ?>" />
<input name="dirname">  <input type="submit" name="createdir" value="New Directory">
</div>
</div>
</form>
<form style='background: #FFE3B5;' action="<?php echo $page; ?>" method="post" enctype="multipart/form-data">
<div id='upload' style='display:none; background: #FFE3B5;'>
<input type="hidden" name="MAX_FILE_SIZE" value="<?=$max_file_size ?>" />
<input type="hidden" name="sort" value="<?=$sort; ?>" />
<input type="hidden" name="desc" value="<?=$desc; ?>" />
<input type="hidden" name="dir" value="<?=$dir; ?>" />
<div id='uploadfields' style='position: relative; top: 5px; left: 0px;'></div>
<div style='padding: 5px;'>
<span style='font-size: .8em;float: right'><a href='javascript:addUpload()'><img src='images/add.png'>Add Files</a></span>
<input type="submit" value="Upload" />
</div>
</div>
</form>
</div>
</div>
<div id='feedback'<?php 
if ($message) {
	echo " style='display: block;'>$message";
} else { echo ">"; }?></div>
<div id='content'>
<div id='crumbs' class='crumbs'><span style="font-weight: bold;">Location:</span>
<?php
if ($dir) { 
	$crumbs = explode("/", $dir);
	array_shift($crumbs);
	foreach($crumbs as $crumb) {
		$title = $crumb;
		if(! $title) { $title='Home'; } 
		else { echo "<b>&#187;</b> "; } 
		$crumbdir .= "/$crumb";
		echo "<div id='f$crumb' class='drop' dir=1 file='$crumbdir'><img src='images/folder.png' width=16 height=16 border=0><a href=\"$page?dir=".urlencode($crumbdir)."\">$title</a></div>";
	}
}
echo "
</div>
<table width=100% cellspacing=0 class='filelist' id='filelist' style='border-left: 1px solid #000000; border-bottom: 1px solid #000000;'>
	<tr>";


foreach ($cols as $heading=>$list) {
	$column = strtolower($heading);
	$column = ereg_replace(" ", "_", $heading);
	$width = $cols[$heading][0];
	if ($cols[$heading][1]) {
		$columntext = "<a href=\"$page?sort=".$cols[$heading][1];
		if ($sort == $cols[$heading][1]) {
			$tempdesc = $desc;
			if ($desc) { $sortpic =  '&#8595;';
			} else { $sortpic = '&#8593;'; }
			if ($desc) { $tempdesc = 0; } else { $tempdesc = 1; }
			$heading = "<b>$heading $sortpic</b>";
		} else {$tempdesc = 0; }
		$columntext .= "&desc=$tempdesc&dir=$dir\">$heading</a>";
	} else { $columntext = $heading; }
	echo "\t\t<th width=$width% class=\"header\">$columntext</th>\n"; 
}
echo "</tr>";

if (is_dir($localdir))  {
	$dirhandle = opendir($localdir);
}
$dirs = array();
$files = array();
$m3u = array();
$results = array();
if ($search_pattern) { 
	foreach(glob_recursive("*".sql_regcase($search_pattern)."*") as $file) {
		if (preg_match("/^\.\/files/", $file)) { 
			$results[]  = preg_replace("/^\.\//", "", $file);
		}
	}
} else {
	while ($dirhandle && false !== ($file = readdir($dirhandle))) {
		if (preg_match("/^\./", $file)) { continue; }
		$results[] = "files/$dir/$file";
	}
}
foreach($results as $file) {
	$info = stat("$file");
	$comment = "";
	$pathinfo = pathinfo($file);
	if (is_file("$pathinfo[dirname]/.$pathinfo[basename]")) {
		$comment = file_get_contents("$pathinfo[dirname]/.$pathinfo[basename]");
	}
	$name = "";
	if ($search_pattern) { 
		$name = preg_replace("/^files\/(".str_replace('/', '\/', $dir).")?\/?/", '', $file);
	} else {
		$name = array_shift(array_reverse(explode('/', $file)));
	}
	$file = array(
		'name' =>	$name,
		'size' =>		$info[7],
		'mdate' => 		$info[9],
		'cdate' => 		$info[10],
		'nicesize' => 	filesize_format($info[7]),
		'nicemdate' =>	date($time_format, $info[9]),
		'nicecdate' =>	date($time_format, $info[10]),
		'comment' =>	$comment,
		'type' => 		filetype("$file")
	);
	if ($file[type] == "dir" || $file[type] == 'link') { 
		$dirs[] = $file;
	} else {
		$files[] = $file;
	}
}
if ($dirs[0]) {
	array_key_multi_sort($dirs, strtolower($sort));
	if ($desc) { $dirs = array_reverse($dirs); }
}
if ($files[0]) {
	array_key_multi_sort($files, strtolower($sort));
	if ($desc) { $files = array_reverse($files); }
}
$dirlist = "";
if ($dir) { $dirlist .= "<option value=\"$dir/../\">..</option>"; }
if ($dirs[0]) {
	foreach ($dirs as $thisdir) {
		$dirlist .= "<option value=\"$dir/$thisdir[name]\">$thisdir[name]</option>";
	}
}
#if ($dirlist) { $dirlist = "<option selected value=''>Move to...</option>$dirlist"; }
$list = array_merge($dirs, $files);
$count = 0;


    $color1="row_on";
    $color2="row_off";
    $color = $color1;

	if ($list[0]) {
		foreach ($list as $file) { 
		$count++;
		$isdir = 0;
		if ($file[type] == 'dir' || $file[type] == 'link') {
			$image = "<img src='images/folder.png' width=16 height=16 border=0>";
			$name = "<a href=\"javascript: rename('$count')\"><img src='images/rename.png'></a><span id='ren$count'></span><a id='$count"."_name' href=$page?dir=".urlencode("$dir/$file[name]").">$file[name]</a>";
			$isdir=1;
		} else {
			preg_match("/\.\w+$/", $file[name], $filetype);
			$type = strtolower($filetype[0]);
			if ($filetypes[$type]) { $fileimage = $filetypes[$type]; } else { $fileimage='file'; }
			$preview = ''; #$fileimage == 'audio' ? '' : "<a href=\"javascript: preview('$count')\"><img src='images/preview.png' title='Preview'/></a>";
			$image = "<img src='images/$fileimage.png' title='Move' width=16 height=16 border=0>";
			$name = "<a href=\"javascript: rename('$count')\"><img src='images/rename.png' title='Rename'></a>$preview<span id='ren$count'></span><a id='$count"."_name' href=\"$webdir/$dir/$file[name]\">$file[name]</a>";
		}	
		echo "\n<tr class=$color id=$count>
				<td name='name'><span class='drag' id='dragrow$count'><span dir=$isdir id='file$count' style='cursor: move;'>$image</span>$name</span></td>
				<td name='size'>$file[nicesize]</td>
				<td name='mdate'>$file[nicemdate]</td>
				<td name='cdate'>$file[nicecdate]</td>
				<td name='comment' class=comment id=c$count onclick=\"editComment('c$count');\" >$file[comment]</td>	
				<!--<div name='comment' class='comment' id='pcomment$count'>$file[comment]</div>-->
				<td name='action'><a onclick=\"javascript:deleteFile('$count'); return false;\" href='hhhhh' ><img src='images/delete.png' title='Delete' width=16 height=16 border=0></a>
		";
		//if ($file[type] != 'dir') {
			#echo "<select onChange=\"move('$file[name]', this.options[this.selectedIndex].value)\" name='dir_chooser' id=m$count>
			#	$dirlist
			#	</select>";
		//}
		echo "
				</td>
			</tr>";
			if ($color == $color1) { $color=$color2; } else {$color = $color1; }
		}
	}
echo "

</table>
</div>
<br><br>

</body></html>";

function array_key_multi_sort(&$arr, $l , $f='strnatcasecmp') {
       return usort($arr, create_function('$a, $b', "return $f(\$a['$l'], \$b['$l']);"));
}

function filesize_format ($bytes, $decimal='.', $spacer=' ', $lowercase=false) {

  $bytes = max(0, (int)$bytes);
  $units = array('YB' => 1208925819614629174706176, // yottabyte
                 'ZB' => 1180591620717411303424,    // zettabyte
                 'EB' => 1152921504606846976,      // exabyte
                 'PB' => 1125899906842624,          // petabyte
                 'TB' => 1099511627776,            // terabyte
                 'GB' => 1073741824,                // gigabyte
                 'MB' => 1048576,                  // megabyte
                 'KB' => 1024,                      // kilobyte
                 'B'  => 0);                        // byte

  foreach ($units as $unit => $qty) {
     if ($bytes >= $qty)
   return number_format(!$qty ? $bytes: $bytes /= $qty, 2, $decimal, $spacer).$spacer.$unit;
   }
  } 



function print_header () {
	global $dir;
	global $webdir;
	global $page;
	header('Content-type: text/html; charset=utf-8');
	?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" >
	<head>
	<title>NLG Legal Support Filemanager</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<!-- Namespace source file -->
	<script src = "js/YAHOO.js" ></script>
	<script src = "js/dom.js" ></script>
	<script src = "js/event.js" ></script>
	<script src = "js/animation.js" ></script>
	<script src = "js/dragdrop.js" ></script>

	<script language="javascript" type="text/javascript"> 
		//bug = window.open("","bug","width=200,height=100,status=0,toolbar=0,scrollbars=1");
		var url = "request.php?";
		var results = new Array();
		var dd= new Array();
		var dir = '<?php echo $dir; ?>';
		var webdir = '<?php echo $webdir; ?>';
		var page = '<?php echo $page; ?>';
		var uploadcount = 0;
	</script>
	<script src = "docspace.js" ></script>
	</head>
<body id='body' onload="initDrag()">
<div id='pwindow' style='position: fixed; left: 50%; z-index: 20; margin-left: -250px; width: 500px; height: 80%; border: 1px solid; background: #FFE3B5; display:none;'>
	<div id='ptitlebar' style='padding: 5px; width: 490px; background: orange; text-align: center; position: absolute; top: 0px; left: 0px; border-bottom: 2px solid black; line-height: 22px;'>
	<div id='pwindowmove' style='z-index: 200; float: left;'><img src='images/move.png' style='cursor: move;' title='Move'/></div>
	<div id='pwindowclose' style='float: right;'><a href="javascript: hide('pwindow');"><img src='images/close.png' title='Close'/></a></div>
	<span id='ptitle' style='width: 390px; border: 1px solid;'></span>
	</div>
	<div id='preview' style='height: 90%; width: 490px; margin: 5px; margin-top: 42px; overflow:auto;'></div>
</div>
<table width='80%' style='position: relative;' align='center'><tr><td align=center>
<h2>NLG Legal Support Filemanager</h2>
<?php	
}
	
function glob_recursive($pattern, $flags = 0) {
	$files = glob($pattern, $flags);
   
	foreach (glob(dirname($pattern).'/*', GLOB_ONLYDIR|GLOB_NOSORT) as $dir) {
		$files = array_merge($files, glob_recursive($dir.'/'.basename($pattern), $flags));
	}
   
	return $files;
}


/*function return_bytes($val) {
    $val = trim($val);
    $last = strtolower($val[strlen($val)-1]);
    switch($last) {
        // The 'G' modifier is available since PHP 5.1.0
        case 'g':
            $val *= 1024;
        case 'm':
            $val *= 1024;
        case 'k':
            $val *= 1024;
    }

    return $val;
}*/
?>
