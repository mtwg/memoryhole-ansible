<?php /* Smarty version 2.6.11, created on 2014-12-27 20:00:18
         compiled from modules/Import/tpls/confirm.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'sugar_help', 'modules/Import/tpls/confirm.tpl', 78, false),array('function', 'html_options', 'modules/Import/tpls/confirm.tpl', 134, false),)), $this); ?>

<?php echo $this->_tpl_vars['INSTRUCTION']; ?>


<div class="hr"></div>

<form enctype="multipart/form-data" real_id="importconfirm" id="importconfirm" name="importconfirm" method="POST" action="index.php">
<input type="hidden" name="module" value="Import">
<input type="hidden" name="type" value="<?php echo $this->_tpl_vars['TYPE']; ?>
">
<input type="hidden" name="source" id="source" value="<?php echo $this->_tpl_vars['SOURCE']; ?>
">
<input type="hidden" name="source_id" value="<?php echo $this->_tpl_vars['SOURCE_ID']; ?>
">
<input type="hidden" name="action" value="Step3">
<input type="hidden" name="import_module" value="<?php echo $this->_tpl_vars['IMPORT_MODULE']; ?>
">
<input type="hidden" name="import_type" value="<?php echo $this->_tpl_vars['TYPE']; ?>
">
<input type="hidden" name="file_name" value="<?php echo $this->_tpl_vars['FILE_NAME']; ?>
">
<input type="hidden" name="current_step" value="<?php echo $this->_tpl_vars['CURRENT_STEP']; ?>
">
<input type="hidden" name="from_admin_wizard" value="<?php echo $_REQUEST['from_admin_wizard']; ?>
">
    
<?php if ($this->_tpl_vars['AUTO_DETECT_ERROR'] != ''): ?>
    <div class="errorMessage">
        <span class="error"><?php echo $this->_tpl_vars['AUTO_DETECT_ERROR']; ?>
</span>
    </div>
<?php endif; ?>

<div id="confirm_table" class="confirmTable">
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'modules/Import/tpls/confirm_table.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</div>



    <table cellpadding="0" cellspacing="0" width="100%">
        <tr>
            <td align="left" colspan="4" style="background: transparent;">
                <input title="<?php echo $this->_tpl_vars['MOD']['LBL_SHOW_ADVANCED_OPTIONS']; ?>
"  id="toggleImportOptions" class="button" type="button"
                       name="button" value="  <?php echo $this->_tpl_vars['MOD']['LBL_SHOW_ADVANCED_OPTIONS']; ?>
  "> <?php echo smarty_function_sugar_help(array('text' => $this->_tpl_vars['MOD']['LBL_IMPORT_FILE_SETTINGS_HELP']), $this);?>

            </td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>
            <div style="overflow: auto; width: 1056px;">
                <table border=0 class="edit view noBorder" style="display: none;" id="importOptions">
                    <tr>
                        <td scope="col">
                            <slot><label for="importlocale_charset"><?php echo $this->_tpl_vars['MOD']['LBL_CHARSET']; ?>
</label></slot>
                        </td>
                        <td>
                            <slot><select tabindex='4' id='importlocale_charset'  name='importlocale_charset'><?php echo $this->_tpl_vars['CHARSETOPTIONS']; ?>
</select></slot>
                        </td>
                        <td scope="col">
                            <slot><label for="custom_delimiter"><?php echo $this->_tpl_vars['MOD']['LBL_CUSTOM_DELIMITER']; ?>
</label></slot>
                        </td>
                        <td>
                            <slot>
                                <select name="custom_delimiter" id="custom_delimiter"> <?php echo $this->_tpl_vars['IMPORT_DELIMETER_OPTIONS']; ?>
</select>
                                <input type="text" name="custom_delimiter_other" id="custom_delimiter_other" style="display: none; width: 5em;" maxlength="1" />
                                <?php echo smarty_function_sugar_help(array('text' => $this->_tpl_vars['MOD']['LBL_FIELD_DELIMETED_HELP']), $this);?>

                            </slot>
                        </td>
                    </tr>
                    <tr>
                        <td scope="col">
                            <slot><label for="custom_enclosure"><?php echo $this->_tpl_vars['MOD']['LBL_CUSTOM_ENCLOSURE']; ?>
</label></slot>
                        </td>
                        <td>
                            <slot>
                                <select name="custom_enclosure" id="custom_enclosure">
                                <?php echo $this->_tpl_vars['IMPORT_ENCLOSURE_OPTIONS']; ?>

                                </select>
                                <input type="text" name="custom_enclosure_other" id="custom_enclosure_other" style="display: none; width: 5em;" maxlength="1" />
                            <?php echo smarty_function_sugar_help(array('text' => $this->_tpl_vars['MOD']['LBL_ENCLOSURE_HELP']), $this);?>

                            </slot>
                        </td>
                        <td scope="col">
                        <label for="has_header"><?php echo $this->_tpl_vars['MOD']['LBL_HAS_HEADER']; ?>
</label>
                        </td>
                        <td>
                            <input class="checkBox" value='on' type="checkbox" name="has_header" id="has_header" <?php echo $this->_tpl_vars['HAS_HEADER_CHECKED']; ?>
> <?php echo smarty_function_sugar_help(array('text' => $this->_tpl_vars['MOD']['LBL_HEADER_ROW_OPTION_HELP']), $this);?>

                        </td>
                    </tr>
                    <tr>
                        <td scope="col"><slot><label for="importlocale_dateformat"><?php echo $this->_tpl_vars['MOD']['LBL_DATE_FORMAT']; ?>
</label></slot></td>
                        <td ><slot><select tabindex='4' name='importlocale_dateformat' id='importlocale_dateformat'><?php echo $this->_tpl_vars['DATEOPTIONS']; ?>
</select></slot></td>
                        <td scope="col"><slot><label for="importlocale_time_format"><?php echo $this->_tpl_vars['MOD']['LBL_TIME_FORMAT']; ?>
</label></slot></td>
                        <td ><slot><select tabindex='4' id='importlocale_time_format' name='importlocale_timeformat'><?php echo $this->_tpl_vars['TIMEOPTIONS']; ?>
</select></slot></td>
                    </tr>
                    <tr>
                        <td scope="col"><slot><label for="importlocale_timezone"><?php echo $this->_tpl_vars['MOD']['LBL_TIMEZONE']; ?>
</label></slot></td>
                        <td ><slot><select tabindex='4' name='importlocale_timezone' id='importlocale_timezone'><?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['TIMEZONEOPTIONS'],'selected' => $this->_tpl_vars['TIMEZONE_CURRENT']), $this);?>
</select></slot></td>
                        <td scope="col"><slot><label for="currency_select"><?php echo $this->_tpl_vars['MOD']['LBL_CURRENCY']; ?>
</label></slot></td>
                        <td ><slot>
                            <select tabindex='4' id='currency_select' name='importlocale_currency' onchange='setSymbolValue(this.selectedIndex);setSigDigits();'><?php echo $this->_tpl_vars['CURRENCY']; ?>
</select>
                            <input type="hidden" id="symbol" value="">
                        </slot></td>
                    </tr>
                    <tr>
                        <td scope="col"><slot><label for="sigDigits"><?php echo $this->_tpl_vars['MOD']['LBL_CURRENCY_SIG_DIGITS']; ?>
:</label></slot></td>
                        <td ><slot><select id='sigDigits' onchange='setSigDigits(this.value);' name='importlocale_default_currency_significant_digits'><?php echo $this->_tpl_vars['sigDigits']; ?>
</select>
                        </slot></td>
                        <td scope="col"><slot><i><?php echo $this->_tpl_vars['MOD']['LBL_LOCALE_EXAMPLE_NAME_FORMAT']; ?>
</i>:</slot></td>
                        <td ><slot><input type="text" disabled id="sigDigitsExample" name="sigDigitsExample"></slot></td>
                    </tr>
                    <tr>
                        <td scope="col"><slot><label for="default_number_grouping_seperator"><?php echo $this->_tpl_vars['MOD']['LBL_NUMBER_GROUPING_SEP']; ?>
</label></slot></td>
                        <td ><slot>
                            <input tabindex='4' name='importlocale_num_grp_sep' id='default_number_grouping_seperator'
                                   type='text' maxlength='1' size='1' value='<?php echo $this->_tpl_vars['NUM_GRP_SEP']; ?>
' onkeydown='setSigDigits();' onkeyup='setSigDigits();'>
                        </slot></td>
                        <td scope="col"><slot><label for="default_decimal_seperator"><?php echo $this->_tpl_vars['MOD']['LBL_DECIMAL_SEP']; ?>
</label></slot></td>
                        <td ><slot>
                            <input tabindex='4' name='importlocale_dec_sep' id='default_decimal_seperator'
                                   type='text' maxlength='1' size='1' value='<?php echo $this->_tpl_vars['DEC_SEP']; ?>
' onkeydown='setSigDigits();' onkeyup='setSigDigits();'>
                        </slot></td>
                    </tr>
                    <tr>
                        <td scope="col" valign="top"><label for="default_locale_name_format"><?php echo $this->_tpl_vars['MOD']['LBL_LOCALE_DEFAULT_NAME_FORMAT']; ?>
</label>: </td>
                        <td  valign="top">
                            <input onkeyup="setPreview();" onkeydown="setPreview();" id="default_locale_name_format" type="text" tabindex='4' name="importlocale_default_locale_name_format" value="<?php echo $this->_tpl_vars['default_locale_name_format']; ?>
">
                            <br /><?php echo $this->_tpl_vars['MOD']['LBL_LOCALE_NAME_FORMAT_DESC']; ?>

                        </td>
                        <td scope="col" valign="top"><i><?php echo $this->_tpl_vars['MOD']['LBL_LOCALE_EXAMPLE_NAME_FORMAT']; ?>
:</i> </td>
                        <td  valign="top"><input tabindex='4' id="nameTarget" name="no_value" id=":q" value="" style="border: none;" disabled size="50"></td>
                    </tr>
                </table>
            </div>
                
            </td>
        </tr>
        <tr>
            <td colspan="2"><div class="hr" style="margin-top: 0px;"></div></td>
        </tr>
        <tr>
            <td colspan="2" scope="col"><h3><label for="external_source"><?php echo $this->_tpl_vars['MOD']['LBL_THIRD_PARTY_CSV_SOURCES']; ?>
</label>&nbsp;<?php echo smarty_function_sugar_help(array('text' => $this->_tpl_vars['MOD']['LBL_THIRD_PARTY_CSV_SOURCES_HELP']), $this);?>
</h3></td>
        </tr>
        <tr>
            <td colspan="2"><input class="radio" type="radio" name="external_source" value="" id='none' checked='checked'/>&nbsp;<?php echo $this->_tpl_vars['MOD']['LBL_NONE']; ?>
</td>
        </tr>
        <tr>
            <td colspan="2"><input class="radio" type="radio" name="external_source" value="salesforce" id='sf_map'/>&nbsp;<?php echo $this->_tpl_vars['MOD']['LBL_SALESFORCE']; ?>
</td>
        </tr>
        <tr>
            <td colspan="2"><input class="radio" type="radio" name="external_source" value="outlook" id='outlook_map'/>&nbsp;<?php echo $this->_tpl_vars['MOD']['LBL_MICROSOFT_OUTLOOK']; ?>
&nbsp;<?php echo smarty_function_sugar_help(array('text' => $this->_tpl_vars['MOD']['LBL_MICROSOFT_OUTLOOK_HELP']), $this);?>
</td>
        </tr>
        <tr>
            <td colspan="2">&nbsp;</td>
        </tr>
    </table>

    <table width="100%" cellpadding="2" cellspacing="0" border="0">
        <tr>
            <td align="left">
                <input title="<?php echo $this->_tpl_vars['MOD']['LBL_BACK']; ?>
"  id="goback" class="button" type="submit" name="button" value="  <?php echo $this->_tpl_vars['MOD']['LBL_BACK']; ?>
  ">&nbsp;
                <input title="<?php echo $this->_tpl_vars['MOD']['LBL_NEXT']; ?>
"  class="button" type="submit" name="button" value="  <?php echo $this->_tpl_vars['MOD']['LBL_NEXT']; ?>
  " id="gonext">
            </td>
        </tr>
    </table>
</form>