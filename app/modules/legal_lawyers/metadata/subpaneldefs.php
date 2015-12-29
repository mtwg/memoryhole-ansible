<?php
$layout_defs['legal_lawyers']['subpanel_setup']['legal_arrestees'] = array(  //Note: legal_arrestees in this line must be lowercase
'order' => 99, 
'module' => 'legal_arrestees', 
'subpanel_name' => 'default', 
'refresh_page' => 1, 
'get_subpanel_data' => 'arrestees',  // matches the name of the link field
'title_key' => 'Arrestees', 
'top_buttons' => array(
array('widget_class' => 'SubPanelTopCreateButton'),
array('widget_class' => 'SubPanelTopSelectButton', 'mode'=>'MultiSelect')
), 
); 

?>
