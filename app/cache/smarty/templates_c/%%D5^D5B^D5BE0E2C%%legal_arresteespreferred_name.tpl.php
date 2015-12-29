<?php /* Smarty version 2.6.11, created on 2014-12-29 15:07:40
         compiled from cache/modules/Import/legal_arresteespreferred_name.tpl */ ?>

<?php if (strlen ( $this->_tpl_vars['fields']['preferred_name']['value'] ) <= 0):  $this->assign('value', $this->_tpl_vars['fields']['preferred_name']['default_value']);  else:  $this->assign('value', $this->_tpl_vars['fields']['preferred_name']['value']);  endif; ?>  
<input type='text' name='<?php echo $this->_tpl_vars['fields']['preferred_name']['name']; ?>
' 
    id='<?php echo $this->_tpl_vars['fields']['preferred_name']['name']; ?>
' size='30' 
    maxlength='60' 
    value='<?php echo $this->_tpl_vars['value']; ?>
' title=''  tabindex='1'      >