<?php
if(!isset($_POST['submit']))
{
	echo "Errore! Devi compilare il form correttamente!";
}

$name = $_POST['name'];
$visitor_email = $_POST['email'];
$message = $_POST['message'];

//Validate first
if(empty($name)||empty($visitor_email)) 
{
    echo "Nome e email sono obbligatori!";
    exit;
}

if(IsInjected($visitor_email))
{
    echo "Email errata!";
    exit;
}

$email_from = 'a.b.spam@email.com';

$email_subject = "Contact form website";

$email_body = "Nuovo messaggio da $name.\n".
    "Messaggio:\n $message".

    
$to = "andrea.beltrami@email.com";

$headers = "From: $email_from \r\n";

$headers .= "Reply-To: $visitor_email \r\n";

mail($to,$email_subject,$email_body,$headers);

header('Location: index.html');


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