<?php /* Smarty version 2.6.11, created on 2014-12-29 15:08:49
         compiled from cache/modules/Import/legal_arresteesarrest_location.tpl */ ?>

<?php if (strlen ( $this->_tpl_vars['fields']['arrest_location']['value'] ) <= 0):  $this->assign('value', $this->_tpl_vars['fields']['arrest_location']['default_value']);  else:  $this->assign('value', $this->_tpl_vars['fields']['arrest_location']['value']);  endif; ?>  
<input type='text' name='<?php echo $this->_tpl_vars['fields']['arrest_location']['name']; ?>
' 
    id='<?php echo $this->_tpl_vars['fields']['arrest_location']['name']; ?>
' size='30' 
    maxlength='25' 
    value='<?php echo $this->_tpl_vars['value']; ?>
' title=''  tabindex='1'      >