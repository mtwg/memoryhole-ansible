<?php /* Smarty version 2.6.11, created on 2014-12-29 15:02:03
         compiled from cache/modules/Import/legal_arresteescharges_c.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'multienum_to_array', 'cache/modules/Import/legal_arresteescharges_c.tpl', 7, false),array('function', 'html_options', 'cache/modules/Import/legal_arresteescharges_c.tpl', 12, false),array('function', 'sugar_getimagepath', 'cache/modules/Import/legal_arresteescharges_c.tpl', 41, false),array('modifier', 'count', 'cache/modules/Import/legal_arresteescharges_c.tpl', 79, false),)), $this); ?>


<?php if (! isset ( $this->_tpl_vars['config']['enable_autocomplete'] ) || $this->_tpl_vars['config']['enable_autocomplete'] == false): ?>

	<input type="hidden" id="<?php echo $this->_tpl_vars['fields']['charges_c']['name']; ?>
_multiselect"
	name="<?php echo $this->_tpl_vars['fields']['charges_c']['name']; ?>
_multiselect" value="true">
	<?php echo smarty_function_multienum_to_array(array('string' => $this->_tpl_vars['fields']['charges_c']['value'],'default' => $this->_tpl_vars['fields']['charges_c']['default'],'assign' => 'values'), $this);?>

	<select id="<?php echo $this->_tpl_vars['fields']['charges_c']['name']; ?>
"
	name="<?php echo $this->_tpl_vars['fields']['charges_c']['name']; ?>
[]"
	multiple="true" size='6' style="width:150" title='To add new charge, go to Admin -> Dropdown Editor -> charges_list and add the new charge in the left pane.' tabindex="1"  
     	>
	<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['fields']['charges_c']['options'],'selected' => $this->_tpl_vars['values']), $this);?>

	</select>

<?php else: ?>

	<?php $this->assign('field_options', $this->_tpl_vars['fields']['charges_c']['options']); ?>
	<?php ob_start();  echo $this->_tpl_vars['fields']['charges_c']['value'];  $this->_smarty_vars['capture']['field_val'] = ob_get_contents(); ob_end_clean(); ?>
	<?php $this->assign('field_val', $this->_smarty_vars['capture']['field_val']); ?>
	<?php ob_start();  echo $this->_tpl_vars['fields']['charges_c']['name'];  $this->_smarty_vars['capture']['ac_key'] = ob_get_contents(); ob_end_clean(); ?>
	<?php $this->assign('ac_key', $this->_smarty_vars['capture']['ac_key']); ?>

			<input type="hidden" id="<?php echo $this->_tpl_vars['fields']['charges_c']['name']; ?>
_multiselect"
		name="<?php echo $this->_tpl_vars['fields']['charges_c']['name']; ?>
_multiselect" value="true">
		<?php echo smarty_function_multienum_to_array(array('string' => $this->_tpl_vars['fields']['charges_c']['value'],'default' => $this->_tpl_vars['fields']['charges_c']['default'],'assign' => 'values'), $this);?>

		<select style='display:none' id="<?php echo $this->_tpl_vars['fields']['charges_c']['name']; ?>
"
		name="<?php echo $this->_tpl_vars['fields']['charges_c']['name']; ?>
[]"
		multiple="true" size='6' style="width:150" title='To add new charge, go to Admin -> Dropdown Editor -> charges_list and add the new charge in the left pane.' tabindex="1"  
		        >
		<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['fields']['charges_c']['options'],'selected' => $this->_tpl_vars['values']), $this);?>

		</select>

		<input
	    id="<?php echo $this->_tpl_vars['fields']['charges_c']['name']; ?>
-input"
	    name="<?php echo $this->_tpl_vars['fields']['charges_c']['name']; ?>
-input"
	    size="60"
	    type="text" style="vertical-align: top;">
	
	<span class="id-ff multiple">
	    <button type="button">
	    	<img src="<?php echo smarty_function_sugar_getimagepath(array('file' => "id-ff-down.png"), $this);?>
" id="<?php echo $this->_tpl_vars['fields']['charges_c']['name']; ?>
-image">
	    	</button>
	    	<button type="button"
	        id="btn-clear-<?php echo $this->_tpl_vars['fields']['charges_c']['name']; ?>
-input"
	        title="Clear"
	        onclick="SUGAR.clearRelateField(this.form, '<?php echo $this->_tpl_vars['fields']['charges_c']['name']; ?>
-input', '<?php echo $this->_tpl_vars['fields']['charges_c']['name']; ?>
;');SUGAR.AutoComplete.<?php echo $this->_tpl_vars['ac_key']; ?>
.inputNode.updateHidden()"><img src="<?php echo smarty_function_sugar_getimagepath(array('file' => "id-ff-clear.png"), $this);?>
"></button>
	</span>

	<?php echo '
	<script>
	SUGAR.AutoComplete.';  echo $this->_tpl_vars['ac_key'];  echo ' = [];
	'; ?>


			<?php echo '
		YUI().use(\'datasource\', \'datasource-jsonschema\', function (Y) {
					SUGAR.AutoComplete.';  echo $this->_tpl_vars['ac_key'];  echo '.ds = new Y.DataSource.Function({
					    source: function (request) {
					    	var selectElem = document.getElementById("';  echo $this->_tpl_vars['fields']['charges_c']['name'];  echo '");
					    	var ret = [];
					    	for (i=0;i<selectElem.options.length;i++)
					    		if (!(selectElem.options[i].value==\'\' && selectElem.options[i].innerHTML==\'\'))
					    			ret.push({\'key\':selectElem.options[i].value,\'text\':selectElem.options[i].innerHTML});
					    	return ret;
					    }
					});
				});
		'; ?>

	
	<?php echo '
	YUI().use("autocomplete", "autocomplete-filters", "autocomplete-highlighters","node-event-simulate", function (Y) {
		'; ?>

		
	    SUGAR.AutoComplete.<?php echo $this->_tpl_vars['ac_key']; ?>
.inputNode = Y.one('#<?php echo $this->_tpl_vars['fields']['charges_c']['name']; ?>
-input');
	    SUGAR.AutoComplete.<?php echo $this->_tpl_vars['ac_key']; ?>
.inputImage = Y.one('#<?php echo $this->_tpl_vars['fields']['charges_c']['name']; ?>
-image');
	    SUGAR.AutoComplete.<?php echo $this->_tpl_vars['ac_key']; ?>
.inputHidden = Y.one('#<?php echo $this->_tpl_vars['fields']['charges_c']['name']; ?>
');

					SUGAR.AutoComplete.<?php echo $this->_tpl_vars['ac_key']; ?>
.minQLen = 0;
			SUGAR.AutoComplete.<?php echo $this->_tpl_vars['ac_key']; ?>
.queryDelay = 0;
			SUGAR.AutoComplete.<?php echo $this->_tpl_vars['ac_key']; ?>
.numOptions = <?php echo count($this->_tpl_vars['field_options']); ?>
;
			if(SUGAR.AutoComplete.<?php echo $this->_tpl_vars['ac_key']; ?>
.numOptions >= 300) <?php echo '{
				'; ?>

				SUGAR.AutoComplete.<?php echo $this->_tpl_vars['ac_key']; ?>
.minQLen = 1;
				SUGAR.AutoComplete.<?php echo $this->_tpl_vars['ac_key']; ?>
.queryDelay = 200;
				<?php echo '
			}
			'; ?>

			if(SUGAR.AutoComplete.<?php echo $this->_tpl_vars['ac_key']; ?>
.numOptions >= 3000) <?php echo '{
				'; ?>

				SUGAR.AutoComplete.<?php echo $this->_tpl_vars['ac_key']; ?>
.minQLen = 1;
				SUGAR.AutoComplete.<?php echo $this->_tpl_vars['ac_key']; ?>
.queryDelay = 500;
				<?php echo '
			}
			'; ?>

				
				<?php echo '
	    SUGAR.AutoComplete.';  echo $this->_tpl_vars['ac_key'];  echo '.inputNode.plug(Y.Plugin.AutoComplete, {
	        activateFirstItem: true,
	        allowTrailingDelimiter: true,
			'; ?>

	        minQueryLength: SUGAR.AutoComplete.<?php echo $this->_tpl_vars['ac_key']; ?>
.minQLen,
	        queryDelay: SUGAR.AutoComplete.<?php echo $this->_tpl_vars['ac_key']; ?>
.queryDelay,
	        queryDelimiter: ',',
	        zIndex: 99999,

						<?php echo '
			source: SUGAR.AutoComplete.';  echo $this->_tpl_vars['ac_key'];  echo '.ds,
			
	        resultTextLocator: \'text\',
	        resultHighlighter: \'phraseMatch\',
	        resultFilters: \'phraseMatch\',
	        // Chain together a startsWith filter followed by a custom result filter
	        // that only displays tags that haven\'t already been selected.
	        resultFilters: [\'phraseMatch\', function (query, results) {
		        // Split the current input value into an array based on comma delimiters.
	        	var selected = SUGAR.AutoComplete.';  echo $this->_tpl_vars['ac_key'];  echo '.inputNode.get(\'value\').split(/\\s*,\\s*/);
	        
	            // Convert the array into a hash for faster lookups.
	            selected = Y.Array.hash(selected);

	            // Filter out any results that are already selected, then return the
	            // array of filtered results.
	            return Y.Array.filter(results, function (result) {
	               return !selected.hasOwnProperty(result.text);
	            });
	        }]
	    });
		';  echo '
		if('; ?>
SUGAR.AutoComplete.<?php echo $this->_tpl_vars['ac_key']; ?>
.minQLen<?php echo ' == 0){
		    // expand the dropdown options upon focus
		    SUGAR.AutoComplete.';  echo $this->_tpl_vars['ac_key'];  echo '.inputNode.on(\'focus\', function () {
		        SUGAR.AutoComplete.';  echo $this->_tpl_vars['ac_key'];  echo '.inputNode.ac.sendRequest(\'\');
		    });
		}

				    SUGAR.AutoComplete.';  echo $this->_tpl_vars['ac_key'];  echo '.inputNode.updateHidden = function() {
				var index_array = SUGAR.AutoComplete.';  echo $this->_tpl_vars['ac_key'];  echo '.inputNode.get(\'value\').split(/\\s*,\\s*/);

				var selectElem = document.getElementById("';  echo $this->_tpl_vars['fields']['charges_c']['name'];  echo '");

				var oTable = {};
		    	for (i=0;i<selectElem.options.length;i++){
		    		if (selectElem.options[i].selected)
		    			oTable[selectElem.options[i].value] = true;
		    	}

				for (i=0;i<selectElem.options.length;i++){
					selectElem.options[i].selected=false;
				}

				var nTable = {};

				for (i=0;i<index_array.length;i++){
					var key = index_array[i];
					for (c=0;c<selectElem.options.length;c++)
						if (selectElem.options[c].innerHTML == key){
							selectElem.options[c].selected=true;
							nTable[selectElem.options[c].value]=1;
						}
				}

				//the following two loops check to see if the selected options are different from before.
				//oTable holds the original select. nTable holds the new one
				var fireEvent=false;
				for (n in nTable){
					if (n==\'\')
						continue;
		    		if (!oTable.hasOwnProperty(n))
		    			fireEvent = true; //the options are different, fire the event
		    	}
		    	
		    	for (o in oTable){
		    		if (o==\'\')
		    			continue;
		    		if (!nTable.hasOwnProperty(o))
		    			fireEvent=true; //the options are different, fire the event
		    	}

		    	//if the selected options are different from before, fire the \'change\' event
		    	if (fireEvent){
		    		SUGAR.AutoComplete.';  echo $this->_tpl_vars['ac_key'];  echo '.inputHidden.simulate(\'change\');
		    	}
		    };

		    SUGAR.AutoComplete.';  echo $this->_tpl_vars['ac_key'];  echo '.inputNode.updateText = function() {
		    	//get last option typed into the input widget
		    	SUGAR.AutoComplete.';  echo $this->_tpl_vars['ac_key'];  echo '.inputNode.ac.set(SUGAR.AutoComplete.';  echo $this->_tpl_vars['ac_key'];  echo '.inputNode.get(\'value\'));
				var index_array = SUGAR.AutoComplete.';  echo $this->_tpl_vars['ac_key'];  echo '.inputNode.get(\'value\').split(/\\s*,\\s*/);
				//create a string ret_string as a comma-delimited list of text from selectElem options.
				var selectElem = document.getElementById("';  echo $this->_tpl_vars['fields']['charges_c']['name'];  echo '");
				var ret_array = [];

                if (selectElem==null || selectElem.options == null)
					return;

				for (i=0;i<selectElem.options.length;i++){
					if (selectElem.options[i].selected && selectElem.options[i].innerHTML!=\'\'){
						ret_array.push(selectElem.options[i].innerHTML);
					}
				}

				//index array - array from input
				//ret array - array from select

				var sorted_array = [];
				var notsorted_array = [];
				for (i=0;i<index_array.length;i++){
					for (c=0;c<ret_array.length;c++){
						if (ret_array[c]==index_array[i]){
							sorted_array.push(ret_array[c]);
							ret_array.splice(c,1);
						}
					}
				}
				ret_string = ret_array.concat(sorted_array).join(\', \');
				if (ret_string.match(/^\\s*$/))
					ret_string=\'\';
				else
					ret_string+=\', \';
				
				//update the input widget
				SUGAR.AutoComplete.';  echo $this->_tpl_vars['ac_key'];  echo '.inputNode.ac.set(\'value\', ret_string);
		    };

		    function updateTextOnInterval(){
		    	if (document.activeElement != document.getElementById("';  echo $this->_tpl_vars['fields']['charges_c']['name']; ?>
-input<?php echo '"))
		    		SUGAR.AutoComplete.';  echo $this->_tpl_vars['ac_key'];  echo '.inputNode.updateText();
		    	setTimeout(updateTextOnInterval,100);
		    }

		    updateTextOnInterval();
		
					SUGAR.AutoComplete.';  echo $this->_tpl_vars['ac_key'];  echo '.inputNode.on(\'click\', function(e) {
				SUGAR.AutoComplete.';  echo $this->_tpl_vars['ac_key'];  echo '.inputHidden.simulate(\'click\');
			});
			
			SUGAR.AutoComplete.';  echo $this->_tpl_vars['ac_key'];  echo '.inputNode.on(\'dblclick\', function(e) {
				SUGAR.AutoComplete.';  echo $this->_tpl_vars['ac_key'];  echo '.inputHidden.simulate(\'dblclick\');
			});

			SUGAR.AutoComplete.';  echo $this->_tpl_vars['ac_key'];  echo '.inputNode.on(\'focus\', function(e) {
				SUGAR.AutoComplete.';  echo $this->_tpl_vars['ac_key'];  echo '.inputHidden.simulate(\'focus\');
			});

			SUGAR.AutoComplete.';  echo $this->_tpl_vars['ac_key'];  echo '.inputNode.on(\'mouseup\', function(e) {
				SUGAR.AutoComplete.';  echo $this->_tpl_vars['ac_key'];  echo '.inputHidden.simulate(\'mouseup\');
			});

			SUGAR.AutoComplete.';  echo $this->_tpl_vars['ac_key'];  echo '.inputNode.on(\'mousedown\', function(e) {
				SUGAR.AutoComplete.';  echo $this->_tpl_vars['ac_key'];  echo '.inputHidden.simulate(\'mousedown\');
			});

			SUGAR.AutoComplete.';  echo $this->_tpl_vars['ac_key'];  echo '.inputNode.on(\'blur\', function(e) {
				SUGAR.AutoComplete.';  echo $this->_tpl_vars['ac_key'];  echo '.inputHidden.simulate(\'blur\');
			});
		
		SUGAR.AutoComplete.';  echo $this->_tpl_vars['ac_key'];  echo '.inputNode.on(\'blur\', function () {
			SUGAR.AutoComplete.';  echo $this->_tpl_vars['ac_key'];  echo '.inputNode.updateHidden();
			SUGAR.AutoComplete.';  echo $this->_tpl_vars['ac_key'];  echo '.inputNode.updateText();
		});
	
	    // when they click on the arrow image, toggle the visibility of the options
	    SUGAR.AutoComplete.';  echo $this->_tpl_vars['ac_key'];  echo '.inputImage.on(\'click\', function () {
			if('; ?>
SUGAR.AutoComplete.<?php echo $this->_tpl_vars['ac_key']; ?>
.minQLen<?php echo ' == 0){
				SUGAR.AutoComplete.';  echo $this->_tpl_vars['ac_key'];  echo '.inputNode.ac.sendRequest(\'\');
				SUGAR.AutoComplete.';  echo $this->_tpl_vars['ac_key'];  echo '.inputNode.ac.show();
			}
			else{
				SUGAR.AutoComplete.';  echo $this->_tpl_vars['ac_key'];  echo '.inputNode.focus();
			}
	    });
	
		if('; ?>
SUGAR.AutoComplete.<?php echo $this->_tpl_vars['ac_key']; ?>
.minQLen<?php echo ' == 0){
		    // After a tag is selected, send an empty query to update the list of tags.
		    SUGAR.AutoComplete.';  echo $this->_tpl_vars['ac_key'];  echo '.inputNode.ac.after(\'select\', function () {
		      SUGAR.AutoComplete.';  echo $this->_tpl_vars['ac_key'];  echo '.inputNode.ac.sendRequest(\'\');
		      SUGAR.AutoComplete.';  echo $this->_tpl_vars['ac_key'];  echo '.inputNode.ac.show();
			  SUGAR.AutoComplete.';  echo $this->_tpl_vars['ac_key'];  echo '.inputNode.updateHidden();
			  SUGAR.AutoComplete.';  echo $this->_tpl_vars['ac_key'];  echo '.inputNode.updateText();
		    });
		} else {
		    // After a tag is selected, send an empty query to update the list of tags.
		    SUGAR.AutoComplete.';  echo $this->_tpl_vars['ac_key'];  echo '.inputNode.ac.after(\'select\', function () {
			  SUGAR.AutoComplete.';  echo $this->_tpl_vars['ac_key'];  echo '.inputNode.updateHidden();
			  SUGAR.AutoComplete.';  echo $this->_tpl_vars['ac_key'];  echo '.inputNode.updateText();
		    });
		}
	});
	</script>
	'; ?>

<?php endif; ?>