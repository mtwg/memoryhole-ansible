<?php
require_once('../thirdpartyauth.php');
error_reporting(E_ERROR | E_WARNING | E_PARSE);

set_magic_quotes_runtime(0);

if(get_magic_quotes_gpc() || ini_get('magic_quotes_sybase')) {
   $_GET =    magic_quotes_strip($_GET);
   $_POST =    magic_quotes_strip($_POST);
   $_COOKIE =  magic_quotes_strip($_COOKIE);
   $_REQUEST = array_merge($_GET, $_POST, $_COOKIE);
   $_FILES =  magic_quotes_strip($_FILES);
   $_ENV =    magic_quotes_strip($_ENV);
   $_SERVER =  magic_quotes_strip($_SERVER);
}

no_dots($dir);
no_dots($filename);
no_dots($newdir);
no_dots($newname);

function magic_quotes_strip($mixed) {
	if(is_array($mixed)) {
		return array_map('magic_quotes_strip', $mixed);
	}
	return stripslashes($mixed);
}
	extract($_REQUEST, EXTR_REFS); 
	#import_request_variables("gp");
	$action = $_REQUEST['action'];
	$startdir = "files/";
	$bad_exts = array(".php", ".pl", ".sh", ".cgi", ".htaccess");
	if ($action == 'delete') {
		$message = "$dir/$filename deleted.";
		if (is_dir("$startdir/$dir/$filename")) { 
			rmdir("$startdir/$dir/$filename") || $message = "Error: $php_errormsg";
		} else {
			unlink("$startdir/$dir/$filename") || $message = "Error: $php_errormsg"; 
		}
		if (is_file("$startdir/$dir/.$filename")) {
			unlink("$startdir/$dir/.$filename") || $message = "Error: $php_errormsg"; 
		}
	} elseif ($action == 'move') {
		$message = "$filename moved.";
		rename("$startdir/$dir/$filename", "$startdir/$newdir/$filename") || $message = "Error: $php_errormsg";	
		if (is_file("$startdir/$dir/.$filename")) {
			rename("$startdir/$dir/.$filename", "$startdir/$newdir/.$filename") || $message = "Error: $php_errormsg";	
		}
	} elseif ($action == 'rename') {
		$message = "$filename renamed to $newname.";
		$bad = 0;
		foreach($bad_exts as $ext) {
			if (preg_match("/$ext$/i", $newname)) {
				$message = "Invalid file name. Cannot end in $ext";
				$bad = 1;
			}
		}
		if(! $bad) {
			rename("$startdir/$dir/$filename", "$startdir/$dir/$newname") || $message = "Error: $php_errormsg";
			if (is_file("$startdir/$dir/.$filename")) {
				rename("$startdir/$dir/.$filename", "$startdir/$dir/.$newname") || $message = "Error: $php_errormsg";	
			}
		}
	} elseif ($action == 'view') {
		$message = file_get_contents("$startdir/$dir/$filename");
	   	if(! $message) {$message = "Error: $php_errormsg";}
	} elseif ($action == 'savefile') {
		$message = "$filename saved";
			if ($handle = fopen("$startdir/$dir/$filename", 'w')) {
				$content = rawurldecode($content);
				$content = preg_replace('/\\\([\\\"\'])/', '$1', $content);
				fwrite($handle, $content) || $message = 'Error';
			} else { $message = "Cannot open file ($startdir/$dir/$filename)"; }
	} else {
		$message = "Comment added to $filename";
		if ($handle = fopen("$startdir/$dir/.$filename", 'w')) {
			$comment = urldecode($comment);
			$comment = preg_replace('/\\\([\"\'])/', '$1', $comment);
			fwrite($handle, urldecode($comment)) || $message = 'Error';
		} else { $message = "Cannot open file ($startdir/.$filename)"; }
	}
	echo "$message";

	function no_dots($x) {
		if (preg_replace("/\.\./", "", $x)) {
			echo "Error: File and directory names cannot contain '..'";
			exit;
		}
		//return $x;
	}

?>	
