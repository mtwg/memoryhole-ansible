<?php /* Smarty version 2.6.11, created on 2014-12-27 20:10:05
         compiled from modules/Import/tpls/listviewpaginator.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'sugar_getimagepath', 'modules/Import/tpls/listviewpaginator.tpl', 49, false),)), $this); ?>

<tr class='pagination' role='presentation'>
    <td colspan='<?php echo $this->_tpl_vars['colCount']; ?>
'>
        <table border='0' cellpadding='0' cellspacing='0' width='100%' class='paginationTable'>
            <tr>
                <td  nowrap='nowrap' width='1%' align="left" class='paginationChangeButtons'>
                <?php if ($this->_tpl_vars['pageData']['offsets']['current'] != 0): ?>
                    <button type='button' id='listViewStartButton' name='listViewStartButton' title='<?php echo $this->_tpl_vars['navStrings']['start']; ?>
' class='button' onClick='SUGAR.IV.getTable("<?php echo $this->_tpl_vars['tableID']; ?>
",0);'>
                        <img src='<?php echo smarty_function_sugar_getimagepath(array('file' => 'start.png'), $this);?>
' alt='<?php echo $this->_tpl_vars['navStrings']['start']; ?>
' align='absmiddle' border='0'>
                    </button>
                    <?php else: ?>
                    <button type='button' id='listViewStartButton' name='listViewStartButton' title='<?php echo $this->_tpl_vars['navStrings']['start']; ?>
' class='button' disabled='disabled'>
                        <img src='<?php echo smarty_function_sugar_getimagepath(array('file' => 'start_off.png'), $this);?>
' alt='<?php echo $this->_tpl_vars['navStrings']['start']; ?>
' align='absmiddle' border='0'>
                    </button>
                <?php endif; ?>
                <?php if ($this->_tpl_vars['pageData']['offsets']['current'] != 0): ?>
                    <button type='button' id='listViewPrevButton' name='listViewPrevButton' title='<?php echo $this->_tpl_vars['navStrings']['previous']; ?>
' class='button' onClick='SUGAR.IV.getTable("<?php echo $this->_tpl_vars['tableID']; ?>
", <?php echo $this->_tpl_vars['pageData']['offsets']['previous']; ?>
);'>
                        <img src='<?php echo smarty_function_sugar_getimagepath(array('file' => 'previous.png'), $this);?>
' alt='<?php echo $this->_tpl_vars['navStrings']['previous']; ?>
' align='absmiddle' border='0'>
                    </button>
                    <?php else: ?>
                    <button type='button' id='listViewPrevButton' name='listViewPrevButton' class='button' title='<?php echo $this->_tpl_vars['navStrings']['previous']; ?>
' disabled='disabled'>
                        <img src='<?php echo smarty_function_sugar_getimagepath(array('file' => 'previous_off.png'), $this);?>
' alt='<?php echo $this->_tpl_vars['navStrings']['previous']; ?>
' align='absmiddle' border='0'>
                    </button>
                <?php endif; ?>
                    <span class='pageNumbers'>(<?php if ($this->_tpl_vars['pageData']['offsets']['lastOffsetOnPage'] == 0): ?>0<?php else:  echo $this->_tpl_vars['pageData']['offsets']['current']+1;  endif; ?> - <?php echo $this->_tpl_vars['pageData']['offsets']['lastOffsetOnPage']; ?>
 <?php echo $this->_tpl_vars['navStrings']['of']; ?>
 <?php echo $this->_tpl_vars['pageData']['offsets']['total']; ?>
)</span>
                <?php if ($this->_tpl_vars['pageData']['offsets']['next'] > 0): ?>
                    <button type='button' id='listViewNextButton' name='listViewNextButton' title='<?php echo $this->_tpl_vars['navStrings']['next']; ?>
' class='button' onClick='SUGAR.IV.getTable("<?php echo $this->_tpl_vars['tableID']; ?>
", <?php echo $this->_tpl_vars['pageData']['offsets']['next']; ?>
);'>
                        <img src='<?php echo smarty_function_sugar_getimagepath(array('file' => 'next.png'), $this);?>
' alt='<?php echo $this->_tpl_vars['navStrings']['next']; ?>
' align='absmiddle' border='0'>
                    </button>
                <?php else: ?>
                    <button type='button' id='listViewNextButton' name='listViewNextButton' class='button' title='<?php echo $this->_tpl_vars['navStrings']['next']; ?>
' disabled='disabled'>
                        <img src='<?php echo smarty_function_sugar_getimagepath(array('file' => 'next_off.png'), $this);?>
' alt='<?php echo $this->_tpl_vars['navStrings']['next']; ?>
' align='absmiddle' border='0'>
                    </button>
                <?php endif; ?>
                <?php if ($this->_tpl_vars['pageData']['offsets']['next'] > 0): ?>
                    <button type='button' id='listViewEndButton' name='listViewEndButton' title='<?php echo $this->_tpl_vars['navStrings']['end']; ?>
' class='button' onClick='SUGAR.IV.getTable("<?php echo $this->_tpl_vars['tableID']; ?>
", <?php echo $this->_tpl_vars['pageData']['offsets']['last']; ?>
);' >
                        <img src='<?php echo smarty_function_sugar_getimagepath(array('file' => 'end.png'), $this);?>
' alt='<?php echo $this->_tpl_vars['navStrings']['end']; ?>
' align='absmiddle' border='0'>
                    </button>
                <?php else: ?>
                    <button type='button' id='listViewEndButton' name='listViewEndButton' title='<?php echo $this->_tpl_vars['navStrings']['end']; ?>
' disabled='disabled' class='button' onClick='SUGAR.IV.getTable("<?php echo $this->_tpl_vars['tableID']; ?>
", <?php echo $this->_tpl_vars['pageData']['offsets']['last']; ?>
);' >
                        <img src='<?php echo smarty_function_sugar_getimagepath(array('file' => 'end_off.png'), $this);?>
' alt='<?php echo $this->_tpl_vars['navStrings']['end']; ?>
' align='absmiddle' border='0'>
                    </button>
                <?php endif; ?>
                </td>
                <td nowrap="nowrap" width='2%' class='paginationActionButtons'></td>
            </tr>
        </table>
    </td>
</tr>