<?php /* Smarty version 2.6.11, created on 2014-12-29 15:08:46
         compiled from cache/modules/Import/legal_arresteesarrest_time_c.tpl */ ?>

<?php if (strlen ( $this->_tpl_vars['fields']['arrest_time_c']['value'] ) <= 0):  $this->assign('value', $this->_tpl_vars['fields']['arrest_time_c']['default_value']);  else:  $this->assign('value', $this->_tpl_vars['fields']['arrest_time_c']['value']);  endif; ?>  
<input type='text' name='<?php echo $this->_tpl_vars['fields']['arrest_time_c']['name']; ?>
' 
    id='<?php echo $this->_tpl_vars['fields']['arrest_time_c']['name']; ?>
' size='30' 
    maxlength='25' 
    value='<?php echo $this->_tpl_vars['value']; ?>
' title=''  tabindex='1'      >