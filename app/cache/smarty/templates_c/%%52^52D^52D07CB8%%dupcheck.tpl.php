<?php /* Smarty version 2.6.11, created on 2014-12-27 20:09:54
         compiled from modules/Import/tpls/dupcheck.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'sugar_help', 'modules/Import/tpls/dupcheck.tpl', 112, false),)), $this); ?>
<?php echo '
<style>
<!--

#DupeCheck{
    border: none;
    box-shadow:none;
}

#selected_indices
{
    padding-left:30px;
    padding-right:30px;
}


-->
</style>
'; ?>


<?php echo $this->_tpl_vars['INSTRUCTION']; ?>

<form enctype="multipart/form-data" real_id="importstepdup" id="importstepdup" name="importstepdup" method="POST" action="index.php">

<?php $_from = $_REQUEST; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
    <?php if ($this->_tpl_vars['k'] != 'current_step'): ?>
        <?php if (is_array ( $this->_tpl_vars['v'] )): ?>
            <?php $_from = $this->_tpl_vars['v']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k1'] => $this->_tpl_vars['v1']):
?>
                <input type="hidden" name="<?php echo $this->_tpl_vars['k']; ?>
[]" value="<?php echo $this->_tpl_vars['v1']; ?>
">
            <?php endforeach; endif; unset($_from); ?>
        <?php else: ?>
            <input type="hidden" name="<?php echo $this->_tpl_vars['k']; ?>
" value="<?php echo $this->_tpl_vars['v']; ?>
">
        <?php endif; ?>
    <?php endif;  endforeach; endif; unset($_from); ?>

<input type="hidden" name="module" value="Import">
<input type="hidden" name="import_type" value="<?php echo $_REQUEST['import_type']; ?>
">
<input type="hidden" name="type" value="<?php echo $_REQUEST['type']; ?>
">
<input type="hidden" name="file_name" value="<?php echo $_REQUEST['tmp_file']; ?>
">
<input type="hidden" name="source_id" value="<?php echo $this->_tpl_vars['SOURCE_ID']; ?>
">
<input type="hidden" name="to_pdf" value="1">
<input type="hidden" name="display_tabs_def">
<input type="hidden" id="enabled_dupes" name="enabled_dupes" value="">
<input type="hidden" id="disabled_dupes" name="disabled_dupes" value="">
<input type="hidden" id="current_step" name="current_step" value="<?php echo $this->_tpl_vars['CURRENT_STEP']; ?>
">

   <div class="hr"></div>
    <div>
    <table border="0" cellpadding="30" id="importTable" style="width:60% !important;">
    <tr>
        <td  width="40%" colspan="2">
           <table id="DupeCheck" class="themeSettings edit view noBorder" style='margin-bottom:0px;' border="0" cellspacing="10" cellpadding="0"  width = '100%'>
                <tr>
                    <td align="right">
                        <div id="enabled_div" class="enabled_tab_workarea">
                        </div>
                    </td>
                    <td align="left">
                        <div id="disabled_div" class="disabled_tab_workarea">
                        </div>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    </table>
     <div class="hr"></div>
    <span><strong><label for="save_map_as"><?php echo $this->_tpl_vars['MOD']['LBL_SAVE_MAPPING_AS']; ?>
</label></strong> <?php echo smarty_function_sugar_help(array('text' => $this->_tpl_vars['MOD']['LBL_SAVE_MAPPING_HELP']), $this);?>
</span>
            <span >
                <input type="text" name="save_map_as" id="save_map_as" value="" style="width: 20em" maxlength="254">
            </span>
    </div>
<br />

<table width="100%" cellpadding="2" cellspacing="0" border="0">
    <tr>
        <td align="left">
            <input title="<?php echo $this->_tpl_vars['MOD']['LBL_BACK']; ?>
"  id="goback" class="button" type="submit" name="button" value="  <?php echo $this->_tpl_vars['MOD']['LBL_BACK']; ?>
  ">&nbsp;
            <input title="<?php echo $this->_tpl_vars['MOD']['LBL_IMPORT_NOW']; ?>
"  id="importnow" class="button" type="button" name="button" value="  <?php echo $this->_tpl_vars['MOD']['LBL_IMPORT_NOW']; ?>
  ">
        </td>
    </tr>
</table>
</form>

