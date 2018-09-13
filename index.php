
<?php
if(isset($_POST['submit'])) 
{

$message=
'Full Name:	'.$_POST['fullname'].'<br />
Subject:	'.$_POST['subject'].'<br />
Phone:	'.$_POST['phone'].'<br />
Email:	'.$_POST['emailid'].'<br />
Comments:	'.$_POST['comments'].'
';
    require "PHPMailer-master/class.phpmailer.php"; //include phpmailer class
    date_default_timezone_set('Etc/UTC');
    // Instantiate Class  
    $mail = new PHPMailer;

    //Usernames and Passwords  
    $musername = $_POST['musername'];
    $mpassword = $_POST['mpassword'];
    $memail = $_POST['emailid'];

    // Set up SMTP  
    $mail->IsSMTP();                // Sets up a SMTP connection  
    $mail->SMTPAuth = true;         // Connection with the SMTP does require authorization    
    $mail->SMTPSecure = "tls";      // Connect using a TLS connection  
    $mail->Host = "server.address.com";  //Gmail SMTP server address
    $mail->Port = 587;  //Gmail SMTP port
    $mail->SMTPOptions = array('ssl' => array('verify_peer' => false, 'verify_peer_name' => false, 'allow_self_signed' => true)); // Settings
    //$mail->Encoding = '7bit';
    $mail->SMTPDebug = 4;
	  //Ask for HTML-friendly debug output
	  $mail->Debugoutput = 'html';
    
    // Authentication  
    $mail->Username   = $musername; // Your full Gmail address
    $mail->Password   = $mpassword; // Your Gmail password
      
    // Compose
    $mail->SetFrom($emailid, $_POST['fullname']);
    $mail->AddReplyTo($_POST['emailid'], $_POST['fullname']);
    $mail->Subject = "New Contact Form Enquiry";      // Subject (which isn't required)  
    $mail->msgHTML($message);
   
    
 
    // Send To  
    $mail->AddAddress("emailaddress@emailclient.com", "Name Here"); // Where to send it - Recipient
    $result = $mail->Send();		// Send!  
	  $message = $result ? '<div class="alert alert-success" role="alert"><strong>Success! </strong>Message Sent Successfully!</div>' : '<div class="alert alert-danger" role="alert"><strong>Error!</strong>There was a problem delivering the message.</div>';  

  unset($mail);
}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PHPMailer Contact Form</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
  	<div class="contactform">
  	<div class="panel panel-default">
  		<div class="panel-heading">
    	<h3 class="panel-title"><a href="">Contact Form</a></h3>
    	</div>
    	<div class="panel-body">
    	<form name="form1" id="form1" action="" method="post">
    			<fieldset>
    			  <input type="text" class="form-control" name="fullname" placeholder="Full Name" />
    			  <br />
    			  <input type="text" class="form-control" name="subject" placeholder="Subject" />
    			  <br />
    			  <input type="text" class="form-control" name="phone" placeholder="Phone" />
    			  <br />
    			  <input type="email" class="form-control" name="emailid" placeholder="Email" />
    			  <br />
            <input type="text" class="form-control" name="musername" placeholder="Acct Username" />
            <br/>
            <input type="password" class="form-control" name="mpassword" placeholder="Acct Password" />
            <br/>
    			  <textarea rows="4" class="form-control" cols="20" name="comments" placeholder="Comments"></textarea>
    			  <br />
    			  <input type="submit" class="btn btn-success"name="submit" value="Send Message" />
    			</fieldset>
    	</form>
    	<p><?php if(!empty($message)) echo $message; ?></p>
    	</div>
	</div>
	</div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
