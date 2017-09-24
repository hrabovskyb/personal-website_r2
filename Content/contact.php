<html>
<?php
if(isset($_POST['email'])){
	//Variables
	$name = $_POST['name'];
	$email = $_POST['email'];
	$subject = $_POST['subject'];
	$message = $_POST['message'];
	$error_message = "";
	$email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-za-z]{2,4}$/';
	$string_exp = "/^[A-Za-z0-9.'-]+$/";

	//email address to send to
	$email_to="hrabovskybrady@gmail.com";
	$email_subject=$subject;
	$email_from="Website Contact Page";

	//error codes
	function died($error){
		echo "It appears that there were error(s) found with your submission. ";
		echo "Errors shown below.<br/><br/>";
		echo $error."<br/><br/>";
		echo "Please fix these errors before re-submission.<br/>";
		die();
	}

	//Validation of data entries
	if(!isset($_POST['name']) || !isset($_POST['email']) || !isset($_POST['message'])){
		died('Sorry. There appears to be a problem with your submission.');
	}
	if(strlen($name)<2){
		$error_message .= 'The name you have entered is not valid. Please enter a valid name.<br/>';
	}
	if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
		$error_message .='The email address you have entered is not valid.<br/>';
	}
	if(strlen($message)<2){
		$error_message .= 'The message you have entered is not long enough. Please enter more than 2 characters.<br/>';
	}
	if(strlen($error_message)>0){
		died($error_message);
	} else{
		$email_message = "Form details below. \n\n";
	}
	function clean_string($string){
		$bad = array("content-type", "bcc:", "to:", "cc:", "href");
		return str_replace($bad, "",$string);
	}
	$email_message .="Name:" . clean_string($name) ."/n";
	$email_message .="Email:" . clean_string($email) ."/n";
	$email_message .="Subject:" . clean_string($subject) ."/n";
	$email_message .="Message:" . clean_string($message) ."/n";

	//Create headers
	$headers = 'From:' .$email_from ."/r/n". 'Reply-To:' .$email. "/r/n".'X-Mailer: PHP/'.phpversion();
	@mail($email_to,$email_subject,$email_message,$headers);
}
?>
</html>

