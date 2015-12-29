<?php /* Smarty version 2.6.11, created on 2014-12-29 15:09:04
         compiled from cache/modules/Import/legal_arresteesbadge_number.tpl */ ?>

<?php if (strlen ( $this->_tpl_vars['fields']['badge_number']['value'] ) <= 0):  $this->assign('value', $this->_tpl_vars['fields']['badge_number']['default_value']);  else:  $this->assign('value', $this->_tpl_vars['fields']['badge_number']['value']);  endif; ?>  
<input type='text' name='<?php echo $this->_tpl_vars['fields']['badge_number']['name']; ?>
' 
    id='<?php echo $this->_tpl_vars['fields']['badge_number']['name']; ?>
' size='30' 
    maxlength='25' 
    value='<?php echo $this->_tpl_vars['value']; ?>
' title=''  tabindex='1'      >