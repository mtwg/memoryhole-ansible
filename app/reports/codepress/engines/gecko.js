/*
 * CodePress - Real Time Syntax Highlighting Editor written in JavaScript - http://codepress.org/
 * 
 * Copyright (C) 2007 Fernando M.A.d.S. <fermads@gmail.com>
 *
 * Contributors :
 *
 * 	Michael Hurni <michael.hurni@gmail.com>
 *
 * This program is free software; you can redistribute it and/or modify it under the terms of the 
 * GNU Lesser General Public License as published by the Free Software Foundation.
 * 
 * Read the full licence: http://www.opensource.org/licenses/lgpl-license.php
 */

CodePress = {
	scrolling : false,
	autocomplete : true,

	// set initial vars and start sh
	initialize : function() {
		if(typeof(editor)=='undefined' && !arguments[0]) return;
		chars = '|32|46|62|'; // charcodes that trigger syntax highlighting
		cc = '\u2009'; // control char
		editor = document.getElementsByTagName('body')[0];
		document.designMode = 'on';
		document.addEventListener('keypress', this.keyHandler, true);
		window.addEventListener('scroll', function() { if(!CodePress.scrolling) CodePress.syntaxHighlight('scroll') }, false);
		completeChars = this.getCompleteChars();
		//[ 1693760 ] Autocomplete ending awareness
		completeEndingChars =  this.getCompleteEndingChars();
//		CodePress.syntaxHighlight('init');
	},

	// treat key bindings
	keyHandler : function(evt) {
    	keyCode = evt.keyCode;	
		charCode = evt.charCode;
		//[ 1693760 ] Autocomplete ending awareness
		if((evt.ctrlKey || evt.metaKey) && evt.shiftKey && charCode!=90)  { 
			// shortcuts = ctrl||appleKey+shift+key!=z(undo) 
			CodePress.shortcuts(charCode?charCode:keyCode);
		}
		//[ 1693760 ] Autocomplete ending awareness
		else if( (completeEndingChars.indexOf('|'+String.fromCharCode(charCode)+'|')!= -1 || completeChars.indexOf('|'+String.fromCharCode(charCode)+'|')!=-1  )&& CodePress.autocomplete) { 
			// auto complete
			var found = CodePress.completeEnding(String.fromCharCode(charCode));
			if(found == false)
			     CodePress.complete(String.fromCharCode(charCode));
		}
		/* OLD
		else if(completeChars.indexOf('|'+String.fromCharCode(charCode)+'|')!=-1 && CodePress.autocomplete) { // auto complete
			CodePress.complete(String.fromCharCode(charCode));
		}*/
	    else if(chars.indexOf('|'+charCode+'|')!=-1||keyCode==13) { 
			// syntax highlighting
		 	CodePress.syntaxHighlight('generic');
		}
		else if(keyCode==9 || evt.tabKey) {  
			// snippets activation (tab)
			CodePress.snippets(evt);
		}
		else if(keyCode==46||keyCode==8) { 
			// save to history when delete or backspace pressed
		 	CodePress.actions.history[CodePress.actions.next()] = editor.innerHTML;
		}
		else if((charCode==122||charCode==121||charCode==90) && evt.ctrlKey) { 
			// undo and redo
			(charCode==121||evt.shiftKey) ? CodePress.actions.redo() :  CodePress.actions.undo(); 
			evt.preventDefault();
		}
		else if(keyCode==86 && evt.ctrlKey)  { 
			// paste
			// TODO: pasted text should be parsed and highlighted
		}
	},

	// put cursor back to its original position after every parsing
	findString : function() {
		if(self.find(cc))
			window.getSelection().getRangeAt(0).deleteContents();
	},
	
	// split big files, highlighting parts of it
	split : function(code,flag) {
		if(flag=='scroll') {
			this.scrolling = true;
			return code;
		}
		else {
			this.scrolling = false;
			mid = code.indexOf(cc);
			if(mid-2000<0) {ini=0;end=4000;}
			else if(mid+2000>code.length) {ini=code.length-4000;end=code.length;}
			else {ini=mid-2000;end=mid+2000;}
			code = code.substring(ini,end);
			return code;
		}
	},
	
	// syntax highlighting parser
	syntaxHighlight : function(flag) {
		//if(document.designMode=='off') document.designMode='on'
		if(flag!='init') window.getSelection().getRangeAt(0).insertNode(document.createTextNode(cc));

		o = editor.innerHTML;
		o = o.replace(/<br>/g,'\n');
		o = o.replace(/<.*?>/g,'');
		x = z = this.split(o,flag);
		x = x.replace(/\n/g,'<br>');
	
		// 3 argument call...
		if(arguments[1]&&arguments[2])
			x = x.replace(arguments[1],arguments[2]);
	
		var scope = this.findFunctions().toString().replace(/(,)/g,"|") 
		if(scope.length > 0 )
			x = x.replace( new RegExp("\\b(" +  scope + ")\\b","g") , Language.Functions[0].output )
		
		for(i=0;i<Language.syntax.length;i++) 
			x = x.replace(Language.syntax[i].input,Language.syntax[i].output);
		
		editor.innerHTML = this.actions.history[this.actions.next()] = (flag=='scroll') ? x : o.split(z).join(x); 
		if(flag!='init') this.findString();
	},
	
	getLastWord : function() {
		var rangeAndCaret = CodePress.getRangeAndCaret();
		words = rangeAndCaret[0].substring(rangeAndCaret[1]-40,rangeAndCaret[1]);
		words = words.replace(/[\s\n\r\);\W]/g,'\n').split('\n');
		return words[words.length-1].replace(/[\W]/gi,'').toLowerCase();
	},
	findFunctions : function(){
		var Functions = Language.Functions;
		var o = this.getCode();
		var funcs = new Array();
		funcs = ['legal_arresal_witnesses', 'legal_arresegal_charges', 'legal_arresgal_evidence', 'legal_arreslegal_events', 'legal_arrestees', 'legal_arrestees_audit', 'legal_arrestees_cstm', 'legal_charges', 'legal_charges_audit', 'legal_evental_witnesses', 'legal_eventgal_evidence', 'legal_events', 'legal_events_audit', 'legal_evidence', 'legal_evidence_audit', 'legal_evidence_cstm', 'legal_lawyers', 'legal_lawyers_audit', 'legal_lawyers_cstm', 'legal_witnesses', 'legal_witnesses_audit', 'legal_witnesses_cstm', 'account_id', 'affinity_group_c', 'after_value_string', 'after_value_text', 'alt_address_city', 'alt_address_country', 'alt_address_postalcode', 'alt_address_state', 'alt_address_street', 'arrest_date', 'arresting_officer', 'arrest_location', 'arrest_time', 'arrest_time_c', 'assigned_user_id', 'assistant', 'assistant_phone', 'badge_number', 'bail_c', 'before_value_string', 'before_value_text', 'booking_number_c', 'can_represent_in_mn_c', 'caseid_c', 'case_number_c', 'charge', 'charge_desc', 'charges_c', 'citation_number', 'civil_rights_experience_c', 'contacts_c', 'created_by', 'data_type', 'date', 'date_created', 'date_entered', 'date_modified', 'date_of_birth', 'datetimelocation_c', 'deleted', 'department', 'description', 'disposition_c', 'do_not_call', 'email', 'end_time', 'evidence_id_c', 'federal_practice_c', 'felony_charges', 'field_name', 'first_appearance_date_c', 'first_appearance_location_c', 'first_name', 'gender_id_c', 'gender_solidarity_c', 'id', 'id_c', 'id_display_c', 'immigration_issues', 'incident_id', 'jail_facility_c', 'jail_location_c', 'jurisdiction_c', 'last_name', 'lawyer_id', 'lawyer_roles_c', 'lawyersspecialties_c', 'legal_arrestees_ida', 'legal_charges_idb', 'legal_events_ida', 'legal_events_idb', 'legal_evidence_idb', 'legal_observer', 'legal_strategy_c', 'legal_witnesses_idb', 'license_number_c', 'loctation', 'medical_concern_c', 'medical_needs_c', 'minor', 'modified_user_id', 'name', 'next_hearing_time_c', 'nlg_c', 'organization_c', 'parent_id', 'phone_fax', 'phone_home', 'phone_mobile', 'phone_other', 'phone_work', 'practicing_states_c', 'preferred_name', 'primary_address_city', 'primary_address_country', 'primary_address_postalcode', 'primary_address_state', 'primary_address_street', 'regular_courts_c', 'release_date', 'release_time', 'release_type_c', 'represented_protestors_c', 'salutation', 'start_time', 'state_c', 'support_contact_c', 'support_needs_c', 'support_person_c', 'title', 'type', 'unconfirmed_arrest_c', 'use_of_force', 'use_of_force_c', 'wants_bail_c', 'wants_lawyer_c', 'witness', 'years_in_crim_practice_c', 'years_in_practice_c'];
		return funcs;	
		for(i=0 ; i<Functions.length ; i++){
			var arr = o.match( Functions[i].input );
			if( arr != null )
				for(j=0;j<arr.length;j++)
					funcs.push( arr[j].replace( Functions[i].input, Functions[i].name ) );
		}
		return funcs;
	},
	snippets : function(evt) {
		var snippets = Language.snippets;	
		var trigger = this.getLastWord();
		var funcs = this.findFunctions();
	
		for (var i=0; i<snippets.length; i++) {
			if(snippets[i].input == trigger) {
				var content = snippets[i].output.replace(/</g,'&lt;');
				content = content.replace(/>/g,'&gt;');
				if(content.indexOf('$0')<0) content += cc;
				else content = content.replace(/\$0/,cc);
				content = content.replace(/\n/g,'<br>');
				var pattern = new RegExp(trigger+cc,'g');
				evt.preventDefault(); // prevent the tab key from being added
				this.syntaxHighlight('syntax',pattern,content);
			}
		}
		var matches = new Array();
		for (var i=0; i<funcs.length; i++) {
			if( String(" "+funcs[i]).toLowerCase().indexOf(trigger.toLowerCase())==1 ) {
				matches.push(funcs[i]);
			}
		}
		if (matches[0]) {
			var content = '';
			if (! matches[1]) { 
				content = matches[0].replace(/</g,'&lt;');
				content = content.replace(/>/g,'&gt;');
				parent.document.getElementById('suggest').style.display = 'none';
			} else {
				for(var c=0; c < matches[0].length; c++) {
					var test = 0;
					for(var m=1; m<matches.length; m++) {
						if (matches[m][c] == undefined) { test = 0; break; }
						//console.log(matches[0][c] + ' v '+  matches[m][c]);
						if (matches[0][c] == matches[m][c]) { test = 1; } else { test = 0; break; }
					}
					if (test == 1) { 
						content += matches[0][c];
					} else { break; }
				}
				suggest = parent.document.getElementById('suggest');
				suggest.innerHTML = matches.join(', ');
				suggest.style.display = 'block';
				parent.setTimeout( function() { parent.document.getElementById('suggest').style.display = 'none'; }, 10000);
			}
			content += cc;
			var pattern = new RegExp(trigger+cc,'g');
			evt.preventDefault(); // prevent the tab key from being added
			this.syntaxHighlight('snippets',pattern,content);
		}
	},
	
	readOnly : function() {
		document.designMode = (arguments[0]) ? 'off' : 'on';
	},

	complete : function(trigger) {
		window.getSelection().getRangeAt(0).deleteContents();
		var complete = Language.complete;
		for (var i=0; i<complete.length; i++) {
			if(complete[i].input == trigger) {
				var pattern = new RegExp('\\'+trigger+cc);
				var content = complete[i].output.replace(/\$0/g,cc);
				parent.setTimeout(function () { CodePress.syntaxHighlight('complete',pattern,content)},0); // wait for char to appear on screen
			}
		}
	},

	getCompleteChars : function() {
		var cChars = '';
		for(var i=0;i<Language.complete.length;i++)
			cChars += '|'+Language.complete[i].input;
		return cChars+'|';
	},
//[ 1693760 ] Autocomplete ending awareness
	getCompleteEndingChars : function() {
	   var cChars = '';
		for(var i=0;i<Language.complete.length;i++)
			cChars += '|'+Language.complete[i].output.charAt(Language.complete[i].output.length-1);
		return cChars+'|';
	},
	completeEnding : function(trigger) {
       var range = window.getSelection().getRangeAt(0);
       try{
            range.setEnd(range.endContainer, range.endOffset+1)
       }catch(e)
       {
        return false;
       }
       var next_character = range.toString()
       range.setEnd(range.endContainer, range.endOffset-1)
       if(next_character != trigger  )
		  return false;
	   else
       {
            range.setEnd(range.endContainer, range.endOffset+1)
            range.deleteContents();
            return true;
       }
    },
//*****************************************
	shortcuts : function() {
		var cCode = arguments[0];
		if(cCode==13) cCode = '[enter]';
		else if(cCode==32) cCode = '[space]';
		else cCode = '['+String.fromCharCode(charCode).toLowerCase()+']';
		for(var i=0;i<Language.shortcuts.length;i++)
			if(Language.shortcuts[i].input == cCode)
				this.insertCode(Language.shortcuts[i].output,false);
	},
	
	getRangeAndCaret : function() {	
		var range = window.getSelection().getRangeAt(0);
		var range2 = range.cloneRange();
		var node = range.endContainer;			
		var caret = range.endOffset;
		range2.selectNode(node);	
		return [range2.toString(),caret];
	},
	
	insertCode : function(code,replaceCursorBefore) {
		var range = window.getSelection().getRangeAt(0);
		var node = window.document.createTextNode(code);
		var selct = window.getSelection();
		var range2 = range.cloneRange();
		// Insert text at cursor position
		selct.removeAllRanges();
		range.deleteContents();
		range.insertNode(node);
		// Move the cursor to the end of text
		range2.selectNode(node);		
		range2.collapse(replaceCursorBefore);
		selct.removeAllRanges();
		selct.addRange(range2);
	},

	// get code from editor
	getCode : function() {
		var code = editor.innerHTML;
		code = code.replace(/<br>/g,'\n');
		code = code.replace(/\u2009/g,'');
		code = code.replace(/<.*?>/g,'');
		code = code.replace(/&lt;/g,'<');
		code = code.replace(/&gt;/g,'>');
		code = code.replace(/&amp;/gi,'&');
		return code;
	},

	// put code inside editor
	setCode : function() {
		var code = arguments[0];
		code = code.replace(/\u2009/gi,'');
		code = code.replace(/&/gi,'&amp;');		
       	code = code.replace(/</g,'&lt;');
        code = code.replace(/>/g,'&gt;');
		editor.innerHTML = code;
	},

	// undo and redo methods
	actions : {
		pos : -1, // actual history position
		history : [], // history vector
		
		undo : function() {
			if(editor.innerHTML.indexOf(cc)==-1){
				window.getSelection().getRangeAt(0).insertNode(document.createTextNode(cc));
			 	this.history[this.pos] = editor.innerHTML;
			}
			this.pos--;
			if(typeof(this.history[this.pos])=='undefined') this.pos++;
			editor.innerHTML = this.history[this.pos];
			CodePress.findString();
		},
		
		redo : function() {
			this.pos++;
			if(typeof(this.history[this.pos])=='undefined') this.pos--;
			editor.innerHTML = this.history[this.pos];
			CodePress.findString();
		},
		
		next : function() { // get next vector position and clean old ones
			if(this.pos>20) this.history[this.pos-21] = undefined;
			return ++this.pos;
		}
	}
}

Language={};
window.addEventListener('load', function() { CodePress.initialize('new'); }, true);
