<?php
if($_SERVER["HTTPS"] != "on") {
  header("Location: https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]);
  exit();
}
readfile("header.ssi");
$message = "";
if (isset($_REQUEST['submit-button'])) { 
  $error = "";
  try {
    $lockfile = '/home/dameat/data/info.txt.lock';
    $values = $_REQUEST;
    while( file_exists($lockfile) ) { usleep(10000); }
    touch($lockfile);
    $file = fopen('/home/dameat/data/info.txt', 'a');
    unset($values['submit-button']);
    array_unshift($values, date('c'));
    fputcsv($file, $values);
    fclose($file);
    unlink($lockfile);

    
  }catch (Exception $e) {
    $error = $e->getMessage();
  }
  if ($error == "") {
    $message = "<div class='alert alert-success text-center' id='response'><b>Thank you for sending us your info! Please check out the <a href='/?page_id=62'>latest news</a>!</b></div>";
  } else {
    $message = "<div class='alert alert-danger text-center' id='error'><b>An error occured while processing your form. Please try again.</b></div>";
  }
} 
?>
<!-- and jQuery v1.9.1 or higher -->
<style>
  .form-control-feedback {
    right: -15px !important;
  }
</style>

<article id="post-8" class="page type-page status-publish hentry">
  <header class="entry-header"><h1 class="entry-title">Arrestee Intake Form</h1></header><!-- .entry-header -->
  <div class="entry-content container-fluid">
    <?php print $message; ?>

    <p class='row'>
      We will only use this information to track people's cases, distribute information, and facilitate legal defense.
      This information will not be shared or released, and it is collected and stored securely.
    </p>
    <p><i>Note - if you were arrested multiple times, please fill out this form once for each arrest</i></p>

  <form id='intake' method='post' action='index.php' class='form-horizontal intake'
      data-bv-feedbackicons-required='glyphicon glyphicon-asterisk'
      data-bv-feedbackicons-valid="glyphicon glyphicon-ok"
      data-bv-feedbackicons-invalid="glyphicon glyphicon-remove"
      data-bv-feedbackicons-validating="glyphicon glyphicon-refresh">
    <h2 class='row'>Personal Information</h2>
      <div class='form-group'>
        <label class='control-label col-sm-6' for='first_name'>First Name</label>
        <div class='col-sm-6'>
          <input class="form-control"
          data-bv-notempty="true"
          data-bv-notempty-message="This field is required and cannot be empty"
          type="text" id="first_name" name="first_name"/>
        </div>
      </div>
      <div class='form-group'>
        <label class='control-label col-sm-6' for='last_name'>Last Name</label>
        <div class='col-sm-6'>
          <input class="form-control"
          data-bv-notempty="true"
          data-bv-notempty-message="This field is required and cannot be empty"
          type="text" id="last_name" name="last_name"/>
        </div>
      </div>
      <div class='form-group'>
        <label class='control-label col-sm-6' for='dob'>Date of Birth</label>
        <div class='col-sm-6'>
          <input autocomplete="off" type="text" id="dob" name="dob" class="form-control validate-date datepicker" 
          data-bv-notempty="true"
          data-bv-notempty-message="This field is required and cannot be empty"
          data-bv-date="true"
          data-bv-date-message="This is not a valid date"
          data-provide="datepicker"
          data-data-date-format="mm/dd/yyyy"
          data-date-autoclose='true'
          data-date-start-view='decade'
          data-date="01-01-1990"

          />
        </div>
      </div>
      <div class='form-group'>
        <label class='control-label col-sm-6' for='phone'>Phone Number</label>
        <div class='col-sm-6'>
          <input class="form-control" type="text" id="phone" name="phone"/>
        </div>
      </div>
      <div class='form-group'>
        <label class='control-label col-sm-6' for='email'>Email</label>
        <div class='col-sm-6'>
          <input class="form-control validate-email" type="email" id="email"
          data-bv-emailaddress-message="This is not a valid email address"
          data-bv-notempty="true"
          data-bv-notempty-message="This field is required and cannot be empty"
          name="email"/>
        </div>
      </div>
      <div class='form-group'>
        <label class='control-label col-sm-6' for='address'>Street Address</label>
        <div class='col-sm-6'>
          <input class="form-control " type="text" id="address" name="address"/>
        </div>
      </div>
      <div class='form-group'>
        <label class='control-label col-sm-6' for='city'>City</label>
        <div class='col-sm-6'>
          <input class="form-control " type="text" id="city" name="city"/>
        </div>
      </div>
      <div class='form-group'>
        <label class='control-label col-sm-6' for='state'>State</label>
        <div class='col-sm-6'>
          <input class="form-control " type="text" id="state" name="state"/>
        </div>
      </div>
      <div class='form-group'>
        <label class='control-label col-sm-6' for='zip'>Zip</label>
        <div class='col-sm-6'>
          <input class="form-control " type="text" id="zip" name="zip"/>
        </div>
      </div>
      <h2 class='row'>Arrest Information</h2>
      <div class='form-group'>
        <label class='control-label col-sm-6' for='arrest_date'>Arrest Date</label>
        <div class='col-sm-6'>
          <input autocomplete="off" type="text" id="arrest_date" name="arrest_date" class="form-control validate-date datepicker"
          data-bv-notempty="true"
          data-bv-notempty-message="This field is required and cannot be empty"
          data-bv-date="true"
          data-data-date-format="mm/dd/yyyy"
          data-bv-date-message="This is not a valid date"
          data-provide="datepicker"
          data-date-autoclose='true'
          />
        </div>
      </div>
      <div class='form-group'>
        <label class='control-label col-sm-6' for='arrest_time'>Arrest Time</label>
        <div class='col-sm-6'>
          <input class="form-control validate-time" type="text" id="arrest_time" name="arrest_time"
          data-bv-notempty="true"
          data-bv-notempty-message="This field is required and cannot be empty"/>
        </div>
      </div>
      <div class='form-group'>
        <label class='control-label col-sm-6' for='arrest_city'>Arrest City</label>
        <div class='col-sm-6'>
          <select class="form-control"
          data-bv-notempty="true"
          data-bv-notempty-message="This field is required and cannot be empty"
          id="arrest_city" name="arrest_city">
            <option selected='selected'></option>
            <option>Oakland</option>
            <option>San Francisco</option>
            <option>Berkeley</option>
            <option>Emeryville</option>
          </select>
        </div>
      </div>
      <div class='form-group'>
        <label class='control-label col-sm-6' for='arrest_location'>Arrest Location</label>
        <div class='col-sm-6'>
          <input class='form-control' autocomplete="off"  type="text" id="arrest_location" name="arrest_location"/>
        </div>
      </div>
      <div class='form-group'>
        <label class='control-label col-sm-6' for='charges'>Charges</label>
        <div class='col-sm-6'>
          <textarea class="form-control"
          data-bv-notempty="true"
          data-bv-notempty-message="This field is required and cannot be empty"
          id="charges" name="charges"></textarea>
        </div>
      </div>
      <div class='form-group'>
        <label class='control-label col-sm-6'>Felony Charges?</label>
        <div class='col-sm-6'>
          <label class='radio-inline' for='feloniesyes'><input type='radio' id="feloniesyes" name="felonies" value='Yes'/> Yes</label>
          <label class='radio-inline' for='feloniesno'><input type='radio' id="feloniesno" name="felonies" checked="true" value='No'/> No</label>
        </div>
      </div>
      <div class='form-group'>
        <label class='control-label col-sm-6' for='prn'>Incident ID/Police Report Number</label>
        <div class='col-sm-6'>
          <input class="form-control " type="text" id="prn" name="prn"/>
        </div>
      </div>
      <div class='form-group'>
        <label class='control-label col-sm-6' for='docket'>Docket/Citation/CEN Number</label>
        <div class='col-sm-6'>
          <input class="form-control " type="text" id="docket" name="docket"/>
        </div>
      </div>
      <div class='form-group'>
        <label class='control-label col-sm-6' for='court_date'>Next Court Date</label>
        <div class='col-sm-6'>
          <input autocomplete="off"  type="text" id="court_date" name="court_date" class="form-control validate-date datepicker"
          data-bv-notempty="true"
          data-bv-notempty-message="This field is required and cannot be empty"
          data-bv-date="true"
          data-data-date-format="mm/dd/yyyy"
          data-bv-date-message="This is not a valid date"
          data-provide="datepicker"
          data-date-autoclose='true'
          />
        </div>
      </div>
      <div class='form-group'>
        <label class='control-label col-sm-6' for='courttime'>Next Court Date Time and Location (Department)</label>
        <div class='col-sm-6'>
          <input class="form-control " type="text" id="courttime" name="courttime"/>
        </div>
      </div>
      <div class='form-group'>
        <label class='control-label col-sm-6' for='abuse'>Jail Conditions/Police Misconduct<!--  <br/>(You can also fill out a <a href='policemisconductreport.pdf'>police misconduct report</a>) --></label>
        <div class='col-sm-6'>
          <textarea class='form-control' id="abuse" name="abuse" rows="4"></textarea>
        </div>
      </div>
      <div class='form-group'>
        <label class='control-label col-sm-6' for='notes'>Other Info</label>
        <div class='col-sm-6'>
        <textarea class='form-control' id="notes" name="notes" rows="4"></textarea>
        </div>
      </div>
      <p>Please note that filling out this form does not guarantee that we will find you a lawyer. 
        We are doing our best to help folks, but ultimately you are responsible for following up and tracking your own case.
        The purpose of this form is primarily to collect contact information so that we can communicate with arrestees, as well as to identify what cases we can help facilitate mass defense strategies for. </p>
		<p>Sorry - one more disclaimer! This form is being used to make the collection of info for 100s of arrestees easier, but we may not see what you submit individually. <b>If you have a specific question or concern, <a href='mailto:fistsuplegal@riseup.net'>email us</a> or call the hotline: 415-285-1011</b></p>
       <div class='col-sm-6'>
        <input name='submit-button' class='btn btn-primary btn-lg' type='submit' value='Send Intake Form'/>
      </div>
    </form>

  </div>

</article>
<script>
$(document).ready(function() {
    $('#intake').on('init.field.bv', function(e, data) {
      // data.bv      --> The BootstrapValidator instance
      // data.field   --> The field name
      // data.element --> The field element

      var $parent    = data.element.parents('.form-group'),
        $icon      = $parent.find('.form-control-feedback[data-bv-icon-for="' + data.field + '"]'),
        options    = data.bv.getOptions(),                      // Entire options
        validators = data.bv.getOptions(data.field).validators; // The field validators

      if (validators.notEmpty && options.feedbackIcons && options.feedbackIcons.required) {
        // The field uses notEmpty validator
        // Add required icon
        $icon.addClass(options.feedbackIcons.required).show();
      }
    })
    $('#intake').bootstrapValidator({
      feedbackIcons: {
          required: 'glyphicon glyphicon-asterisk text-info',
      },
    });
    $('.datepicker').on('changeDate', function(e) {
      // Revalidate the date field
      $('#intake').bootstrapValidator('revalidateField', $(e.target));
    });
    $('#dob').on('click', function() {
      if ($('#dob').val() == '') {
        $('#dob').datepicker('setDate', '01-01-1989');
      }
    })
});
</script>

<?php 
readfile("footer.ssi");
?>
