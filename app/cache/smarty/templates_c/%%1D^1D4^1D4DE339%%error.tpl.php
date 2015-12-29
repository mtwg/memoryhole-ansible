<?php /* Smarty version 2.6.11, created on 2014-12-15 10:15:17
         compiled from modules/Import/tpls/error.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'sugar_getjspath', 'modules/Import/tpls/error.tpl', 45, false),)), $this); ?>
<script type="text/javascript" src="<?php echo smarty_function_sugar_getjspath(array('file' => 'include/javascript/sugar_grp_yui_widgets.js'), $this);?>
"></script>
<script>

    //set the variables
    var modalBod = "<?php echo $this->_tpl_vars['MESSAGE']; ?>
";
    var cnfgtitle = '<?php echo $this->_tpl_vars['MOD']['LBL_ERROR']; ?>
';
    var startOverLBL = '<?php echo $this->_tpl_vars['MOD']['LBL_TRY_AGAIN']; ?>
';
    var cancelLBL = '<?php echo $this->_tpl_vars['MOD']['LBL_CANCEL']; ?>
';
    var actionVAR = '<?php echo $this->_tpl_vars['ACTION']; ?>
';
    var importModuleVAR = '<?php echo $this->_tpl_vars['IMPORT_MODULE']; ?>
';
    var sourceVAR = '<?php echo $this->_tpl_vars['SOURCE']; ?>
';
    var showCancelVAR = '<?php echo $this->_tpl_vars['SHOWCANCEL']; ?>
';
    <?php if (! empty ( $this->_tpl_vars['CANCELLABEL'] )): ?>
        cancelLBL = '<?php echo $this->_tpl_vars['CANCELLABEL']; ?>
';
    <?php endif; ?>

<?php echo '
    //function called when \'start over\' button is pressed
    var chooseToStartOver = function() {
        //hide the modal and redirect window to previous step
        this.hide();
        document.location.href=\'index.php?module=Import&action=\'+actionVAR+\'&import_module=\'+importModuleVAR+\'&source=\'+sourceVAR;
        //SUGAR.importWizard.renderDialog(importModuleVAR,actionVAR,sourceVAR);
    };
    var chooseToCancel = function() {
        //do nothing, just hide the modal
        this.hide();
    };

    //define the buttons to be used in modal popup
    var importButtons = \'\';
    if(showCancelVAR){
        importButtons = [{ text: startOverLBL, handler: chooseToStartOver, isDefault:true },{ text:cancelLBL, handler: chooseToCancel}];
    }else{
        importButtons = [{ text: startOverLBL, handler: chooseToStartOver, isDefault:true }];
    }

    //define import error modal window
    ImportErrorBox = new YAHOO.widget.SimpleDialog(\'importMsgWindow\', {
        type : \'alert\',
        modal: true,
        width: \'350px\',
        id: \'importMsgWindow\',
        close: true,
        visible: true,
        fixedcenter: true,
        constraintoviewport: true,
        draggable: true,
        buttons: importButtons
    });
'; ?>

    //display the window
    ImportErrorBox.setHeader(cnfgtitle);
    ImportErrorBox.setBody(modalBod);
    ImportErrorBox.render(document.body);
    ImportErrorBox.show();

</script>