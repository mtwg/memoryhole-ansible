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
		editor = document.getElementsByTagName('pre')[0];
		editor.contentEditable = 'true';
		document.getElementsByTagName('body')[0].onfocus = function() {editor.focus();}
		document.attachEvent('onkeydown', this.metaHandler);
		document.attachEvent('onkeypress', this.keyHandler);
		window.attachEvent('onscroll', function() { if(!CodePress.scrolling) setTimeout(function(){CodePress.syntaxHighlight('scroll')},1)});
		completeChars = this.getCompleteChars();
		/**/
		completeEndingChars =  this.getCompleteEndingChars();
		/**/
//		CodePress.syntaxHighlight('init');
		setTimeout(function() { window.scroll(0,0) },50); // scroll IE to top
	},
	
	// treat key bindings
	keyHandler : function(evt) {
		charCode = evt.keyCode;
		
		if( (completeEndingChars.indexOf('|'+String.fromCharCode(charCode)+'|')!= -1 ||	completeChars.indexOf('|'+String.fromCharCode(charCode)+'|')!=-1  ) && CodePress.autocomplete) { 
			// auto complete
			var found = CodePress.completeEnding(String.fromCharCode(charCode));
			if(found == false)
			     CodePress.complete(String.fromCharCode(charCode));
		}else if(chars.indexOf('|'+charCode+'|')!=-1||charCode==13) { 
			// syntax highlighting
		 	CodePress.syntaxHighlight('generic');
		}
		
		/* OLD VERSION
		if(completeChars.indexOf('|'+String.fromCharCode(charCode)+'|')!=-1 && CodePress.autocomplete) { // auto complete
			CodePress.complete(String.fromCharCode(charCode))
		}else if(chars.indexOf('|'+charCode+'|')!=-1||charCode==13) { 
			// syntax highlighting
		 	CodePress.syntaxHighlight('generic');
		}*/
	},

	metaHandler : function(evt) {
		keyCode = evt.keyCode;
		if(keyCode==9 || evt.tabKey) { 
			CodePress.snippets();
		}
		else if((keyCode==122||keyCode==121||keyCode==90) && evt.ctrlKey) { // undo and redo
			(keyCode==121||evt.shiftKey) ? CodePress.actions.redo() :  CodePress.actions.undo(); 
			evt.returnValue = false;
		}
		else if(keyCode==34||keyCode==33) { // handle page up/down for IE
			self.scrollBy(0, (keyCode==34) ? 200 : -200); 
			evt.returnValue = false;
		}
		else if(keyCode==46||keyCode==8) { // save to history when delete or backspace pressed
		 	CodePress.actions.history[CodePress.actions.next()] = editor.innerHTML;
		}
		else if((evt.ctrlKey || evt.metaKey) && evt.shiftKey && keyCode!=90)  { // shortcuts = ctrl||appleKey+shift+key!=z(undo) 
			CodePress.shortcuts(keyCode);
			evt.returnValue = false;
		}
		else if(keyCode==86 && evt.ctrlKey)  { // paste
			// TODO: pasted text should be parsed and highlighted
		}
	},

	// put cursor back to its original position after every parsing
	findString : function() {
	    range = self.document.body.createTextRange();
		if(range.findText(cc)){
			range.select();
			range.text = '';
		}
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
			return code.substring(code.indexOf('<P>'),code.lastIndexOf('</P>')+4);
		}
	},
	
	// syntax highlighting parser
	syntaxHighlight : function(flag) {
		if(flag!='init') document.selection.createRange().text = cc;
		o = editor.innerHTML;
		o = o.replace(/<P>/g,'\n');
		o = o.replace(/<\/P>/g,'\r');
		o = o.replace(/<.*?>/g,'');
		o = o.replace(/&nbsp;/g,'');			
		o = '<PRE><P>'+o+'</P></PRE>';
		o = o.replace(/\n\r/g,'<P></P>');
		o = o.replace(/\n/g,'<P>');
		o = o.replace(/\r/g,'<\/P>');
		o = o.replace(/<P>(<P>)+/,'<P>');
		o = o.replace(/<\/P>(<\/P>)+/,'</P>');
		o = o.replace(/<P><\/P>/g,'<P><BR/></P>');
		x = z = this.split(o,flag);

		if(arguments[1]&&arguments[2]) x = x.replace(arguments[1],arguments[2]);
	
		var scope = this.findFunctions().toString().replace(/(,)/g,"|") 
		if(scope.length > 0 )
			x = x.replace( new RegExp("\\b(" +  scope + ")\\b","g") , Language.Functions[0].output )

		for(i=0;i<Language.syntax.length;i++) 
			x = x.replace(Language.syntax[i].input,Language.syntax[i].output);

		editor.innerHTML = this.actions.history[this.actions.next()] = (flag=='scroll') ? x : o.replace(z,x);
		if(flag!='init') this.findString();
	},
	getRangeAndCaret : function() {	
		var range = document.selection.createRange();
		var caret = Math.abs(range.moveStart('character', -1000000)+1);
		range = this.getCode();
		range = range.replace(/\n\r/gi,'  ');
		range = range.replace(/\n/gi,'');
		return [range.toString(),caret];
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
		funcs = ['biox','courtesy_appointments','departments','departments_aliases','dept_codes','dissertations','faculty','faculty_appointments','faculty_courses','faculty_years','opus_committee_members','phd_committees','pta','pta_grants','school_aliases','schools','spo','student_programs','students','sufin','sufin_grants','1st_year_course_units','2000_IIP_Grant','2002_IIP_Grants','2003_Affiliated_faculty','2003_Clark_Center_Faculty','2003_Core_Facilities_Committee','2003_IIP_Committee','2003_Leadership_Council','2004_Advisory_Council','2004_Affiliated_Faculty','2004_Clark_Center_Faculty','2004_Scientific_Leadership_Council','2005_Advisory_Council','2005_Affiliated_Faculty','2005_Clark_Center_Faculty','2005_Scientific_Leadership_Council','2006_Advisory_Council','2006_Affiliated_Faculty','2006_Clark_Center_Faculty','2006_IIP_Grants','2006_Scientific_Leadership_Council','2007_Advisory_Council','2007_Affiliated_faculty','2007_Clark_Center_Faculty','2007_Clark_Center_Shared_Equipment_List','2007_Executive_Committee','2007_Scientific_Leadership_Council','2nd_year_course_units','academic_plan','account_code','account_title','adjusted_appointment_distribution_percent','administrative_appointment','admission_term','advisor_faculty_id','__advisor_name','advisor_role_code','advisor_role_description','age','alias','amount','appointment_date','appointment_description','appointment_distribution_percent','appointment_order','appointment_start_date','appointment_stop_date','appointment_type','area','availability_percentage','awarded_total','award_id','award_manager_faculty_id','__award_manager_name','award_name','__award_owner_emplid','award_owner_faculty_id','__award_owner_name','award_school_id','__award_school_name','competitive_segment_id','contract_length','course_count_excluding_individual_instruction','course_count_excluding_low_enrollment','course_count_including_individual_instruction','course_id','course_title','course_type','courtesy_appointment_id','current_age','degree','degree_year','__department_code','department_id','__department_name','department_name','dept_id','dissertation_id','dissertation_title','employee_id','ethnicity','facdep','faculty_appointment_id','faculty_course_id','faculty_id','__faculty_name','faculty_year_id','fiscal_year','fullname','fulltime_equivalence_percentage','fulltime_equivalent_percentage','fund_code','funded','fund_title','gender','graduate_course_units','graduate_enrollment_count','graduate_plus_other_units','graduation_date','graduation_term','grant_type','hire_date','id','instructor_count','__investigator_department_name','investigator_dept_id','investigator_faculty_id','__investigator_name','investigator_school_id','__investigator_school_name','investigator_type','job_classification_code','job_classification_code_description','level','line','major_advisor_faculty_id','__major_advisor_name','name','new_tenure_status','non_stanford','opus_advisor_faculty_id','__opus_advisor_name','opus_chair_faculty_id','__opus_chair_name','opus_committee_member_id','other_course_units','other_enrollment_count','__outside_reader_name','outside_reader_role','percent_1st_plus_2nd_year_units','percent_1st_year_units','percentage','person_matches_id','phd_committee_id','__primary_department_code','primary_department_id','__primary_department_name','__primary_investigator_emplid','__primary_investigtor_name','primary_job_classification_code','primary_line','program_name','program_order','program_status','project_description','project_id','project_manager_faculty_id','__project_manager_name','__project_owner_emplid','project_owner_faculty_id','__project_owner_name','__project_owning_department_name','project_owning_dept_id','project_owning_school_id','__project_owning_school_name','project_title','proposal_count','proposed_total','prorated_1st_year_units','prorated_2nd_year_units','prorated_grad_plus_other_units','prorated_other_undergrad_units','prorated_undergrad_units','pta_grant_id','pta_id','reader_faculty_id','school_alias_id','__school_code','school_id','__school_name','school_name','spo_id','sponsor_organization','__student_emplid','student_id','__student_name','student_program_id','sub_plan','subschool_name','sufin_grant_id','sufin_id','task_description','task_id','task_manager_faculty_id','__task_manager_name','__task_owner_emplid','task_owner_faculty_id','__task_owner_name','tenured','tenure_status','tier','total_amount','total_couse_units','total_enrollment_count','total_percentage','undergrad_course_units','undergrad_enrollment_count','used'];
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
				content = content.replace(/\n/g,'</P><P>');
				var pattern = new RegExp(trigger+cc);
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
		editor.contentEditable = (arguments[0]) ? 'false' : 'true';
	},
	
	complete : function(trigger) {
		var complete = Language.complete;
		for (var i=0; i<complete.length; i++) {
			if(complete[i].input == trigger) {
				var pattern = new RegExp('\\'+trigger+cc);
				var content = complete[i].output.replace(/\$0/g,cc);
				setTimeout(function () { CodePress.syntaxHighlight('complete',pattern,content)},0); // wait for char to appear on screen
			}
		}
	},
//NEW *************************
/*
	returns a list of autocompletion ending
	characters. These characters come from the last characters in
	Language.complete's output string.
*/
	getCompleteEndingChars : function() {
	   var cChars = '';
		for(var i=0;i<Language.complete.length;i++)
			cChars += '|'+Language.complete[i].output.charAt(Language.complete[i].output.length-1);
		return cChars+'|';
	},
/*
	checks if the character after the cursor is the same
	character we just typed. If it is, it removes the next character, and
	returns true, otherwise it just returns false.
*/	
	completeEnding : function(trigger) {
       var range = document.selection.createRange();
       try{
            range.moveEnd('character', 1)
       }catch(e)
       {
        return false;
       }
       var next_character = range.text
       range.moveEnd('character', -1)
       if(next_character != trigger  )
		  return false;
	   else
       {
            range.moveEnd('character', 1)
            range.text=''
            return true;
       }
    },
//*	*******************************
	getCompleteChars : function() {
		var cChars = '';
		for(var i=0;i<Language.complete.length;i++)
			cChars += '|'+Language.complete[i].input;
		return cChars+'|';
	},

	shortcuts : function() {
		var cCode = arguments[0];
		if(cCode==13) cCode = '[enter]';
		else if(cCode==32) cCode = '[space]';
		else cCode = '['+String.fromCharCode(keyCode).toLowerCase()+']';
		for(var i=0;i<Language.shortcuts.length;i++)
			if(Language.shortcuts[i].input == cCode)
				this.insertCode(Language.shortcuts[i].output,false);
	},
	
	insertCode : function(code,replaceCursorBefore) {
		var repdeb = '';
		var repfin = '';
		
		if(replaceCursorBefore) { repfin = code; }
		else { repdeb = code; }
		
		if(typeof document.selection != 'undefined') {
			var range = document.selection.createRange();
			range.text = repdeb + repfin;
			range = document.selection.createRange();
			range.move('character', -repfin.length);
			range.select();	
		}	
	},

	// get code from editor	
	getCode : function() {
		var code = editor.innerHTML;
		code = code.replace(/<br>/g,'\n');
		code = code.replace(/<\/p>/gi,'\r');
		code = code.replace(/<p>/i,''); // IE first line fix
		code = code.replace(/<p>/gi,'\n');
		code = code.replace(/&nbsp;/gi,'');
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
		editor.innerHTML = '<pre>'+code+'</pre>';
	},

	
	// undo and redo methods
	actions : {
		pos : -1, // actual history position
		history : [], // history vector
		
		undo : function() {
			if(editor.innerHTML.indexOf(cc)==-1){
				document.selection.createRange().text = cc;
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
window.attachEvent('onload', function() { CodePress.initialize('new');});
