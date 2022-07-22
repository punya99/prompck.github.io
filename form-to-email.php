<?php
if(!isset($_POST['submit']))
{
echo "error; you need to submit the form!";
}
$name = $_POST['name'];
$visitor_email = $_POST['email'];
$contact = $_POST['phone'];
$message = $_POST['message'];

if(empty($name)||empty($visitor_email) ||empty($contact) ||empty($message)) 
{
echo "Name and email are mandatory!";
exit;
}
if(IsInjected($visitor_email))
{
echo "Bad email value!";
exit;
}
$email_from = 'kadiyan.tanu@gmail.com';
//<== update the email address
$email_subject = "webadsindia Enquiry  For  PROMPACK SOLUTION";
$email_body = "User Name: " .$name."\n".   
			  "Email: " .$visitor_email."\n" .
			  "Contact: " .$contact."\n" .
			  "Message: " .$message."\n";
    
$to = "sales@prompacksolutions.com";
//<== update the email address
$headers = "From: $email_from \r\n";
$headers .= "Reply-To: $visitor_email \r\n";
//Send the email!
mail($to,$email_subject,$email_body,$headers);
//done. redirect to thank-you page.
header('Location:thank-you.html');


// Function to validate against any email injection attempts
function IsInjected($str)
{
  $injections = array('(\n+)',
              '(\r+)',
              '(\t+)',
              '(%0A+)',
              '(%0D+)',
              '(%08+)',
              '(%09+)'
              );
  $inject = join('|', $injections);
  $inject = "/$inject/i";
  if(preg_match($inject,$str))
    {
    return true;
  }
  else
    {
    return false;
  }
}
   
?> 