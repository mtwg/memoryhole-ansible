<?php /* Smarty version 2.6.11, created on 2014-12-29 15:09:12
         compiled from cache/modules/Import/legal_arresteescitation_number.tpl */ ?>

<?php if (strlen ( $this->_tpl_vars['fields']['citation_number']['value'] ) <= 0):  $this->assign('value', $this->_tpl_vars['fields']['citation_number']['default_value']);  else:  $this->assign('value', $this->_tpl_vars['fields']['citation_number']['value']);  endif; ?>  
<input type='text' name='<?php echo $this->_tpl_vars['fields']['citation_number']['name']; ?>
' 
    id='<?php echo $this->_tpl_vars['fields']['citation_number']['name']; ?>
' size='30' 
    maxlength='60' 
    value='<?php echo $this->_tpl_vars['value']; ?>
' title=''  tabindex='1'      >