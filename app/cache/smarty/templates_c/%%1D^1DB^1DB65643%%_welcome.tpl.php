<?php /* Smarty version 2.6.11, created on 2014-12-14 16:17:23
         compiled from themes/Suite7/tpls/_welcome.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'strstr', 'themes/Suite7/tpls/_welcome.tpl', 46, false),array('modifier', 'replace', 'themes/Suite7/tpls/_welcome.tpl', 59, false),array('modifier', 'capitalize', 'themes/Suite7/tpls/_welcome.tpl', 59, false),)), $this); ?>
<?php if ($this->_tpl_vars['AUTHENTICATED']): ?>
    <?php if (! ((is_array($_tmp=$this->_tpl_vars['MODULE_TAB'])) ? $this->_run_mod_handler('strstr', true, $_tmp, 'legal_') : strstr($_tmp, 'legal_'))): ?>
	<?php $this->assign('SEARCH_MOD', 'legal_arrestees');  else: ?>
	<?php $this->assign('SEARCH_MOD', $this->_tpl_vars['MODULE_TAB']);  endif; ?> 
        <div id="search">
            <div class="wrapper">
                <!--<form name='UnifiedSearch' action='index.php' onsubmit='return SUGAR.unifiedSearchAdvanced.checkUsaAdvanced()'>-->
                <form name='UnifiedSearch' action='index.php' onsubmit='return false;'>
                    <input type="hidden" name="action" value="UnifiedSearch">
                    <input type="hidden" name="module" value="Home">
                    <input type="hidden" name="search_form" value="false">
                    <input type="hidden" name="advanced" value="false">
                    <input type="text" name="query_string" id="query_string" placeholder='Search <?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['SEARCH_MOD'])) ? $this->_run_mod_handler('replace', true, $_tmp, 'legal_', '') : smarty_modifier_replace($_tmp, 'legal_', '')))) ? $this->_run_mod_handler('capitalize', true, $_tmp) : smarty_modifier_capitalize($_tmp)); ?>
' value=""/>
                    <button  type="submit" class="button" ></button>
                </form>
            </div>
        </div>


<?php endif; ?>