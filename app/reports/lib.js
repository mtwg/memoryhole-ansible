	function showDetails(id) {
		elem='details';
		if ($('detailsrow')) { 
			if (id != undefined  && ($('row_'+id).getStyle('background')) != '') { close = 1; }
			$('detailsrow').previous().style.background = ''; 
			Element.remove($('detailsrow')); 
			if (close == 1) { return; }
		}
		if (id) { 
			$('row_'+id).style.background = '#B9DDFF;';
			if ($('details')) { Element.remove($('details')); } 
			var div = "<tr id='detailsrow'><td colspan='6' id='details'></td></tr>";	
			new Insertion.After($('row_'+id), div);
		} else { 
			if ($('details')) { 
				Element.remove($('details'));
				return; 
			}
			var div = "<div style='border: 1px solid gray; font-size: .8em; ' id='details'></div>";
			new Insertion.After($('new_query_span'), div);
		}	
		new Ajax.Request('index.php', {
		method: 'post',
		parameters: "query_id="+id+'&action=editquery',
		onComplete: function(resp) { $(elem).innerHTML = resp.responseText; CodePress.run(); } });
	}	

	function runQuery(id) {
		error = "";
		info = "";
		$('progress').style.display='block';
		$('info').style.display = 'none';
		$('error').style.display = 'none';
		new Ajax.Request('index.php', {
			method: 'post',
			parameters: "query_id="+id+'&action=runquery',
			onFailure: function(resp) {
				error = 'An unknown error occurred<br/>'+resp.responseText;
				console.log('two');
				showInfo(error, 1);
			},	
			onComplete: function(resp) { 
				$('progress').style.display='none';
				var text = resp.responseText;
				if (! (text.match('error') && text.match('info'))) {
					showInfo('An unknown error occurred<br/>'+resp.responseText, 1);
					return;
				}
				eval(text);
				showInfo(error, 1);
				showInfo(info, 0); 
				if (executed) {
					$('executed_'+id).innerHTML = executed; 
				}
			}
		});
	} 

	function saveQuery() {
		$('query').value = code.getCode();
		new Ajax.Request('index.php', {
			method: 'post',
			parameters: document.editquery.serialize(true),
			onComplete: function(resp) { $('info').update(resp.responseText); } });
	}

	function showInfo(message, error) {
		if(! message) { return; }
		var div = error ? 'error' : 'info';
		$(div+'string').innerHTML = ' '+message;
		$(div).style.display = 'block';
	}

	function getMouseXY(e) {
		var mousepos = new Array();
		mousepos['x'] = Event.pointerX(e);
		mousepos['y'] = Event.pointerY(e);
		return mousepos;
	}

	function mousemove(e) {
		var mousepos = getMouseXY(e);
		var tooltip = $('tooltip');
		if (tooltip.style.visibility == 'visible') {
			tooltip.style.top = (mousepos['y'] -20 )+'px';
			tooltip.style.left = (mousepos['x'] +10) +'px';
		}
	}

	function showTooltip(label, text) {
		if (typeof(label) != 'string') { label = text; }
		if(label) { $('tooltip').innerHTML = label; }
		$('tooltip').style.visibility='visible'; //show the tooltip
	}
	
	function hideTooltip() { 
		$('tooltip').style.visibility='hidden'; //hide the tooltip first - somehow this makes it faster
	}


