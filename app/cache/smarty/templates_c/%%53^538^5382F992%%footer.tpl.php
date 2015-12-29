<?php /* Smarty version 2.6.11, created on 2014-12-14 16:17:16
         compiled from themes/Suite7/tpls/footer.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'sugar_translate', 'themes/Suite7/tpls/footer.tpl', 54, false),)), $this); ?>

        </td></tr></table>
    </div>


</div>

<div id="bottomLinks">
</div>
<div class="clear_footer"></div>

<div id="footer">
    <div id="responseTime">
        <?php echo $this->_tpl_vars['STATISTICS']; ?>

    </div>
    <?php if ($this->_tpl_vars['AUTHENTICATED']): ?>
    <div class="companyLogo"><a href="index.php?module=Home&action=index" border="0"><img src="<?php echo $this->_tpl_vars['COMPANY_LOGO_URL']; ?>
" width="<?php echo $this->_tpl_vars['COMPANY_LOGO_WIDTH']; ?>
" height="<?php echo $this->_tpl_vars['COMPANY_LOGO_HEIGHT']; ?>
" alt="<?php echo smarty_function_sugar_translate(array('label' => 'LBL_COMPANY_LOGO'), $this);?>
" border="0"/></a></div>
    <div id="links">
        <button id="print_page" onclick="printpage()"><?php echo $this->_tpl_vars['MOD']['LBL_SUITE_PRINT']; ?>
</button>
        <button id="backtotop"><?php echo $this->_tpl_vars['MOD']['LBL_SUITE_TOP']; ?>
</button>
    </div>
    <?php endif; ?>

    <div id="copyright_data">
    <div id="dialog2" title="<?php echo $this->_tpl_vars['MOD']['LBL_SUITE_SUPERCHARGED']; ?>
">
        <p><?php echo $this->_tpl_vars['MOD']['LBL_SUITE_DESC1']; ?>
</p>
        <br>
        <p><?php echo $this->_tpl_vars['MOD']['LBL_SUITE_DESC2']; ?>
</p>
        <br>
        <p><?php echo $this->_tpl_vars['MOD']['LBL_SUITE_DESC3']; ?>
</p>
        <br>
    </div>
    <div id="dialog" title="&copy; <?php echo $this->_tpl_vars['MOD']['LBL_SUITE_POWERED_BY']; ?>
">
        <p><?php echo $this->_tpl_vars['COPYRIGHT']; ?>
</p>
    </div>

    <button id="admin_options"><?php echo $this->_tpl_vars['MOD']['LBL_SUITE_SUPERCHARGED']; ?>
</button>
    <button id="powered_by">&copy; <?php echo $this->_tpl_vars['MOD']['LBL_SUITE_POWERED_BY']; ?>
</button>
    </div>

</div>
<script>
<?php echo '
function printpage()
{
    window.print();
}
if(SUGAR.util.isTouchScreen()) {
        setTimeout(resizeHeader,10000);
}

//qe_init function sets listeners to click event on elements of \'quickEdit\' class
 if(typeof(DCMenu) !=\'undefined\'){
    DCMenu.qe_refresh = false;
    DCMenu.qe_handle;
 }
function qe_init(){

    //do not process if YUI is undefined
    if(typeof(YUI)==\'undefined\' || typeof(DCMenu) == \'undefined\'){
        return;
    }


    //remove all existing listeners.  This will prevent adding multiple listeners per element and firing multiple events per click
    if(typeof(DCMenu.qe_handle) !=\'undefined\'){
        DCMenu.qe_handle.detach();
    }

    //set listeners on click event, and define function to call
    YUI().use(\'node\', function(Y) {
        var qe = Y.all(\'.quickEdit\');
        var refreshDashletID;
        var refreshListID;

        //store event listener handle for future use, and define function to call on click event
        DCMenu.qe_handle = qe.on(\'click\', function(e) {
            //function will flash message, and retrieve data from element to pass on to DC.miniEditView function
            ajaxStatus.flashStatus(SUGAR.language.get(\'app_strings\', \'LBL_LOADING\'),800);
            e.preventDefault();
            if(typeof(e.currentTarget.getAttribute(\'data-dashlet-id\'))!=\'undefined\'){
                refreshDashletID = e.currentTarget.getAttribute(\'data-dashlet-id\');
            }
            if(typeof(e.currentTarget.getAttribute(\'data-list\'))!=\'undefined\'){
                refreshListID = e.currentTarget.getAttribute(\'data-list\');
            }
            DCMenu.miniEditView(e.currentTarget.getAttribute(\'data-module\'), e.currentTarget.getAttribute(\'data-record\'),refreshListID,refreshDashletID);
        });

    });
}

    qe_init();


	SUGAR_callsInProgress++;
	SUGAR._ajax_hist_loaded = true;
    if(SUGAR.ajaxUI)
    	YAHOO.util.Event.onContentReady(\'ajaxUI-history-field\', SUGAR.ajaxUI.firstLoad);
</script>
    <script>
        $( "button" ).click(function() {
            $( "#sugarcopy" ).toggle();

        });

        $(function() {
            $( "#dialog, #dialog2" ).dialog({
                autoOpen: false,
                show: {
                    effect: "blind",
                    duration: 100
                },
                hide: {
                    effect: "fade",
                    duration: 1000
                }
            });
            $( "#powered_by" ).click(function() {
                $( "#dialog" ).dialog( "open" );
                $("#overlay").show().css({"opacity": "0.5"});
            });
            $( "#admin_options" ).click(function() {
                $( "#dialog2" ).dialog( "open" );
            });
        });

        $("#read").click(function(){

        });

        // Back to top animation
        $(\'#backtotop\').click(function(event) {
            event.preventDefault();
            $(\'html, body\').animate({scrollTop:0}, 500); // Scroll speed to the top
        });
    </script>
'; ?>

</body>
</html>