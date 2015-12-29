<?php /* Smarty version 2.6.11, created on 2014-12-27 20:10:05
         compiled from modules/Import/tpls/listview.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'sugar_getjspath', 'modules/Import/tpls/listview.tpl', 49, false),array('function', 'counter', 'modules/Import/tpls/listview.tpl', 55, false),)), $this); ?>
<style type="text/css"><?php echo '
.warn { font-style:italic;
        font-weight:bold;
        color:red;
}'; ?>

</style>

<script type='text/javascript' src='<?php echo smarty_function_sugar_getjspath(array('file' => 'include/javascript/popup_helper.js'), $this);?>
'></script>

<div id="<?php echo $this->_tpl_vars['tableID']; ?>
_content">
    <table cellpadding='0' cellspacing='0' width='50%' border='0' class='list view'>
        <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'modules/Import/tpls/listviewpaginator.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
        <tr height='20'>
            <?php echo smarty_function_counter(array('start' => 0,'name' => 'colCounter','print' => false,'assign' => 'colCounter'), $this);?>

            <?php if ($this->_tpl_vars['displayColumns'] == false): ?>
                <th scope='col'  style="text-align: left;" nowrap="nowrap" colspan="<?php echo $this->_tpl_vars['maxColumns']; ?>
"><?php echo $this->_tpl_vars['MOD']['LBL_MISSING_HEADER_ROW']; ?>
</th>
            <?php else: ?>
                <?php $_from = $this->_tpl_vars['displayColumns']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['colHeader'] => $this->_tpl_vars['label']):
?>
                    <th scope='col' nowrap="nowrap">
                        <div style='white-space: nowrap;'width='100%' align='left' >
                        <?php echo $this->_tpl_vars['label']; ?>

                        </div>
                    </th>
                    <?php echo smarty_function_counter(array('name' => 'colCounter'), $this);?>

                <?php endforeach; endif; unset($_from); ?>
            <?php endif; ?>
        </tr>
        <?php echo smarty_function_counter(array('start' => $this->_tpl_vars['pageData']['offsets']['current'],'print' => false,'assign' => 'offset','name' => 'offset'), $this);?>

        <?php $_from = $this->_tpl_vars['data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['rowIteration'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['rowIteration']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['id'] => $this->_tpl_vars['rowData']):
        $this->_foreach['rowIteration']['iteration']++;
?>
            <?php echo smarty_function_counter(array('name' => 'offset','print' => false), $this);?>


            <?php if ((1 & $this->_foreach['rowIteration']['iteration'])): ?>
                <?php $this->assign('_rowColor', $this->_tpl_vars['rowColor'][0]); ?>
            <?php else: ?>
                <?php $this->assign('_rowColor', $this->_tpl_vars['rowColor'][1]); ?>
            <?php endif; ?>
            <tr height='20' class='<?php echo $this->_tpl_vars['_rowColor']; ?>
S1'>
                <?php echo smarty_function_counter(array('start' => 0,'name' => 'colCounter','print' => false,'assign' => 'colCounter'), $this);?>

                <?php $_from = $this->_tpl_vars['rowData']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['col'] => $this->_tpl_vars['params']):
?>
                    <?php echo '<td align=\'left\' valign="top">';  echo $this->_tpl_vars['params'];  echo '</td>'; ?>

                    <?php echo smarty_function_counter(array('name' => 'colCounter'), $this);?>

                <?php endforeach; endif; unset($_from); ?>
                </tr>
        <?php endforeach; else: ?>
        <tr height='20' class='<?php echo $this->_tpl_vars['rowColor'][0]; ?>
S1'>
            <td colspan="<?php echo $this->_tpl_vars['colCounter']; ?>
">
                <em><?php echo $this->_tpl_vars['APP']['LBL_NO_DATA']; ?>
</em>
            </td>
        </tr>
        <?php endif; unset($_from); ?>
    <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'modules/Import/tpls/listviewpaginator.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
    </table>
</div>