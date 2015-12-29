<?php /* Smarty version 2.6.11, created on 2014-12-27 20:08:58
         compiled from cache/modules/Import/legal_lawyersorganization_c.tpl */ ?>

<?php if (strlen ( $this->_tpl_vars['fields']['organization_c']['value'] ) <= 0):  $this->assign('value', $this->_tpl_vars['fields']['organization_c']['default_value']);  else:  $this->assign('value', $this->_tpl_vars['fields']['organization_c']['value']);  endif; ?>  
<input type='text' name='<?php echo $this->_tpl_vars['fields']['organization_c']['name']; ?>
' 
    id='<?php echo $this->_tpl_vars['fields']['organization_c']['name']; ?>
' size='30' 
    maxlength='60' 
    value='<?php echo $this->_tpl_vars['value']; ?>
' title=''  tabindex='1'      >