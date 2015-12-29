<?php /* Smarty version 2.6.11, created on 2014-12-27 20:00:39
         compiled from modules/Import/tpls/step3.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'sugar_help', 'modules/Import/tpls/step3.tpl', 101, false),)), $this); ?>

<?php echo $this->_tpl_vars['CSS']; ?>


<?php echo $this->_tpl_vars['INSTRUCTION']; ?>



<form enctype="multipart/form-data" real_id="importstep3" id="importstep3" name="importstep3" method="POST" action="index.php">
<input type="hidden" name="module" value="Import">
<input type="hidden" name="previous_action" value="Confirm">
<input type="hidden" name="custom_delimiter" value="<?php echo $this->_tpl_vars['CUSTOM_DELIMITER']; ?>
">
<input type="hidden" name="custom_enclosure" value="<?php echo $this->_tpl_vars['CUSTOM_ENCLOSURE']; ?>
">
<input type="hidden" name="import_type" value="<?php echo $this->_tpl_vars['TYPE']; ?>
">
<input type="hidden" name="source" value="<?php echo $_REQUEST['source']; ?>
">
<input type="hidden" name="source_id" value="<?php echo $_REQUEST['source_id']; ?>
">
<input type="hidden" name="action" value="Step3">
<input type="hidden" name="import_module" value="<?php echo $this->_tpl_vars['IMPORT_MODULE']; ?>
">
<input type="hidden" name="has_header" value="<?php echo $this->_tpl_vars['HAS_HEADER']; ?>
">
<input type="hidden" name="tmp_file" value="<?php echo $this->_tpl_vars['TMP_FILE']; ?>
">
<input type="hidden" name="tmp_file_base" value="<?php echo $this->_tpl_vars['TMP_FILE']; ?>
">
<input type="hidden" name="firstrow" value="<?php echo $this->_tpl_vars['FIRSTROW']; ?>
">
<input type="hidden" name="columncount" value ="<?php echo $this->_tpl_vars['COLUMNCOUNT']; ?>
">
<input type="hidden" name="current_step" value="<?php echo $this->_tpl_vars['CURRENT_STEP']; ?>
">
<input type="hidden" name="importlocale_charset" value="<?php echo $_REQUEST['importlocale_charset']; ?>
">
<input type="hidden" name="importlocale_dateformat" value="<?php echo $_REQUEST['importlocale_dateformat']; ?>
">
<input type="hidden" name="importlocale_timeformat" value="<?php echo $_REQUEST['importlocale_timeformat']; ?>
">
<input type="hidden" name="importlocale_timezone" value="<?php echo $_REQUEST['importlocale_timezone']; ?>
">
<input type="hidden" name="importlocale_currency" value="<?php echo $_REQUEST['importlocale_currency']; ?>
">
<input type="hidden" name="importlocale_default_currency_significant_digits" value="<?php echo $_REQUEST['importlocale_default_currency_significant_digits']; ?>
">
<input type="hidden" name="importlocale_num_grp_sep" value="<?php echo $_REQUEST['importlocale_num_grp_sep']; ?>
">
<input type="hidden" name="importlocale_dec_sep" value="<?php echo $_REQUEST['importlocale_dec_sep']; ?>
">
<input type="hidden" name="importlocale_default_locale_name_format" value="<?php echo $_REQUEST['importlocale_default_locale_name_format']; ?>
">
<input type="hidden" name="from_admin_wizard" value="<?php echo $_REQUEST['from_admin_wizard']; ?>
">
    
<br>
<?php if ($this->_tpl_vars['NOTETEXT'] != ''): ?>
    <p>
        <input title="<?php echo $this->_tpl_vars['MOD']['LBL_SHOW_ADVANCED_OPTIONS']; ?>
"  id="toggleNotes" class="button" type="button"
                       name="button" value="  <?php echo $this->_tpl_vars['MOD']['LBL_SHOW_NOTES']; ?>
  ">
        <div id="importNotes" style="display: none;">
            <ul>
                <?php echo $this->_tpl_vars['NOTETEXT']; ?>

            </ul>
        </div>
    </p>
<?php endif; ?>

<div class="hr"></div>


<table border="0" cellspacing="0" cellpadding="0" width="100%" id="importTable" class="detail view">
<?php $_from = $this->_tpl_vars['rows']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['rows'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['rows']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
        $this->_foreach['rows']['iteration']++;
 if (($this->_foreach['rows']['iteration'] <= 1)): ?>
<tr>
    <?php if ($this->_tpl_vars['HAS_HEADER'] == 'on'): ?>
    <th style="text-align: left;" scope="col">
        <b><?php echo $this->_tpl_vars['MOD']['LBL_HEADER_ROW']; ?>
</b>&nbsp;
        <?php echo smarty_function_sugar_help(array('text' => $this->_tpl_vars['MOD']['LBL_HEADER_ROW_HELP']), $this);?>

    </th>
    <?php endif; ?>
    <th style="text-align: left;" scope="col">
        <b><?php echo $this->_tpl_vars['MOD']['LBL_DATABASE_FIELD']; ?>
</b>&nbsp;
        <?php echo smarty_function_sugar_help(array('text' => $this->_tpl_vars['MOD']['LBL_DATABASE_FIELD_HELP']), $this);?>

    </th>
    <th style="text-align: left;" scope="col">
        <b><?php echo $this->_tpl_vars['MOD']['LBL_ROW']; ?>
 1</b>&nbsp;
        <?php echo smarty_function_sugar_help(array('text' => $this->_tpl_vars['MOD']['LBL_ROW_HELP']), $this);?>

    </th>
    <?php if ($this->_tpl_vars['HAS_HEADER'] != 'on'): ?>
    <th style="text-align: left;" scope="col"><b><?php echo $this->_tpl_vars['MOD']['LBL_ROW']; ?>
 2</b></td>
    <?php endif; ?>
    <th scope='col' style="text-align: left;" scope="rcol" id="default_column_header" width="10%">
        <span id="hide_default_link" class="expand">&nbsp;<b id=""><?php echo $this->_tpl_vars['MOD']['LBL_DEFAULT_VALUE']; ?>
</b>&nbsp;
        <?php echo smarty_function_sugar_help(array('text' => $this->_tpl_vars['MOD']['LBL_DEFAULT_VALUE_HELP']), $this);?>
</span>
        <span id="default_column_header_span">&nbsp;</span>
    </th>
</tr>
<?php endif; ?>
<tr>
    <?php if ($this->_tpl_vars['HAS_HEADER'] == 'on'): ?>
    <td id="row_<?php echo ($this->_foreach['rows']['iteration']-1); ?>
_header"><?php echo $this->_tpl_vars['item']['cell1']; ?>
</td>
    <?php endif; ?>
    <td valign="top" align="left" id="row_<?php echo ($this->_foreach['rows']['iteration']-1); ?>
_col_0">
        <select class='fixedwidth' name="colnum_<?php echo ($this->_foreach['rows']['iteration']-1); ?>
">
            <option value="-1"><?php echo $this->_tpl_vars['MOD']['LBL_DONT_MAP']; ?>
</option>
            <?php echo $this->_tpl_vars['item']['field_choices']; ?>

        </select>
    </td>
    <?php if ($this->_tpl_vars['item']['show_remove']): ?>
    <td colspan="2">
        <input title="<?php echo $this->_tpl_vars['MOD']['LBL_REMOVE_ROW']; ?>
" 
            id="deleterow_<?php echo ($this->_foreach['rows']['iteration']-1); ?>
" class="button" type="button"
            value="  <?php echo $this->_tpl_vars['MOD']['LBL_REMOVE_ROW']; ?>
  ">
    </td>
    <?php else: ?>
    <?php if ($this->_tpl_vars['HAS_HEADER'] != 'on'): ?>
    <td id="row_<?php echo ($this->_foreach['rows']['iteration']-1); ?>
_col_1" scope="row"><?php echo $this->_tpl_vars['item']['cell1']; ?>
</td>
    <?php endif; ?>
    <td id="row_<?php echo ($this->_foreach['rows']['iteration']-1); ?>
_col_2" scope="row" colspan="2"><?php echo $this->_tpl_vars['item']['cell2']; ?>
</td>
    <?php endif; ?>
    <td id="defaultvaluepicker_<?php echo ($this->_foreach['rows']['iteration']-1); ?>
" nowrap="nowrap">
        <?php echo $this->_tpl_vars['item']['default_field']; ?>

    </td>
</tr>
<?php endforeach; endif; unset($_from); ?>
<tr>
    <td align="left" colspan="4">
        <input title="<?php echo $this->_tpl_vars['MOD']['LBL_ADD_ROW']; ?>
"  id="addrow" class="button" type="button"
            name="button" value="  <?php echo $this->_tpl_vars['MOD']['LBL_ADD_ROW']; ?>
  "> <?php echo smarty_function_sugar_help(array('text' => $this->_tpl_vars['MOD']['LBL_ADD_FIELD_HELP']), $this);?>

        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    </td>
</tr>
</table>

<br />

<table width="100%" cellpadding="2" cellspacing="0" border="0">
<tr>
    <td align="left">
        <input title="<?php echo $this->_tpl_vars['MOD']['LBL_BACK']; ?>
"  id="goback" class="button" type="submit" name="button" value="  <?php echo $this->_tpl_vars['MOD']['LBL_BACK']; ?>
  ">&nbsp;
        <input title="<?php echo $this->_tpl_vars['MOD']['LBL_NEXT']; ?>
"  id="gonext" class="button" type="submit" name="button" value="  <?php echo $this->_tpl_vars['MOD']['LBL_NEXT']; ?>
  ">
    </td>
</tr>
</table>

<?php echo $this->_tpl_vars['QS_JS']; ?>