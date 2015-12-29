<?php /* Smarty version 2.6.11, created on 2014-12-29 15:08:35
         compiled from cache/modules/Import/legal_arresteesarrest_time.tpl */ ?>

<?php if (empty ( $this->_tpl_vars['fields']['arrest_time']['value'] )):  $this->assign('value', $this->_tpl_vars['fields']['arrest_time']['default_value']);  else:  $this->assign('value', $this->_tpl_vars['fields']['arrest_time']['value']);  endif; ?>  




<textarea  id='<?php echo $this->_tpl_vars['fields']['arrest_time']['name']; ?>
' name='<?php echo $this->_tpl_vars['fields']['arrest_time']['name']; ?>
'
rows="4" 
cols="60" 
title='' tabindex="1" 
 ><?php echo $this->_tpl_vars['value']; ?>
</textarea>

