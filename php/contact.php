<?php
    require_once 'php/vendor/autoload.php';

    try{
        if(isset($_POST["message"]))
        {
            $name = $_POST["name"];
            $message = $_POST["message"];
            
            // get email and sanitize
            $visitor_email = $_POST["email"];
            $visitor_email = filter_var($visitor_email, FILTER_SANITIZE_EMAIL);

            $email_subject = "New Form Submission";
    
            $to_me = "nathanzadkovsky@yahoo.com";
    
            $email_body = "User Name: $name \n".
                          "User Email: $visitor_email \n".
                          "Message: $message \n";
            
            $headers = "From: $visitor_email \r\n";
            $headers .= "Reply-To: $visitor_email \r\n";

            // check if name is entered
            if(!$_POST["name"]){
               die("ERROR: Please enter your name");
            }

            // check if email was entered and is valid 
            if(!$_POST["email"]){
                die("ERROR: email not entered");
            }

            // check if message body is there
            if(!$_POST["message"]){
                die("ERROR: please enter messsage body");
            }

            // validate the email is valid
            if(!filter_var($visitor_email, FILTER_VALIDATE_EMAIL)) {
                die("ERROR: invalid email. Renter valid email");
            }
    
            // send mail
            $res = mail($sent_to_me, $email_subject, $email_body, $headers);
            
            if($res){
                echo "Form submission sent! I will reach out as soon as possible.";
            }
            else{
                echo "ERROR: Form submission wasn't able to complete. Please email me directly through the link provided in the About me page";
            }
        }
    }
    catch(Exception $e){
        $err = $e->getMessage();
        echo "EXCEPTION: $err";
    }

    # get back to Home tab
    header("Location: index.html");

?>

<!-- 
            #fields from html
            $visitor_email = $_POST["email"];
            $name = $_POST["name"];
            $body = $_POST["message"];
            $sent_to_me = "nathan.zadkovsky@gmail.com";

            #create a smtp connection
            # port 465 sends messages securely
            $transport = ( new Swift_SmtpTransport('smtp.gmail.com', 465))
                        ->setUsername('nathan.zadkovsky@gmail.com')
                        ->setPassword('');
            
            #set  mailer
            $mailer = new Swift_Mailer($transport);

            # create a new message for email
            $message = new Swift_Message();

            $message->setSubject('Message from my webiste!');
            $message->setFrom([$visitor_email => $name]);
            $message->setBody($body);
            $message->setTo([$sent_to_me => 'Me']);

            # send mail/message
            $result = $mailer->send($message);
            echo $result;
-->