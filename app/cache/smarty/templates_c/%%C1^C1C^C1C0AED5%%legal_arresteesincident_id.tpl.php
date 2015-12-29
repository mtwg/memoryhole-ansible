<?php /* Smarty version 2.6.11, created on 2014-12-29 15:02:37
         compiled from cache/modules/Import/legal_arresteesincident_id.tpl */ ?>

<?php if (strlen ( $this->_tpl_vars['fields']['incident_id']['value'] ) <= 0):  $this->assign('value', $this->_tpl_vars['fields']['incident_id']['default_value']);  else:  $this->assign('value', $this->_tpl_vars['fields']['incident_id']['value']);  endif; ?>  
<input type='text' name='<?php echo $this->_tpl_vars['fields']['incident_id']['name']; ?>
' 
    id='<?php echo $this->_tpl_vars['fields']['incident_id']['name']; ?>
' size='30' 
    maxlength='30' 
    value='<?php echo $this->_tpl_vars['value']; ?>
' title=''  tabindex='1'      >