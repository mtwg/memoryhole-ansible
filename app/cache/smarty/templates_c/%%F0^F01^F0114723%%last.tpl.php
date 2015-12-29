<?php /* Smarty version 2.6.11, created on 2014-12-27 20:10:05
         compiled from modules/Import/tpls/last.tpl */ ?>

<?php echo '
<style>
    #tabListContainer ul.subpanelTablist li a.current
    {
        padding-left: 10px;
    }
div.resultsTable {
    overflow: auto;
    width: 1056px;
    padding-top: 20px;
    position: relative;
}
</style>
'; ?>


<h2>
	<p><?php echo $this->_tpl_vars['MOD']['LBL_SUMMARY']; ?>
</p>
</h2>
<br/>
<span style="font-size: 14px">
<?php if ($this->_tpl_vars['createdCount'] > 0): ?>
<b><?php echo $this->_tpl_vars['createdCount']; ?>
</b>&nbsp;<?php echo $this->_tpl_vars['MOD']['LBL_SUCCESSFULLY_IMPORTED']; ?>
<br />
<?php endif;  if ($this->_tpl_vars['updatedCount'] > 0): ?>
<b><?php echo $this->_tpl_vars['updatedCount']; ?>
</b>&nbsp;<?php echo $this->_tpl_vars['MOD']['LBL_UPDATE_SUCCESSFULLY']; ?>
<br />
<?php endif;  if ($this->_tpl_vars['errorCount'] > 0): ?>
<b><?php echo $this->_tpl_vars['errorCount']; ?>
</b>&nbsp;<?php echo $this->_tpl_vars['MOD']['LBL_RECORDS_SKIPPED_DUE_TO_ERROR']; ?>
<br />
<?php endif;  if ($this->_tpl_vars['dupeCount'] > 0): ?>
<b><?php echo $this->_tpl_vars['dupeCount']; ?>
</b>&nbsp;<?php echo $this->_tpl_vars['MOD']['LBL_DUPLICATES']; ?>
<br />
<?php endif; ?>
</span>
<form name="importlast" id="importlast" method="POST" action="index.php">
<input type="hidden" name="module" value="Import">
<input type="hidden" name="action" value="Undo">
<input type="hidden" name="has_header" value="<?php echo $_REQUEST['has_header']; ?>
">
<input type="hidden" name="import_module" value="<?php echo $this->_tpl_vars['IMPORT_MODULE']; ?>
">

<br />

<table width="100%" cellpadding="0" cellspacing="0" border="0">
    <tr>
        <td align="left" style="padding-bottom: 2px;">
        <?php if ($this->_tpl_vars['showUndoButton']): ?>
            <input title="<?php echo $this->_tpl_vars['MOD']['LBL_UNDO_LAST_IMPORT']; ?>
"  class="button"
                type="submit" name="undo" id="undo" value="  <?php echo $this->_tpl_vars['MOD']['LBL_UNDO_LAST_IMPORT']; ?>
  ">
        <?php endif; ?>
        <input title="<?php echo $this->_tpl_vars['MOD']['LBL_IMPORT_MORE']; ?>
"  class="button" type="submit" name="importmore" id="importmore" value="  <?php echo $this->_tpl_vars['MOD']['LBL_IMPORT_MORE']; ?>
  ">
        <input title="<?php echo $this->_tpl_vars['MOD']['LBL_FINISHED'];  echo $this->_tpl_vars['MODULENAME']; ?>
"  class="button" type="submit" name="finished" id="finished" value="  <?php echo $this->_tpl_vars['MOD']['LBL_IMPORT_COMPLETE']; ?>
  ">
            <?php echo $this->_tpl_vars['PROSPECTLISTBUTTON']; ?>

        </td>
    </tr>
</table>
</form>

<br/>
    
<table width="100%" id="tabListContainerTable" cellpadding="0" cellspacing="0" border="0">
    <tr>
        <td nowrap id="tabListContainerTD">
            <div id="tabListContainer" class="yui-module yui-scroll">
                <div class="yui-hd">
                    <span class="yui-scroll-controls" style="visibility:hidden">
                        <a title="scroll left" class="yui-scrollup"><em>scroll left</em></a>
                        <a title="scroll right" class="yui-scrolldown"><em>scroll right</em></a>
                    </span>
                </div>
                <div class="yui-bd">
                    <ul class="subpanelTablist" id="tabList">
                        <li id="pageNumIW_0" class="active" >
                            <a id="pageNumIW_0_anchor" class="current" href="javascript:SUGAR.IV.togglePages('0');">
                            <span id="pageNum_0_input_span" style="display:none;">
                            <input type="hidden" id="pageNum_0_name_hidden_input" value="<?php echo $this->_tpl_vars['pageData']['pageTitle']; ?>
"/>
                            <input type="text" id="pageNum_0_name_input" value="Testing" size="10"/>
                            </span>
                            <span id="pageNum_0_link_span" class="tabText">
                            <span id="pageNum_0_title_text"><?php echo $this->_tpl_vars['MOD']['LBL_CREATED_TAB']; ?>
</span>
                            </span>
                            </a>
                        </li>
                        <li id="pageNumIW_1" >
                            <a id="pageNumIW_1_anchor" class="" href="javascript:SUGAR.IV.togglePages('1');">
                            <span id="pageNum_1_input_span" style="display:none;">
                            <input type="hidden" id="pageNum_1_name_hidden_input" value="<?php echo $this->_tpl_vars['pageData']['pageTitle']; ?>
"/>
                            <input type="text" id="pageNum_1_name_input" value="Testing" size="10"/>
                            </span>
                            <span id="pageNum_1_link_span" class="tabText">
                            <span id="pageNum_1_title_text"><?php echo $this->_tpl_vars['MOD']['LBL_DUPLICATE_TAB']; ?>
</span>
                            </span>
                            </a>
                        </li>
                        <li id="pageNumIW_2" >
                            <a id="pageNumIW_2_anchor" class="" href="javascript:SUGAR.IV.togglePages('2');">
                            <span id="pageNum_2_input_span" style="display:none;">
                            <input type="hidden" id="pageNum_2_name_hidden_input" value="<?php echo $this->_tpl_vars['pageData']['pageTitle']; ?>
"/>
                            <input type="text" id="pageNum_2_name_input" value="Testing" size="10" />
                            </span>
                            <span id="pageNum_2_link_span" class="tabText">
                            <span id="pageNum_2_title_text"><?php echo $this->_tpl_vars['MOD']['LBL_ERROR_TAB']; ?>
</span>
                            </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div id="addPage" style="visibility: hidden">
                <a href='javascript:void(0)' id="add_page"></a>
            </div>
        </td>
        <td nowrap id="dashletCtrlsTD">
            <div id="dashletCtrls" style="margin:0;padding:0;"></div>
        </td>
    </tr>
</table>

<div style='width:100%'>
    <div id="pageNumIW_0_div"><?php echo $this->_tpl_vars['RESULTS_TABLE']; ?>
</div>
    <div id="pageNumIW_1_div" style="display:none;" ><br/>
        <?php if ($this->_tpl_vars['dupeCount'] > 0): ?>
            <a href ="<?php echo $this->_tpl_vars['dupeFile']; ?>
" target='_blank'><?php echo $this->_tpl_vars['MOD']['LNK_DUPLICATE_LIST']; ?>
</a><br />
        <?php endif; ?>
        <br/>
        <?php echo $this->_tpl_vars['MOD']['LBL_DUP_HELP']; ?>

        <div id="dup_table" class="resultsTable">
            <?php echo $this->_tpl_vars['DUP_TABLE']; ?>

        </div>
    </div>
    <div id="pageNumIW_2_div" style="display: none;" ><br/>
        <?php echo $this->_tpl_vars['MOD']['LBL_ERROR_HELP']; ?>

        <?php if ($this->_tpl_vars['errorCount'] > 0): ?>
            <br/><br/>
            <a href="<?php echo $this->_tpl_vars['errorFile']; ?>
" target='_blank'><?php echo $this->_tpl_vars['MOD']['LNK_ERROR_LIST']; ?>
</a><br />
            <a href ="<?php echo $this->_tpl_vars['errorrecordsFile']; ?>
" target='_blank'><?php echo $this->_tpl_vars['MOD']['LNK_RECORDS_SKIPPED_DUE_TO_ERROR']; ?>
</a><br />
        <?php endif; ?>
        <div id="errors_table" class="resultsTable">
            <?php echo $this->_tpl_vars['ERROR_TABLE']; ?>

        </div>
    </div>
</div>

<?php if ($this->_tpl_vars['PROSPECTLISTBUTTON'] != ''): ?>
<form name="DetailView">
    <input type="hidden" name="module" value="Prospects">
    <input type="hidden" name="record" value="id">
</form>
<?php endif; ?>