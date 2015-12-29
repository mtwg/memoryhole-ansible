<?php /* Smarty version 2.6.11, created on 2014-12-27 20:00:18
         compiled from modules/Import/tpls/confirm_table.tpl */ ?>
<table border="0" cellpadding="0" cellspacing="0" width="100%" id="importTable" class="detail view noBorder" style="box-shadow: none; -moz-box-shadow: none. -webkit-box-shadow: none;">
    <tbody>
        <?php $_from = $this->_tpl_vars['SAMPLE_ROWS']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['row'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['row']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['row']):
        $this->_foreach['row']['iteration']++;
?>
            <tr>
                <?php $_from = $this->_tpl_vars['row']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['value']):
?>
                    <?php if (($this->_foreach['row']['iteration'] <= 1)): ?>
                        <?php if ($this->_tpl_vars['HAS_HEADER']): ?>
                            <td scope="col" style="text-align: left;"><?php echo $this->_tpl_vars['value']; ?>
</td>
                        <?php else: ?>
                            <td scope="col" style="text-align: left;" colspan="<?php echo $this->_tpl_vars['column_count']; ?>
"><?php echo $this->_tpl_vars['MOD']['LBL_MISSING_HEADER_ROW']; ?>
</td>
                        <?php endif; ?>
                     <?php else: ?>
                        <td class="impSample"><?php echo $this->_tpl_vars['value']; ?>
</td>
                     <?php endif; ?>
                <?php endforeach; endif; unset($_from); ?>
            </tr>
        <?php endforeach; endif; unset($_from); ?>
    </tbody>
</table>