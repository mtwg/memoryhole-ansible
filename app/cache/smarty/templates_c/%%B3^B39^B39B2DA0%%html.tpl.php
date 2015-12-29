<?php /* Smarty version 2.6.11, created on 2014-12-17 08:44:05
         compiled from modules/DynamicFields/templates/Fields/Forms/html.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'sugar_translate', 'modules/DynamicFields/templates/Fields/Forms/html.tpl', 50, false),)), $this); ?>


<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "modules/DynamicFields/templates/Fields/Forms/coreTop.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<tr>
    <td class="mbLBL"><?php echo smarty_function_sugar_translate(array('module' => 'DynamicFields','label' => 'COLUMN_TITLE_HTML_CONTENT'), $this);?>
:</td>
    <td>
    <?php if ($this->_tpl_vars['hideLevel'] < 5): ?>
        <textarea name='htmlarea' id='htmlarea' cols=50 rows=10><?php echo $this->_tpl_vars['HTML_EDITOR']; ?>
</textarea>
        <input type='hidden' name='ext4' id='ext4' value='<?php echo $this->_tpl_vars['cf']['ext4']; ?>
'/>
    <?php else: ?>
        <textarea name='htmlarea' id='htmlarea' cols=50 rows=10 disabled><?php echo $this->_tpl_vars['HTML_EDITOR']; ?>
</textarea>
        <input type='hidden' name='htmlarea' value='<?php echo $this->_tpl_vars['HTML_EDITOR']; ?>
'/>
    <?php endif; ?>
        <br>
    </td>
</tr>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "modules/DynamicFields/templates/Fields/Forms/coreBottom.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<script type="text/javascript" language="Javascript">
SUGAR.ajaxLoad = true;
<?php if ($this->_tpl_vars['hideLevel'] < 5): ?>
    setTimeout("tinyMCE.execCommand('mceAddControl', false, 'htmlarea');", 500);  
	ModuleBuilder.tabPanel.get("activeTab").closeEvent.subscribe(function(){tinyMCE.execCommand('mceRemoveControl', false, 'htmlarea');});
	setTimeout("document.forms.popup_form.required.value = false;YAHOO.util.Dom.getAncestorByTagName(document.forms.popup_form.required, 'tr').style.display='none';", 500);
<?php endif;  echo '
document.popup_form.presave = function(){
    var tiny = tinyMCE.getInstanceById(\'htmlarea\');
    if ( (null != tiny) || ("undefined" != typeof(tiny)) ) {
         document.getElementById(\'ext4\').value = tiny.getContent();
    } else {
         document.getElementById(\'ext4\').value = document.getElementById(\'htmlarea\').value;
    }
    document.getElementById(\'ext4\').style.display = \'\';
};
</script>
'; ?>