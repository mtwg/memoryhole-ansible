<?php
	define('sugarEntry', true);
	$post = $_POST;
	$get = $_GET;
	$current_directory = getcwd();
	chdir('../');
	include ('include/MVC/preDispatch.php');
	$startTime = microtime(true);
	require_once('include/entryPoint.php');
	require_once('include/MVC/SugarApplication.php');
	$app = new SugarApplication();
	$app->startSession();
	$user_unique_key = (isset($_SESSION['unique_key'])) ? $_SESSION['unique_key'] : '';
	$server_unique_key = (isset($sugar_config['unique_key'])) ? $sugar_config['unique_key'] : '';
	$authController = new AuthenticationController();
	if(($user_unique_key != $server_unique_key) && (!isset($_SESSION['login_error']))) {
		session_destroy();
		header("Location: ../index.php?action=Login&module=Users");
		die();
	}
	$GLOBALS['current_user'] = new User();
	if(isset($_SESSION['authenticated_user_id'])){
		// set in modules/Users/Authenticate.php
		if(!$authController->sessionAuthenticate()){
			 // if the object we get back is null for some reason, this will break - like user prefs are corrupted
			session_destroy();
			header("Location: ../index.php?action=Login&module=Users");
			die();
		}//fi
	} else {
		session_destroy();
		header("Location: ../index.php?action=Login&module=Users");
		die();
	}
	//set cookies
	if(isset($_SESSION['authenticated_user_id'])){
		setCookie('ck_login_id_20', $_SESSION['authenticated_user_id'], time() + 86400 * 90);
	}
	if(isset($_SESSION['authenticated_user_theme'])){
		setCookie('ck_login_theme_20', $_SESSION['authenticated_user_theme'], time() + 86400 * 90);
	}
	if(isset($_SESSION['authenticated_user_theme_color'])){
		setCookie('ck_login_theme_color_20', $_SESSION['authenticated_user_theme_color'], time() + 86400 * 90);
	}
	if(isset($_SESSION['authenticated_user_theme_font'])){
		setCookie('ck_login_theme_font_20', $_SESSION['authenticated_user_theme_font'], time() + 86400 * 90);
	}
	if(isset($_SESSION['authenticated_user_language'])){
		setCookie('ck_login_language_20', $_SESSION['authenticated_user_language'], time() + 86400 * 90);
    }
    require_once 'modules/ACLRoles/ACLRole.php';
    $objACLRole = new ACLRole();
    $roles = $objACLRole->getUserRoles($GLOBALS['current_user']->id);
    if (in_array('Lawyer', $roles)) {
      print "<h2>You do not have permissions to access this function.</h2>";
      exit();
    }
	chdir($current_directory);
	$_POST = $post;
	$_GET = $get;
	/*foreach(array_keys($GLOBALS) as $key) {
		if (!in_array($key, array('_GET', '_POST', '_COOKIE', '_FILES', '_SERVER', '_REQUEST', 'GLOBALS'))) {
			unset($GLOBALS[$key]);
	}
	}*/

?>
