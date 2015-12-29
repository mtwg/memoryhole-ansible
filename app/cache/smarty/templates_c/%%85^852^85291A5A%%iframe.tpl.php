<?php /* Smarty version 2.6.11, created on 2014-12-17 08:44:45
         compiled from modules/DynamicFields/templates/Fields/Forms/iframe.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'sugar_translate', 'modules/DynamicFields/templates/Fields/Forms/iframe.tpl', 50, false),array('function', 'html_options', 'modules/DynamicFields/templates/Fields/Forms/iframe.tpl', 70, false),array('modifier', 'default', 'modules/DynamicFields/templates/Fields/Forms/iframe.tpl', 79, false),)), $this); ?>


<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "modules/DynamicFields/templates/Fields/Forms/coreTop.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<input type=hidden id='ext3' name='ext3' value='<?php echo $this->_tpl_vars['vardef']['gen']; ?>
'>
<tr>
	<td class='mbLBL'><?php echo smarty_function_sugar_translate(array('module' => 'DynamicFields','label' => 'LBL_GENERATE_URL'), $this);?>
:</td>
	<td>
	<?php if ($this->_tpl_vars['hideLevel'] < 5): ?>
		<input type='checkbox' id='gencheck' <?php if ($this->_tpl_vars['vardef']['gen']): ?>checked=true<?php endif; ?> name='genCheck' value="0" onclick="
			if(this.checked) {
				 YAHOO.util.Dom.setStyle('fieldListHelper', 'display', '');
				 YAHOO.util.Dom.get('ext3').value = 1;
				 addToValidate('popup_form', 'default', 'alphanumeric', true,'<?php echo smarty_function_sugar_translate(array('module' => 'DynamicFields','label' => 'COLUMN_TITLE_DEFAULT_VALUE'), $this);?>
' );
			} else {
		        YAHOO.util.Dom.setStyle('fieldListHelper', 'display', 'none');
		        YAHOO.util.Dom.get('ext3').value = 0;
				removeFromValidate('popup_form', 'default');
			}">
	<?php else: ?>
		<input type='checkbox' name='ext3' <?php if ($this->_tpl_vars['vardef']['gen']): ?>checked=true<?php endif; ?> disabled>
	<?php endif; ?>
	</td>
</tr>
<tr id='fieldListHelper' <?php if (! $this->_tpl_vars['vardef']['gen']): ?>style="display:none"<?php endif; ?>>
	<td></td>
	<td><?php echo smarty_function_html_options(array('name' => 'flo','id' => 'fieldListOptions','options' => $this->_tpl_vars['fieldOpts']), $this);?>

		<input type='button' class='button' value="Insert Field" onclick="
			YAHOO.util.Dom.get('default').value += '{' + YAHOO.util.Dom.get('fieldListOptions').value + '}'
		"></td> 
</tr>
<tr>
	<td class='mbLBL'><?php echo smarty_function_sugar_translate(array('module' => 'DynamicFields','label' => 'COLUMN_TITLE_DEFAULT_VALUE'), $this);?>
:</td>
	<td>
	<?php if ($this->_tpl_vars['hideLevel'] < 5): ?>
		<input type='text' name='default' id='default' value='<?php echo $this->_tpl_vars['vardef']['default']; ?>
' maxlength='<?php echo ((is_array($_tmp=@$this->_tpl_vars['vardef']['len'])) ? $this->_run_mod_handler('default', true, $_tmp, 50) : smarty_modifier_default($_tmp, 50)); ?>
'>
	<?php else: ?>
		<input type='hidden' id='default' name='default' value='<?php echo $this->_tpl_vars['vardef']['default']; ?>
'><?php echo $this->_tpl_vars['vardef']['default']; ?>

	<?php endif; ?>
	</td>
</tr>
<tr>
	<td class='mbLBL'><?php echo smarty_function_sugar_translate(array('module' => 'DynamicFields','label' => 'COLUMN_TITLE_MAX_SIZE'), $this);?>
:</td>
	<td>
	<?php if ($this->_tpl_vars['hideLevel'] < 5): ?>
		<input type='text' name='len' value='<?php echo ((is_array($_tmp=@$this->_tpl_vars['vardef']['len'])) ? $this->_run_mod_handler('default', true, $_tmp, 25) : smarty_modifier_default($_tmp, 25)); ?>
' onchange="forceRange(this,1,255);changeMaxLength(document.getElementById('default'),this.value);">
		<?php echo '
		<script>
		function forceRange(field, min, max){
			field.value = parseInt(field.value);
			if(field.value == \'NaN\')field.value = max;
			if(field.value > max) field.value = max;
			if(field.value < min) field.value = min;
		}
		function changeMaxLength(field, length){
			field.maxLength = parseInt(length);
			field.value = field.value.substr(0, field.maxLength);
		}
		</script>
		'; ?>

	<?php else: ?>
		<input type='hidden' name='len' value='<?php echo $this->_tpl_vars['vardef']['len']; ?>
'><?php echo $this->_tpl_vars['vardef']['len']; ?>

	<?php endif; ?>
	</td>
</tr>
<tr>
	<td class='mbLBL'><?php echo smarty_function_sugar_translate(array('module' => 'DynamicFields','label' => 'COLUMN_TITLE_FRAME_HEIGHT'), $this);?>
:</td>
	<td>
	<?php if ($this->_tpl_vars['hideLevel'] < 5): ?>
		<input type='text' name='ext4' value='<?php echo ((is_array($_tmp=@$this->_tpl_vars['vardef']['height'])) ? $this->_run_mod_handler('default', true, $_tmp, 200) : smarty_modifier_default($_tmp, 200)); ?>
' onchange="forceRange(this,100,1024);">
	<?php else: ?>
		<input type='hidden' name='ext4' value='<?php echo $this->_tpl_vars['vardef']['height']; ?>
'><?php echo $this->_tpl_vars['vardef']['height']; ?>

	<?php endif; ?>
	</td>
</tr>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "modules/DynamicFields/templates/Fields/Forms/coreBottom.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>