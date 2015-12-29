<?PHP

// manifest file for information regarding application of new code
$manifest = array(
	'acceptable_sugar_flavors' => array( 'CE', 'PRO', 'ENT' ),

    // only install on the following regex sugar versions (if empty, no check)
    'acceptable_sugar_versions' => array(
    	//'regex_matches' => array( '5\.5\.\d\w*' ),
    ),

    'is_uninstallable'=>true,

    // name of new code
    'name' => 'My Sites',

    // description of new code
    'description' => 'My Sites',

    // author of new code
    'author' => 'Collin Lee, SugarCRM',

    // date published
    'published_date' => '2009/10/10',

    // version of code
    'version' => '5.5.1',

    // db_version of code
    'db_version' => '5.5.1',

    // type of code (valid choices are: full, langpack, module, patch, theme )
    'type' => 'module',

    // icon for displaying in UI (path to graphic contained within zip package)
    'icon' => '',

    // flag to specify whether to remove database tables on uninstallation
    'remove_tables' => 'prompt',
);


$installdefs = array(
	'id' => 'mysites',
	'image_dir'=>'<basepath>/images',
	'copy' => array(
		array(
			'from' => '<basepath>/modules/iFrames',
			'to'   => 'modules/iFrames',
		),	
		
		array(
		    'from' => '<basepath>/images/themes/default',
		    'to' => 'themes/default/images',
		),
		
		array(
		    'from' => '<basepath>/images/themes/Legacy',
		    'to' => 'themes/Legacy/images',
		),		
	),
	
	'language'=> array(
		array(
			'from'=> '<basepath>/application/app_strings.php', 
			'to_module'=> 'application',
			'language'=>'en_us'
		),	
	
		array(
			'from' => '<basepath>/modules/Administration/en_us.lang.php',
			'to_module' => 'Administration',
			'language' =>'en_us'
		),
	),	
	
	'beans'=> array(
		array(
			'module' => 'iFrames',
			'class'  => 'iFrame',
			'path'   => 'modules/iFrames/iFrame.php',
			'tab'    => true,
		),
	),
	
	'post_execute'=>array(
		0 => '<basepath>/post_install/install_actions.php',
	),	
	
	'post_uninstall'=>array(
		0 => '<basepath>/post_uninstall/uninstall_actions.php',
	),		
);

?>
