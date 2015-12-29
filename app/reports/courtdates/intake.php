<?php 
/*if($_SERVER["HTTPS"] != "on") {
    header("Location: https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]);
	exit();
}*/
readfile("header.ssi");
$response = "";
if (isset($_REQUEST['submit'])) { 
	$error = "";
	try {
		$lockfile = '/home/dameat/data/info.txt.lock';
		$values = $_REQUEST;
		while( file_exists($lockfile) ) { usleep(10000); }
		touch($lockfile);
		$file = fopen('/home/dameat/data/info.txt', 'a');
		unset($values['submit']);
		array_unshift($values, date('c'));
		fputcsv($file, $values);
		fclose($file);
		unlink($lockfile);

		
	}catch (Exception $e) {
		$error = $e->getMessage();
	}
	if ($error == "") {
		$response = "<div id='response' class='alert alert-success'>Thank you for sending us your info!</div>";
	} else {
		$response = "<div id='error' class='alert alert-danger'>An error occured while processing your form. Please try again.</div>";
	}
}	
?> 
		<script type="text/javascript" src="js/protoplasm_src.js"></script>
	<script src="js/validation.js" type="text/javascript"></script>
<script type="text/javascript">
		Protoplasm.use('datepicker').transform('input.datepicker');
		Protoplasm.use('timepicker').transform('input.timepicker');
		Event.observe(window, 'load', function() { 
			valid = new Validation('intake'); 
		});
</script>
<style>
.question { padding: 10px 0px; }
.question label {
	display: inline-block;
	width: 174px;
}
input[type="text"], textarea {
	width: 300px;
}
textarea { 
	height: 100px;
}
.required { color: #000; }

#response { background-color: #ddd; } 
#error { background-color: #Ffbbbb; }

.intake input.validation-failed, .intake textarea.validation-failed {
	border: 1px solid #FF3300;
	color : #FF3300;
}
input.validation-passed, textarea.validation-passed {
	border: 1px solid #00CC00;
	color : #000;
}

.validation-advice {
	padding: 5px;
	background-color: #FF3333;
	color : #FFF;
	font-weight: bold;
	margin: 5px 0px 5px 174px;
}
</style>


<article id="post-4" class="post-4 page type-page status-publish hentry">
	<header class="entry-header"><h1 class="entry-title">Arrestee Intake Form</h1></header><!-- .entry-header -->
	<div class="entry-content">

<p>We will only use this information to track people's cases, distribute information, and facilitate legal defense. This information will not be shared or released.</p>
<p><i>Note - if you were arrested multiple times, please fill out this form once for each arrest</i></p>
<?php print $response; ?>
<form class='intake' id='intake' method='post'>
<h3>Personal Information</h3>
<div class='question'><label for='first_name'>First Name</label><input class="required" type="text" name="first_name"></input></div>
<div class='question'><label for='last_name'>Last Name</label><input class="required" type="text" name="last_name"></input></div>
<div class='question'><label for='dob'>Date of Birth</label><input autocomplete="off"  type="text" name="dob" class="required validate-date datepicker" /></div>
<div class='question'><label for='phone'>Phone Number</label><input class="" type="text" name="phone"></input></div>
<div class='question'><label for='email'>Email</label><input class="validate-email" type="text" name="email"></input></div>
<div class='question'><label for='address'>Street Address</label><input class="" type="text" name="address"></input></div>
<div class='question'><label for='city'>City</label><input class="" type="text" name="city"></input></div>
<div class='question'><label for='state'>State</label><input class="" type="text" name="state"></input></div>
<div class='question'><label for='zip'>Zip</label><input class="" type="text" name="zip"></input></div>
<h3>Arrest Information</h3>
<div class='question'><label for='arrest_date'>Arrest Date</label><input autocomplete="off"  type="text" name="arrest_date" class="required validate-date datepicker" /></div>
<div class='question'><label for='arrest_time'>Arrest Time</label><input class="required validate-time" type="text" name="arrest_time"></input></div>
<div class='question'><label for='arrest_city'>Arrest City</label><select class="required" name="arrest_city">
<option selected='selected'></option>
<option>Oakland</option>
<option>San Francisco</option>
<option>Berkeley</option>
</select></div>
<div class='question'><label for='arrest_location'>Arrest Location</label><input autocomplete="off"  type="text" name="arrest_location" class="" /></div>
<div class='question'><label for='charges'>Charges</label><textarea autocomplete="off" class="required" name="charges"></textarea></div>
<div class='question'><label for='felonies'>Felony Charges?</label><input autocomplete="off"  type='radio' name="felonies" value='Yes'/>Yes <input autocomplete="off"  type='radio' name="cops" value='No'/>No</div>
<div class='question'><label for='prn'>Incident ID/Police Report Number</label><input class="" type="text" name="prn"></input></div>
<div class='question'><label for='docket'>Docket/Citation/CEN Number</label><input class="" type="text" name="docket"></input></div>
<div class='question'><label for='court_date'>Next Court Date</label><input autocomplete="off"  type="text" name="court_date" class="required validate-date datepicker" /></div>
<div class='question'><label for='courttime'>Next Court Date Time and Location (Department)</label><input class="" type="text" name="courttime"></input></div>
<div class='question'><label for='abuse'>Jail Conditions/Police Misconduct <br/>(You can also fill out a <a href='http://occupylegal.info/evidence.html'>police misconduct report</a>)</label><textarea autocomplete="off" name="abuse"></textarea></div>
<div class='question'><label for='notes'>Other Info</label><textarea autocomplete="off" name="notes"></textarea></div>
<p>Please note that filling out this form does not guarantee that we will find you a lawyer. We are doing our best to help folks, but ultimately you are responsible for following up and tracking your ownm case. The purpose of this form is primarily to collect contact information so that we can communicate with arrestees, as well as to identify what cases we can help facilitate mass defense strategies for.
</p>
<input name='submit' type='submit' value='Send Intake Form'/>
</form>
</div>
</article>
/0readfile("footer.ssi");

?>

