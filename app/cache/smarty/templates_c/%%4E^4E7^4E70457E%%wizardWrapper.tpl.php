<?php /* Smarty version 2.6.11, created on 2014-12-27 10:18:32
         compiled from modules/Import/tpls/wizardWrapper.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'sugar_getjspath', 'modules/Import/tpls/wizardWrapper.tpl', 50, false),)), $this); ?>

<style>
<?php echo '
.moduleTitle h2
{
    font-size: 18px;
}
'; ?>

</style>
<script type="text/javascript" src="<?php echo smarty_function_sugar_getjspath(array('file' => 'cache/include/javascript/sugar_grp_yui_widgets.js'), $this);?>
"></script>
<div class="dashletPanelMenu wizard">
    <div class="bd">
            <div class="screen">
                <?php echo $this->_tpl_vars['MODULE_TITLE']; ?>

                <br>
                <?php echo $this->_tpl_vars['CONTENT']; ?>

            </div>
    </div>
</div>

<script>
<?php echo $this->_tpl_vars['JAVASCRIPT']; ?>

</script>