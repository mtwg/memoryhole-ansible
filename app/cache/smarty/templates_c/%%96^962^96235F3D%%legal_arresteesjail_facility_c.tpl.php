<?php /* Smarty version 2.6.11, created on 2014-12-29 15:09:21
         compiled from cache/modules/Import/legal_arresteesjail_facility_c.tpl */ ?>

<?php if (strlen ( $this->_tpl_vars['fields']['jail_facility_c']['value'] ) <= 0):  $this->assign('value', $this->_tpl_vars['fields']['jail_facility_c']['default_value']);  else:  $this->assign('value', $this->_tpl_vars['fields']['jail_facility_c']['value']);  endif; ?>  
<input type='text' name='<?php echo $this->_tpl_vars['fields']['jail_facility_c']['name']; ?>
' 
    id='<?php echo $this->_tpl_vars['fields']['jail_facility_c']['name']; ?>
' size='30' 
    maxlength='25' 
    value='<?php echo $this->_tpl_vars['value']; ?>
' title=''  tabindex='1'      >