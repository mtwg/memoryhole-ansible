<?php
require_once('config.php');
require_once('Curl.php');
use \Curl\Curl;

$arrestee = array();
$initDocket = $_REQUEST['docketNumber'];
if (isset($_REQUEST['id'])) {
  $id = $db->quote($_REQUEST['id']);
  $arrestee = json_encode(array_values(dbLookupArray("select * from arrestees where id = '$id'"))[0]);
}
if ($_REQUEST['action'] == 'fetch') {
  print $arrestee;
  exit();
} else if ($_REQUEST['action'] == 'import') {
  $data = $_REQUEST;
  unset($data['action']);
  $id = $data['id'];
  unset($data['id']);
  updateArrestee($data, $id);
  print "ok";
  exit();
}
if (isset($_REQUEST['frame'])) {
  $curl = new Curl();
  $curl->setCookieFile('cookies');
  $curl->setCookieJar('cookies');
  $_REQUEST['courtCode'] = $_REQUEST['courtCode'] ? $_REQUEST['courtCode'] : '01440';
  if (! isset($_REQUEST['viewDetails']) && !isset($_REQUEST['returnToSearchResult'])) {
    if ($_REQUEST['reportNumber']) { $_REQUEST['courtCode'] = ''; }
    $_REQUEST['findDocket'] = 'x';
    $curl->post("http://www.acgov.org/sheriff_app/docket/docketSearch.do", $_REQUEST);
  } else {
    $curl->get("http://www.acgov.org/sheriff_app/docket/docketDetail.do", $_REQUEST);
  } 
  
  $html = $curl->response;
  $curl->get('http://www.acgov.org/sheriff_app/jcaptcha.do');
  file_put_contents('image.jpg', $curl->response);

  $html = preg_replace("/\"\/sheriff/", '"http://www.acgov.org/sheriff', $html);
  $html = preg_replace("/action=\".*?\"/", 'action="docketFinder.php"', $html);
  $html = preg_replace('/method="post"/', 'method="get"', $html);
  $html = str_replace('http://www.acgov.org/sheriff_app/jcaptcha.do', 'image.jpg', $html);
  $html = str_replace('http://www.acgov.org/sheriff_app/docket/Master.css', 'Master.css', $html);
  $html = str_replace('</form>', '<input type="hidden" name="frame" value="1"/><input type="submit"/></form>', $html);
  $html = str_replace('src="/', 'src="http://www.acgov.org/', $html);
  print $html;
  $curl->close();
} else {

?>
<html><head>
  <title></title>
  <link rel='stylesheet' href='style.css' media="all" type='text/css'/>
  <link rel="stylesheet" type="text/css" media="all" href="js/tablesort/style.css" />
  <link rel="stylesheet" type="text/css" media="all" href='../include/javascript/jquery/themes/base/jquery.ui.all.css'/>
  <script type="text/javascript" src="../cache/include/javascript/sugar_grp1_jquery.js"></script>  
  <script type="text/javascript">
  var db_arrestee = <?php print $arrestee ? $arrestee : "{}"; ?>;
  var init_docket = '<?php print $initDocket ? $initDocket : ""; ?>';
  var docket_arrestee = {};
  $(function() {
    var proto = $.ui.autocomplete.prototype,
      initSource = proto._initSource;

    function filter( array, term ) {
      var matcher = new RegExp( $.ui.autocomplete.escapeRegex(term), "i" );
      return $.grep( array, function(value) {
        return matcher.test( $( "<div>" ).html( value.label || value.value || value ).text() );
      });
    }

    $.extend( proto, {
      _initSource: function() {
        if ( this.options.html && $.isArray(this.options.source) ) {
          this.source = function( request, response ) {
            response( filter( this.options.source, request.term ) );
          };
        } else {
          initSource.call( this );
        }
      },

      _renderItem: function( ul, item) {
        return $( "<li></li>" )
          .data( "item.autocomplete", item )
          .append( $( "<a></a>" )[ this.options.html ? "html" : "text" ]( item.label ) )
          .appendTo( ul );
      }
    });

    $('#query_string').autocomplete({
      source: function(request, response) {
        $.getJSON("../index.php", {entryPoint: 'quickSearch', name: request.term, module: 'legal_arrestees'}, response);
      },
      focus: function(event, ui) {
        $("#query_string").val(ui.item.name);
        return false;
      },
      select: function(event, ui) {
        if (ui.item.value == 'NOTFOUND') { return false; }
        $.getJSON("docketFinder.php", {id: ui.item.value, action:'fetch'}, function(response) {
          db_arrestee = response;
          loadArrestee();
        });
        //window.location.href='?module='+module+'&return_module='+module+'&action=EditView&record='+ui.item.value;
        $("#query_string").val('');
        return false;
      },
      html: true
    });

    var loadArrestee = function() {
      console.log(db_arrestee.docket_c);
      $('#name').html(db_arrestee.last_name+', '+db_arrestee.first_name);
      if (db_arrestee.docket_c != '') {
        $('#docket_button').show();
      } else {
        $('#docket_button').hide();
      }
      if (db_arrestee.police_report_number_c != '') {
        $('#report_button').show();
      } else {
        $('#report_button').hide();
      }
      checkImport();
    }

    if (db_arrestee.last_name) {
      loadArrestee();
    }
    loadPage();
  })

  var fields = ['last_name', 'first_name', 'booking_number_c', 'docket_c', 'police_report_number_c', 'support_needs_c', 'bail_c', 'first_appearance_date_c',  'next_hearing_time_c', 'first_appearance_location_c'];

  
  var checkImport = function() {
    if (db_arrestee.last_name && docket_arrestee.last_name) {
      $('#import_button').show();
    } else {
      $('#import_button').hide();
    }
  }

  var showImport = function() {
    $('#table tbody').html('');
    $('#message').remove();
    $.each(fields, function(i, v){
      var name = v.replace(/_c/g, '').replace(/_/g, ' ').replace('first appearance', 'next hearing').replace('location', 'notes');
      var input = "<input name='"+v+"' value='"+docket_arrestee[v]+"'/>";
      if (v == 'support_needs_c') {
        input = "<textarea name='"+v+"' rows=3>"+docket_arrestee[v]+"</textarea>";
      }
      $('#table tbody').append("<tr><td>"+name+"</td><td>"+db_arrestee[v]+'</td><td>'+input+"</td></tr>");      
    })
    $('#table tbody').append("<input name='id' type='hidden' value='"+db_arrestee.id+"'/>");
    $('#table tbody').append("<input name='action' type='hidden' value='import'/>");
    $('#import').dialog({
      modal: true,
      title: 'Import Docket Info',
      width: '800'
    });
  }

  var doImport = function() {
    $.post("docketFinder.php", $('#importForm').serialize(), function(response) {
      var message = response == 'ok' ? 'Data successfully updated' : 'Error: '+response;
      $('#import').prepend("<div id='message'>"+message+"</div>");
      console.log(response);
    });
  }

  var loadPage = function(lookupReport) {
    var docket = ''
    var report = '';
    if(lookupReport) {
      report = db_arrestee['police_report_number_c'] ? db_arrestee['police_report_number_c'] : '';
      agency = '00109';
      $('#bottom').attr('src', 'docketFinder.php?frame=1&docketNumber=&reportNumber='+report+'&arrestAgencyCode=00109');
    } else {
      docket = init_docket;
      //docket = docket ? docket : db_arrestee['docket_c'];
      //docket = docket ? docket : init_docket;
      $('#bottom').attr('src', 'docketFinder.php?frame=1&docketNumber='+docket);
    }
    // $('#bottom').attr('src', 'https://www.acgov.org/sheriff_app/docket/docketSearch.do?docketNumber='+docket+'&findDocket=x&findDocket2=&courtCode=01440');
  }

  var updateDocket = function() {
    $('#bottom').contents().find('#mainsite > table > tbody > tr:nth-child(5) > td > form > table:nth-child(6) > tbody > tr:nth-child(4) > th > input').focus();
    if ($('#bottom').contents().find('body')[0].innerHTML.match('Marsy') != null) { return; }
    var tds = $('#bottom').contents().find('.tableBorder2 td');
    docket_arrestee.last_name = wordcase(tds[0].innerText.split(', ')[0].trim());
    docket_arrestee.first_name = wordcase(tds[0].innerText.split(', ')[1].trim());
    docket_arrestee.booking_number_c = tds[1].innerText.trim();
    docket_arrestee.docket_c = tds[2].innerText.trim();
    docket_arrestee.police_report_number_c = tds[5].innerText.trim();
    docket_arrestee.support_needs_c = '';
    $.each($('#bottom').contents().find('th:contains("Arrest")').parents('.tableBorder1').find('tbody>tr:eq(1) tr:not(".grey") td'), function(i, td){
      if (i % 2 == 1 ) { return; }
      var charge = td.innerText.trim();
      var desc = $(td).next('td')[0].innerText.trim();
      if (! charge ) { return; }

      docket_arrestee.support_needs_c += charge;
      if (desc) { 
        docket_arrestee.support_needs_c += "     "+desc;
      }
      docket_arrestee.support_needs_c += '\n';
    })
    tds = $('#bottom').contents().find('th:contains("Arrest")').parents('.tableBorder1').find('tbody>tr:eq(3) td');
    docket_arrestee.docket_c = tds[0].innerText.trim();
    docket_arrestee.bail_c = tds[2].innerText.trim();
    tds = $('#bottom').contents().find('th:contains("Arrest")').parents('.tableBorder1').find('tbody>tr:eq(3) table tr:eq(2) td');
    var date = tds[0].innerText.trim().split('/');
    docket_arrestee.first_appearance_date_c = date[2]+'-'+date[0]+'-'+date[1];

    docket_arrestee.next_hearing_time_c = tds[1].innerText.trim() + ' - Dept. ' + tds[2].innerText.trim();
    docket_arrestee.first_appearance_location_c = tds[3].innerText.trim();
    checkImport();
  }

  function wordcase(str) {
    var lower = str.toLowerCase();
    return lower.replace(/(^| )(\w)/g, function(x) {
      return x.toUpperCase();
    });
  }

  </script>
  <style>
  html, body { height: 100%; margin: 0px; padding: 0px;}
  iframe { border: 1px solid;  box-sizing: border-box;}
  #top { padding: 10px; position: absolute; top: 0px; left: 0px; overflow: auto; z-index: 100; background: rgba(230,230,230, .9);}
  #bottom { top: 0; height: 100%; width: 100%;left: 0px; position: absolute;}
  ul.ui-autocomplete {
    list-style: none;
    font-size: 12px;
  }

  ul.ui-autocomplete .details {
    display: block;
    font-size: .9em;
    color: #666;
  }
  th { padding: 3px; }
  table { height: 20%; overflow: auto;   font-size: 12px; }
  #table input, #table textarea { width: 400px; padding: 4px; }
  #message { 
    padding: 10px;
    background: #99DD99;
  }
  </style>
  </head>
  <body style='margin: 0px; padding: 0px;'>
  <div id='top'>
    <input id='query_string' placeholder='Search Arrestees'/>
    <span id='name'></span>
    <input id='docket_button' style='display: none;' type='button' onclick="init_docket=db_arrestee['docket_c']; loadPage()" value='Look Up Docket'/>
    <input id='report_button' style='display: none;' type='button' onclick="loadPage(true)" value='Look Up Police Report'/>
    <input id='import_button' style='display: none;' type='button' onclick="showImport()" value='Import Docket Information'/>
    <div id='import' style='display: none;' >
      <form id='importForm'>
      <table id='table' border=1 class='sortable'>
        <thead>
          <tr>
            <th>Field</th>
            <th>Old Value</th>
            <th>New Value</th>
          </tr>
        </thead>
        <tbody></tbody>
      </table>
      </form>
      <button onClick='$("#import").dialog("close")'>Cancel</button>
      <button onClick='doImport()'>Import</button>
    </div>
  </div>

  <iframe id='bottom' src='' onload='updateDocket()'></iframe>
  </body>
  </html>

  <?php } ?>