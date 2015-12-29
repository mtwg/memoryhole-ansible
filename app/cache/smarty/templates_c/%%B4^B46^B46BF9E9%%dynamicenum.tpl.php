<?php /* Smarty version 2.6.11, created on 2014-12-17 08:43:14
         compiled from custom/modules/DynamicFields/templates/Fields/Forms/dynamicenum.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'sugar_translate', 'custom/modules/DynamicFields/templates/Fields/Forms/dynamicenum.tpl', 49, false),array('function', 'html_options', 'custom/modules/DynamicFields/templates/Fields/Forms/dynamicenum.tpl', 52, false),)), $this); ?>

 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "modules/DynamicFields/templates/Fields/Forms/coreTop.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<tr>
	<td class='mbLBL'><?php echo smarty_function_sugar_translate(array('module' => 'DynamicFields','label' => 'LBL_DROP_DOWN_LIST'), $this);?>
:</td>
	<td>
	<?php if ($this->_tpl_vars['hideLevel'] < 5 && empty ( $this->_tpl_vars['vardef']['function'] )): ?>
		<?php echo smarty_function_html_options(array('name' => 'options','id' => 'options','selected' => $this->_tpl_vars['selected_dropdown'],'values' => $this->_tpl_vars['dropdowns'],'output' => $this->_tpl_vars['dropdowns'],'onChange' => "ModuleBuilder.dropdownChanged(this.value);"), $this); if (! $this->_tpl_vars['uneditable']): ?><br><input type='button' value='<?php echo smarty_function_sugar_translate(array('module' => 'DynamicFields','label' => 'LBL_BTN_EDIT'), $this);?>
' class='button' onclick="ModuleBuilder.moduleDropDown(this.form.options.value, this.form.options.value);">&nbsp;<input type='button' value='<?php echo smarty_function_sugar_translate(array('module' => 'DynamicFields','label' => 'LBL_BTN_ADD'), $this);?>
' class='button' onclick="ModuleBuilder.moduleDropDown('', this.form.name.value);"><?php endif; ?>
	<?php else: ?>
		<input type='hidden' name='options' value='<?php echo $this->_tpl_vars['selected_dropdown']; ?>
'><?php echo $this->_tpl_vars['selected_dropdown']; ?>

	<?php endif; ?>
	</td>
</tr>
<tr>
    <td class='mbLBL' ><?php echo smarty_function_sugar_translate(array('module' => 'DynamicFields','label' => 'COLUMN_TITLE_PARENT_ENUM'), $this);?>
:</td>
    <td>
           <input type="text" id="parentenum"  name="parentenum" value="<?php echo $this->_tpl_vars['vardef']['parentenum']; ?>
" />
    </td>
</tr>
<tr>
	<td class='mbLBL' ><?php echo smarty_function_sugar_translate(array('module' => 'DynamicFields','label' => 'COLUMN_TITLE_MASS_UPDATE'), $this);?>
:</td>
	<td>
	<?php if ($this->_tpl_vars['hideLevel'] < 5): ?>
		<input type="checkbox" id="massupdate"  name="massupdate" value="1" <?php if (! empty ( $this->_tpl_vars['vardef']['massupdate'] )): ?>checked<?php endif; ?>/>
	<?php else: ?>
		<input type="checkbox" id="massupdate"  name="massupdate" value="1" disabled <?php if (! empty ( $this->_tpl_vars['vardef']['massupdate'] )): ?>checked<?php endif; ?>/>
	<?php endif; ?>
	</td>
</tr>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "modules/DynamicFields/templates/Fields/Forms/coreBottom.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>