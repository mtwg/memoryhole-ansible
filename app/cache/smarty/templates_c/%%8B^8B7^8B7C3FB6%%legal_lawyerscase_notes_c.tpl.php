<?php /* Smarty version 2.6.11, created on 2014-12-27 20:09:33
         compiled from cache/modules/Import/legal_lawyerscase_notes_c.tpl */ ?>

<?php if (empty ( $this->_tpl_vars['fields']['case_notes_c']['value'] )):  $this->assign('value', $this->_tpl_vars['fields']['case_notes_c']['default_value']);  else:  $this->assign('value', $this->_tpl_vars['fields']['case_notes_c']['value']);  endif; ?>  




<textarea  id='<?php echo $this->_tpl_vars['fields']['case_notes_c']['name']; ?>
' name='<?php echo $this->_tpl_vars['fields']['case_notes_c']['name']; ?>
'
rows="4" 
cols="20" 
title='' tabindex="1" 
 ><?php echo $this->_tpl_vars['value']; ?>
</textarea>

