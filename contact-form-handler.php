<?php 

$errors = '';
$myemail = 'kmutiso@vasights.com,djuma@vasights.com,info@vasights.com';//<-----Put Your email address here.
if(empty($_POST['fname'])  || 
   empty($_POST['lname'])  || 
   empty($_POST['email']) || 
   empty($_POST['telephone']) ||
   empty($_POST['message']))
{
    $errors .= "\n Error: all fields are required";
}

//file upload
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["docs"]["name"]);
$uploadOk = 1;

if (move_uploaded_file($_FILES["docs"]["tmp_name"], $target_file)) {
    echo "The file ". htmlspecialchars( basename( $_FILES["docs"]["name"])). " has been uploaded.";
  } else {
    echo "Sorry, there was an error uploading your file.";
  }

  var_dump($target_file);

$fname = $_POST['fname']; 
$lname = $_POST['lname']; 
$docs= $target_file;
$docsTitle =$_POST['docs-title'];
$area = $_POST['area'];
$email_address = $_POST['email'];
$telephone = $_POST['telephone'];
$message = $_POST['message']; 

if (!preg_match(
"/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/i", 
$email_address))
{
    $errors .= "\n Error: Invalid email address";
}

  

if( empty($errors))
{
	$to = $myemail; 
	$email_subject = "Consultancy Form Submission: $fname $lname";
	$body .= "You have received a new  Request. ".
	" Here are the details:\n Name: $fname $lname \n Email: $email_address \n Telephone: $telephone \n Message: $message \n Area of Interest: $area \n Docs: $docsTitle: $docs"; 
	
	$headers = "From: $myemail\n"; 
	$headers .= "Reply-To: $email_address";
	
	
	   $sentMail = mail($to,$email_subject,$body,$headers);
	//redirect to the 'thank you' page

	    if($sentMail )  
    { 
       echo "File Sent Successfully."; 
       unlink($name); // delete the file after attachment sent. 
       	header('Location: contact-form-thank-you.html');
    } 
    else
    { 
       die("Sorry but the email could not be sent. 
                    Please go back and try again!"); 
    } 

} 
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd"> 
<html>
<head>
	<title>Contact form handler</title>
</head>

<body>
<!-- This page is displayed only if there is some error -->
<?php
echo nl2br($errors);
?>


</body>
</html>