---
layout: page
title: Contact Us
image: sample-image-6.jpg
use_session: true
---
<?php
function send_email(){
	$email_to = "contact@TassTel.com";
	$email_subject = "Contact form submission";
	
	// validation expected data exists
	if (
		!isset($_POST['name']) || 
		!isset($_POST['email']) || 
		!isset($_POST['reason']) || 
		!isset($_POST['message'])
	) {
		throw new Exception('There appears to be a problem with the form you submitted. Sorry for the inconvenience.');
	}
		 
	$name = $_POST['name']; // required
	$email_from = $_POST['email']; // required
	$reason = $_POST['reason'];
	$message = $_POST['message']; // required
	 
	// if(!preg_match('/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/', $email_from)) {
		
	// }
	if (!filter_var($email_from, FILTER_VALIDATE_EMAIL)) {// invalid email address
		throw new Exception('The Email Address you entered does not appear to be valid.');
	}
	if(!preg_match("/^[A-Za-z .'-]+$/", $name)) {
		throw new Exception('The Name you entered does not appear to be valid: ' . $name );
	}
	if(strlen($message) < 2) {
		throw new Exception('You must enter a message.');
	}
	 
	// function clean_string($string) {
	// 	$bad = array("content-type","bcc:","to:","cc:","href");
	// 	return str_replace($bad,"",$string);
	// }

	if (!isset($_POST['secret']) || $_POST['secret'] != $_SESSION['secret']) {
		throw new Exception('There was a problem with the form\'s security feature. Please try again.');
	}

	$email_message = "Name: $name\n";
	$email_message .= "Email: $email_from\n";
	$email_message .= "Reason: $reason\n";
	$email_message .= "Message:\n$message";
		 
	// create email headers
	$headers = 
		"From: $email_from\r\n"
	. "Reply-To: $email_from\r\n"
	. "X-Mailer: PHP/" . phpversion();

	@mail($email_to, $email_subject, $email_message, $headers);
}
if(isset($_POST['email'])) {
	try{
		send_email();
		echo 'Thanks for sending us feedback. We will get back to you as soon as possible.';
	}catch (Exception $e){
		echo
			"We are very sorry, but there were error(s) found with the form you submitted. <br>"
		. $e->getMessage() . "<br /><br />"
		. "Please go back and fix these errors.<br /><br />";
	}
}else{
?>
<p>
	<strong>TASS Tel</strong><br>
	137 W Puainako st<br>
	Hilo, HI 96720, USA<br>
	contact@TassTel.com<br>
	ZinatUSA@gmail.com<br>
</p>
<br>
<form method="post">
	<fieldset>
		<legend>Contact Form</legend>
		<label for="name">Name:</label>
		<input type="text" name="name">

		<label for="email">Email:</label>
		<input type="text" name="email">

		<label for="reason">Reason:</label>
		<select name="reason">
			<option>Quote/Rate</option>
			<option>Support</option>
			<option>Other</option>
		</select>

		<label for="message">Message:</label>
		<textarea name="message"></textarea>

		<?php
			$value1 = rand(0, 12);
			$value2 = rand(0, 12);
			$_SESSION['secret'] = $value1 + $value2;
		?>

		<label for="secret">
			Security Question: <br>
			What is <b><?= $value1 ?></b>+<b><?= $value2 ?></b>?
		</label>
		<input type="text" name="secret">

		<button type="submit">Send</button>
	</fieldset>
</form>
<?php
}//end of if statement
?>