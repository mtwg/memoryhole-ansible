
function deleteFile(id) { 
	var filename = document.getElementById(id+'_name').innerHTML;
	var answer = confirm("Are you sure you want to delete "+filename+"?");
	if (answer) {
		delurl = url + "id="+ id + "&dir="+encodeURI(dir)+"&action=delete&filename=" + encodeURI(filename);
		submitChange(delurl);
		obj = document.getElementById(id);
		obj.parentNode.removeChild(obj);
		toggle();
	}
}

function editComment(id) {
	var cell = document.getElementById(id);
	cell.setAttribute('onClick', function(e) { return; });
	cell.style.padding="0px";
	var div = document.createElement('textarea');
	div.style.border="1px solid black";
	div.style.padding="0px";
	div.style.margin="0px";
	div.style.width='100%';
	div.style.fontSize="12px";
	div.style.fontFamily='"Verdana", "Arial", "Helvetica", sans-serif"';
	div.setAttribute('cols', 60);
	div.setAttribute('id', 'edit')
	div.setAttribute('onBlur', 'saveEdit(this)');
	//div.setAttribute('onKeyPress', 'checkKey(event)');
	var text = cell.innerHTML;

	count = 0;
	pos = text.indexOf("<br>");
	while ( pos != -1 ) {
	   count++;
	   pos = text.indexOf("<br>",pos+1);
	}	
	div.setAttribute('rows', count);
	text = text.replace(/&amp;/g, "&");
	text = text.replace(/&nbsp;/g, " ");
	text = text.replace(/&lt;/g, "<");
	text = text.replace(/&gt;/g, ">");
	text = text.replace(/<br>/g, "\n");
	div.value = text;
	var tempdiv = document.createElement('div');
	tempdiv.setAttribute('id', 'tempdiv');
	tempdiv.style.display = 'none';
	tempdiv.innerHTML = cell.innerHTML;
	cell.innerHTML = "";
	cell.appendChild(div);
	cell.appendChild(tempdiv);
	div.focus();
}

function initDrag() {
	table = document.getElementById('filelist').childNodes[1];
	pmove = new YAHOO.util.DD('pwindowmove');
	pmove.setDragElId('pwindow');
	for (var x = 1; x < table.rows.length; x++) {
		var row = table.rows[x];
		if (row) {
			var dragdiv = document.getElementById('file'+row.id);
			dd[x]= new YAHOO.util.DD('file'+row.id);
			dd[x].setDragElId('dragrow'+row.id);
			if (dragdiv.getAttribute('dir') != 1) { dd[x].isTarget = 0; }
			//dragdiv['init']  = YAHOO.util.Dom.getXY(dragdiv);
			dd[x].startDrag = function(e) {
				var el = this.getEl().parentNode;
				el['init'] = YAHOO.util.Dom.getXY(el);
				el.style.opacity='.80';
				el.style.border='1px solid #000000';
				el.style.background='#ffffff';
				//el.style.zIndex+=1000;
			}
			dd[x].onDragEnter = function(e, id) {
				var drop = document.getElementById(id);
				drop.innerHTML = drop.innerHTML.replace(/folder.png/, "folder_open.png");
				if(drop.getAttribute('class') == 'drop') {
					drop.style.background="#ddddFF";
				} else {
					drop.parentNode.parentNode.style.background="#ddddFF";
				}
			}
			dd[x].onDragOut = function(e, id) {
				var drop = document.getElementById(id);
				drop.innerHTML = drop.innerHTML.replace(/folder_open.png/, "folder.png");
				if(drop.getAttribute('class') == 'drop') {
					drop.style.background="";
				} else { drop.parentNode.parentNode.style.background=""; }

			}
			dd[x].onDragDrop = function(e, id) {
				var drop = document.getElementById(id);
				var drag_id = this.getEl().parentNode.parentNode.parentNode.id;
				var newdir;
				debug(id);
				if(drop.getAttribute('file')) {
					newdir = drop.getAttribute('file');
				} else { newdir = 	document.getElementById(drop.parentNode.parentNode.parentNode.id+'_name').innerHTML; }
				if (newdir != dir) {
					var filename = document.getElementById(drag_id+'_name').innerHTML;
					if(! newdir.match(/^\//)) { newdir = dir+'/'+newdir; }
					submitChange(url + "action=move&filename="+ encodeURI(filename) + "&dir=" + encodeURI(dir) + "&newdir=" + encodeURI(newdir));
					var row = document.getElementById(drag_id);
					row.parentNode.removeChild(row);
					toggle();
				}	
				drop.innerHTML = drop.innerHTML.replace(/folder_open.png/, "folder.png");
				if(drop.getAttribute('class') == 'drop') {
					drop.style.background="";
				} else { drop.parentNode.parentNode.style.background=""; }
			}

			dd[x].endDrag = function(e) {
				var el = this.getEl();
				el.parentNode.style.opacity='1';
				el.parentNode.style.border='0px';
				YAHOO.util.Dom.setXY(el.parentNode, el.parentNode['init']);
				el.parentNode.style.background='';
				//el.style.zIndex-=1000;
				//debug('hi'+el['init']+el.parentNode['init']);
			}
		}
	}
	var crumbs = document.getElementById('crumbs').childNodes;
	//debug(crumbs);
	for( var crumb in crumbs) {
		if(crumbs[crumb].id) {
			dd[crumbs[crumb].id] = new YAHOO.util.DDTarget(crumbs[crumb].id);		
			//debug(crumbs[crumb].id);
		}
	}
}	

function toggle() {
	//debug('here we go!');
	table = document.getElementById('filelist').childNodes[1];
	rowclass = 'off';
	for (var x = 1; x < table.rows.length; x++) {
		var row = table.rows[x];
		if (row) {
			if (rowclass == "off") {  rowclass = "on"; } else { rowclass = "off"; }
			row.setAttribute('class', 'row_'+rowclass);
			var dragdiv = document.getElementById('file'+row.id);
			dragdiv.setAttribute('class', 'drag row_'+rowclass);
		}
	}
}

function debug(text) {
return;
if (!document.getElementById('log')) {
	var log = document.createElement('div');
	log.id = 'log';
	log.setAttribute('style', 'position: absolute; top: 10px; left: 10px; float: left; width: 600px; height: 100px; background: white; border: 1px solid; overflow: auto; text-align: left;');
	document.childNodes[1].childNodes[1].appendChild(log);
	var logdrag = new YAHOO.util.DD('log');
}
var log = document.getElementById('log');
var bg = 'lightgrey';
if (log.lastChild) { bg = log.lastChild.style.backgroundColor; }
if (bg == 'white') { bg = 'lightgrey'; } else { bg = 'white'; }
var now = new Date();
text = now.getHours()+':'+now.getMinutes()+':'+now.getSeconds()+' - '+text;
log.innerHTML += "<div style='background: "+bg+";'>"+text+"</div>";
}	

function saveEdit(input, filename) {
	var filename = document.getElementById(input.parentNode.parentNode.id+'_name').innerHTML;
	var cell = input.parentNode;
	var tempdiv = document.getElementById('tempdiv');
	var text = input.value;
	text = text.replace(/&/g, "&amp;");
	text = text.replace(/\n/g, "<br>");
	text = text.replace(/\r/g, "<br>");
	if (text != tempdiv.innerHTML) {
		submitChange(url+"id=6&comment="+encodeURI(text)+"&dir="+encodeURI(dir)+"&filename="+encodeURI(filename));
	}
	cell.removeChild(tempdiv);
	cell.style.padding = '1px';
	cell.innerHTML = text;
	cell.setAttribute('onClick', 'editComment("'+cell.getAttribute('id')+'","'+filename+'")');
}

function saveFile(filename) {
	debug(filename);
	submitChange('request.php', 'action=savefile&filename='+encodeURI(filename)+'&dir='+dir+'&content='+encodeURIComponent(document.getElementById('ptext').value));
}
function submitChange(url, data) {
//value = escape(value);
//var url = "request.php?action=submitChange&field="+field+"&value="+value+"&id="+id;
//debug(url);
perform_request(url, function(xml) {
	//var qdiv = document.getElementById('query');
	//qdiv.innerHTML = xml.documentElement.getElementsByTagName('query')[0].firstChild.nodeValue;
	feedback(xml, 'good');
}, data);
//tasks[id][field] = value;
//if (field == sortby) { setSort(sortby); }
//filter();
}

function perform_request(url, do_function, postdata) {
	var request = new XMLHttpRequest();
	if (postdata) { request.open("POST", url, true);
	} else { request.open("GET", url, true); }
	request.onreadystatechange = function() {
		if (request.readyState == 4) {
			var xml = request.responseText;
			//if (! xml) { debug(request.responseText); }
			if (do_function) { do_function(xml); }
		}
	}
	if (postdata) {
		request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
		request.send(postdata);	
	} else { request.send(null); }
} 

function rename(id) {
	var width = document.getElementById(id).childNodes[1].offsetWidth - 66;
	document.getElementById(id+'_name').style.display = 'none';
	document.getElementById('ren'+id).style.display = 'inline';
	document.getElementById('ren'+id).innerHTML = '<textarea fid="'+id+'" style="height: 16px; border: 1px solid #cccccc; padding:0px; margins:0px;overflow: hidden; width: '+width+'px;">'+document.getElementById(id+'_name').innerHTML+'</textarea>';
	var renamebox = document.getElementById('ren'+id).childNodes[0];
	var filename = renamebox.innerHTML.match(/\.\w+$/);
	if (filename) { 
		renamebox.setSelectionRange(0,renamebox.innerHTML.length - filename[0].length);
	} else { renamebox.select(); }
	renamebox.setAttribute('onBlur', "doRename(this)");
	renamebox.focus();
	renamebox.setAttribute('onKeyPress', 'return checkKey(event, '+id+')');
}	

function doRename (input) {
var id = input.getAttribute('fid');
var newname = document.getElementById('ren'+id).childNodes[0].value.replace(/\s*$/,'');
var oldname = document.getElementById(id+'_name').innerHTML;
if (newname.match(/\//)) { feedback('Name cannot contain slashes', 'bad'); return;}
if (newname.match(/\.\./)) { feedback('Name cannot contain ".."', 'bad'); return;}
if(newname != oldname) { 
	if (! newname.match(/^[\.\/\\]/)) { 
		submitChange(url + "action=rename&filename="+ encodeURI(oldname) + "&newname=" + encodeURI(newname) + "&dir=" + encodeURI(dir));
	} else { } //fixme
}
debug(document.getElementById('ren'+id).childNodes[0].value + 'vs' + document.getElementById(id+'_name').innerHTML);
document.getElementById('ren'+id).style.display = 'none';
document.getElementById(id+'_name').innerHTML = newname;
document.getElementById(id+'_name').style.display = 'inline';
var href = decodeURIComponent(document.getElementById(id+'_name').getAttribute('href'));
href = href.replace(/\/[^\/]*$/, '/'+newname);
debug("'"+href+"'");
document.getElementById(id+'_name').setAttribute('href', encodeURI(href));
}	


function checkKey(e, id) {
var keycode = window.event ? e.keyCode : e.which;
if (keycode == 13) { 
	var field = document.getElementById('ren'+id).childNodes[0];
	field.blur();
	return false;
} else { return keycode; }
}

function feedback(text, fclass) {
	if (!fclass) { fclass = 'good'; }
	var feedback = document.getElementById('feedback');
	feedback.innerHTML = text;
	feedback.setAttribute('class', fclass);
	feedback.style.opacity = '1';
	feedback.style.display = 'block';
	//window.setTimeout(function() { 
	//	var anim = new YAHOO.util.Anim('feedback', { opacity: { to: 0 } }, 3, YAHOO.util.Easing.easeOut);	
	//	anim.animate();
	//}, 4000);
}

function preview(id) {
	var name = dir+'/'+document.getElementById(id+'_name').innerHTML;
	document.getElementById('ptitle').innerHTML = name;
	debug(id);
	var preview = document.getElementById('preview');
	preview.innerHTML = "";
	var savebutton = document.getElementById('savebutton');
	if (savebutton) { savebutton.parentNode.removeChild(savebutton); }
	if (document.getElementById('ptext')) { document.getElementById('ptext').parentNode.removeChild(document.getElementById('ptext')); }
	document.getElementById('pwindow').style.display = 'block';
	if (name.match(/.png$/, 'i') || name.match(/.gif$/, 'i') || name.match(/.jpg$/, 'i')) {
		var img = document.createElement('img');
		img.setAttribute('src', webdir+name);
		preview.appendChild(img);
		//preview.innerHTML = "<img style='border:1px solid; width:200px; height:20px;' src='"+document.getElementById(id+'_name').getAttribute('href')+"</img>";
	} else {
		var request = url+"action=view&filename="+encodeURI(document.getElementById(id+'_name').innerHTML)+'&dir='+dir;
		var savebutton = document.createElement('span');
		savebutton.id = 'savebutton';
		savebutton.innerHTML = "<a href='javascript:saveFile(\""+document.getElementById(id+'_name').innerHTML+"\")'><img src='images/save.png' title='Save'/></a>";
		savebutton.style.position = 'absolute';
		savebutton.style.right = '28px';
		document.getElementById('ptitlebar').appendChild(savebutton);
		perform_request(request, function(xml) {
			preview.innerHTML = "<textarea id='ptext' style='width: 98%; height: 95%; border: 1px solid black;'>"+xml+"</textarea>";
		});
	}
}

function hide(id) { document.getElementById(id).style.display = 'none'; }

function addUpload() {
	var upload = document.getElementById('upload');
	document.getElementById('uploadhead').style.backgroundColor='#FFE3B5';
	document.getElementById('dirhead').style.backgroundColor='#FFFFFF';
	document.getElementById('createdir').style.display='none';
	upload.style.display = 'inline';
	var fields = document.createElement('div');
	fields.id = 'upload1';
	fields.setAttribute('style', 'padding: 5px; position: relative; top: 0px; left: 0px; height: 3.3em;');
	fields.innerHTML = '<span>File: <br/>Comment: &nbsp; </span><span style="position: absolute; top: 0px;"><input type="file" name="infiles[]"/><br/><input type="text" name="comment'+uploadcount+'"/></span>'
	document.getElementById('uploadfields').appendChild(fields);	
	uploadcount++;
}

function createDir() {
	document.getElementById('dirhead').style.backgroundColor='#FFE3B5';
	document.getElementById('uploadhead').style.backgroundColor='#FFFFFF';
	document.getElementById('createdir').style.display='block';
	document.getElementById('upload').style.display='none';
}

