<?php /* Smarty version 2.6.11, created on 2014-12-29 15:07:40
         compiled from cache/modules/Import/legal_arresteesemail.tpl */ ?>

<?php if (strlen ( $this->_tpl_vars['fields']['email']['value'] ) <= 0):  $this->assign('value', $this->_tpl_vars['fields']['email']['default_value']);  else:  $this->assign('value', $this->_tpl_vars['fields']['email']['value']);  endif; ?>  
<input type='text' name='<?php echo $this->_tpl_vars['fields']['email']['name']; ?>
' 
    id='<?php echo $this->_tpl_vars['fields']['email']['name']; ?>
' size='30' 
    maxlength='70' 
    value='<?php echo $this->_tpl_vars['value']; ?>
' title=''  tabindex='1'      >