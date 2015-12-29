<?php
require_once('config.php');
require_once('../config.php');
define('sugarEntry', true);
$current_directory = getcwd();
chdir('../');
// include ('include/MVC/preDispatch.php');
$startTime = microtime(true);

require_once('include/database/DBManagerFactory.php');
require_once('include/TimeDate.php');
require_once('include/SugarLogger/LoggerManager.php');
require_once 'include/SugarObjects/SugarConfig.php';
require_once('include/utils.php');
require_once('include/utils/file_utils.php');
$GLOBALS['log'] = LoggerManager::getLogger('SugarCRM');
$timedate = TimeDate::getInstance();
$db = DBManagerFactory::getInstance();

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
   "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <title>Webform Import</title>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
  <link rel='stylesheet' href='style.css' type='text/css'/>
  <link rel="stylesheet" type="text/css" media="all" href="js/tablesort/style.css" />
  <link rel="stylesheet" type="text/css" media="all" href='../include/javascript/jquery/themes/base/jquery.ui.all.css'/>
<style>
  ul.ui-autocomplete {
    font-size: .8em;
  }
  ul.ui-autocomplete .details {
    display: block;
    font-size: .9em;
    color: #666;
  }
  th { padding: 3px; }
  table { height: 20%; overflow: auto;   font-size: 12px; margin: auto;}
  #table input, #table textarea { width: 400px; padding: 4px; }
  .message { 
    padding: 10px;
    background: #99DD99;
    margin: 20px auto;
  } 
  #container { max-width: 800px; margin: auto; }
  </style>

  <script src="codepress/codepress.js" type="text/javascript"></script>
  <script src="js/prototype.js" type="text/javascript"></script>
  <script src="js/scriptaculous.js" type="text/javascript"></script>
  <script type="text/javascript" src="js/tablesort/fastinit.js"></script>
  <script type="text/javascript" src="js/tablesort/tablesort.js"></script>  
  <script type="text/javascript" src='lib.js'></script>
  <script type="text/javascript" src="../cache/include/javascript/sugar_grp1_jquery.js"></script>  
  <script>
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
  });

  var loadArrestee = function() {
    $.each(db_arrestee, function(k, v) {
      $('#a_'+k).html(v);
    });
    $('#id').val(db_arrestee.id);
    $('#update').show();
    $('#name').html(db_arrestee.first_name+ ' '+db_arrestee.last_name);
  }
  </script>

</head>
<body style=''>
<div id='container'>
<h2>Import Online Intake Data</h2>
Search for names first. Make sure arrest date is the same (in case they got arrested more than once).
<?php 
  $filename = '/home/nlg/data/intakes.csv';
  copy($filename, $filename.".bak");
  $msg = "";
  if (isset($_REQUEST['email'])) {
    $data = readData();
    if ($_REQUEST['email'] == $data['email']) {
      $id = "";
      $name = "$data[first_name] $data[last_name]";
      if ($_REQUEST['id']) {
        $id = $_REQUEST['id'];
        $msg = "Updated $name";
      } else {
        $msg = "Created new arrest record for $name"; 
      }
      updateArrestee($data, $id);
      rewriteFile();
    }
  }
  if($msg) { 
    print "<div class='message'>$msg</div>";
  }
  $data = readData();
  $contents = "";
  foreach(array_keys($data) as $field) {
    $contents .= "<tr><td>$field</td><td>$data[$field]</td><td id='a_$field'></td></tr>";
  }

?>
  Search for arrestee name: <input id='query_string'/>
  <table>
    <tr><th>Field</th><th>Webform value</th><th>DB Value</th></tr>
    <?php echo $contents; ?>
  </table>
  <form id='form'>
    <input name='id' id='id' type='hidden'/>
    <input name='email' type='hidden' value='<?php echo $data['email']; ?>'/>
    <button onclick='$("#form").submit()' id='create'>Create new arrest record</button>
    <button style='display: none;' onclick='$("#form").submit()' id='update'>Update arrest record for <span id='name'></button>
  </form>
</div>
</body></html>
<?php

function readData() {
  global $filename;
  $file = file_get_contents($filename);
  $rows = parse_csv($file);
  // print_r($rows);
  $fields = array(
    'first_name',
    'last_name',
    'preferred_name',
    'date_of_birth',
    'phone_mobile',
    'email',
    'primary_address_street',
    'primary_address_city',
    'primary_address_state',
    'primary_address_postalcode',
    'arrest_date',
    'arrest_time',
    'arrest_city_c',
    'arrest_location',
    'support_needs_c',
    'felony_charges',
    'police_report_number_c',
    'docket_c',
    'first_appearance_date_c',
    'next_hearing_time_c',
    'cant_attend_c',
    'medical_needs_c',
    'description',
  );

  $data = array();
  $row = $rows[0];
  $fieldcount = count($row);
  if (count($fields)+2 != $fieldcount) { 
    if ($fieldcount == 1) {
      $msg= "No online intakes to import";
    } else { 
      $msg= "field count mismatch: is ".count($row)." but should be ".(count($fields)+2)."\n";
    }
    print "<div class='message'>$msg</div>";
    exit();
  }
  $id = array_shift($row);
  $date = array_shift($row);
  foreach ($fields as $field) {
    $value = array_shift($row);
    if (strpos($field, 'date') !== false) {
      $value = fixDate($value);
    } else if ($field == 'arrest_city_c') {
      $data['jurisdiction_c'] =  $value == 'San Francisco' ? 'SF' : 'A';
    } else if ($field == 'description') {
      $value.= "\nUpdated from online intake on ".substr($date, 0, 10);
    }
    $value = str_replace(";", "\n", $value);
    $data[$field] = $value;
  } 
  $data['release_type_c'] ='unkown_released';
  $arrestee = array_shift(dbLookupArray("select * from arrestees where id='$id'"));
  if (isset($arrestee['release_type_c'])) { 
    if ($arrestee['release_type_c'] != 'in') {
      $data['release_type_c'] = $arrestee['release_type_c'];
    }
  }
  return $data;
}

//parse a CSV file into a two-dimensional array
//this seems as simple as splitting a string by lines and commas, but this only works if tricks are performed
//to ensure that you do NOT split on lines and commas that are inside of double quotes.
function parse_csv($str) {
  //match all the non-quoted text and one series of quoted text (or the end of the string)
  //each group of matches will be parsed with the callback, with $matches[1] containing all the non-quoted text,
  //and $matches[3] containing everything inside the quotes
  $str = preg_replace_callback('/([^"]*)("((""|[^"])*)"|$)/s', 'parse_csv_quotes', $str);

  //remove the very last newline to prevent a 0-field array for the last line
  $str = preg_replace('/\n$/', '', $str);

  //split on LF and parse each line with a callback
  return array_map('parse_csv_line', explode("\n", $str));
}

//replace all the csv-special characters inside double quotes with markers using an escape sequence
function parse_csv_quotes($matches) {
  $str = "";
  if (isset($matches[3])) {
    //anything inside the quotes that might be used to split the string into lines and fields later,
    //needs to be quoted. The only character we can guarantee as safe to use, because it will never appear in the unquoted text, is a CR
    //So we're going to use CR as a marker to make escape sequences for CR, LF, Quotes, and Commas.
    $str = str_replace("\r", "\rR", $matches[3]);
    $str = str_replace("\n", "\rN", $str);
    $str = str_replace('""', "\rQ", $str);
    $str = str_replace(',', "\rC", $str);
  }
  //The unquoted text is where commas and newlines are allowed, and where the splits will happen
  //We're going to remove all CRs from the unquoted text, by normalizing all line endings to just LF
  //This ensures us that the only place CR is used, is as the escape sequences for quoted text
  return preg_replace('/\r\n?/', "\n", $matches[1]) . $str;
}

//split on comma and parse each field with a callback
function parse_csv_line($line) {
  return array_map('parse_csv_field', explode(',', $line));
}

//restore any csv-special characters that are part of the data
function parse_csv_field($field) {
  $field = str_replace("\rC", ',', $field);
  $field = str_replace("\rQ", '"', $field);
  $field = str_replace("\rN", "\n", $field);
  $field = str_replace("\rR", "\r", $field);
  return $field;
}

function fixDate($date) {
  $dates = explode("/", $date);
  $year = $dates[2];
  if (count($year) == 2) {
    $dates[2] < 20 ? "20".$dates[2] : "19".$dates[2];
  }
  return "$year-$dates[0]-$dates[1]";
}

function rewriteFile() {
  global $filename;
  $firstline = false;
  if($handle = fopen($filename,'c+')){
      if(!flock($handle,LOCK_EX)){fclose($handle);continue;}
      $offset = 0;
      $len = filesize($filename);
      while(($line = fgets($handle,4096)) !== false){
          if(!$firstline){$firstline = $line;$offset = strlen($firstline);continue;}
          $pos = ftell($handle);
          fseek($handle,$pos-strlen($line)-$offset);
          fputs($handle,$line);
          fseek($handle,$pos);
      }
      fflush($handle);
      ftruncate($handle,($len-$offset));
      flock($handle,LOCK_UN);
      fclose($handle);
  }
  file_put_contents('../docs/files/online_intake/intakes.entered.csv', $firstline, FILE_APPEND | LOCK_EX);
}
exit();
?>

