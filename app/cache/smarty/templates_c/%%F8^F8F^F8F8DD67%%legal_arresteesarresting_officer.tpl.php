<?php /* Smarty version 2.6.11, created on 2014-12-29 15:09:01
         compiled from cache/modules/Import/legal_arresteesarresting_officer.tpl */ ?>

<?php if (strlen ( $this->_tpl_vars['fields']['arresting_officer']['value'] ) <= 0):  $this->assign('value', $this->_tpl_vars['fields']['arresting_officer']['default_value']);  else:  $this->assign('value', $this->_tpl_vars['fields']['arresting_officer']['value']);  endif; ?>  
<input type='text' name='<?php echo $this->_tpl_vars['fields']['arresting_officer']['name']; ?>
' 
    id='<?php echo $this->_tpl_vars['fields']['arresting_officer']['name']; ?>
' size='30' 
    maxlength='25' 
    value='<?php echo $this->_tpl_vars['value']; ?>
' title=''  tabindex='1'      >