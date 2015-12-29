<?php /* Smarty version 2.6.11, created on 2014-12-29 15:07:13
         compiled from modules/Import/tpls/undo.tpl */ ?>
<br>
<?php if ($this->_tpl_vars['UNDO_SUCCESS']): ?>
<h3><?php echo $this->_tpl_vars['MOD']['LBL_LAST_IMPORT_UNDONE']; ?>
</h3>
<?php else: ?>
<h3><?php echo $this->_tpl_vars['MOD']['LBL_NO_IMPORT_TO_UNDO']; ?>
</h3>
<?php endif; ?>
<br />
<form enctype="multipart/form-data" name="importundo" method="POST" action="index.php" id="importundo">
<input type="hidden" name="module" value="Import">
<input type="hidden" name="action" value="Step1">
<input type="hidden" name="import_module" value="<?php echo $this->_tpl_vars['IMPORT_MODULE']; ?>
">
<table width="100%" cellpadding="2" cellspacing="0" border="0">
<tr>
    <td align="left">
       <input title="<?php echo $this->_tpl_vars['MOD']['LBL_MODULE_NAME']; ?>
&nbsp;<?php echo $this->_tpl_vars['MODULENAME']; ?>
"  class="button" type="submit" name="button"
            value="<?php echo $this->_tpl_vars['MOD']['LBL_MODULE_NAME']; ?>
&nbsp;<?php echo $this->_tpl_vars['MODULENAME']; ?>
">

        <input title="<?php echo $this->_tpl_vars['MOD']['LBL_FINISHED'];  echo $this->_tpl_vars['MODULENAME']; ?>
"  class="button" type="submit"
            name="finished" id="finished" value="<?php echo $this->_tpl_vars['MOD']['LBL_IMPORT_COMPLETE']; ?>
">
    </td>
</tr>
</table>
<br />
</form>
