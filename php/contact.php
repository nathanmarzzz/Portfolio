<?php
    require_once 'php/vendor/autoload.php';

    try{
        if($_POST["message"])
        {
            #fields from html
            $visitor_email = $_POST["email"];
            $name = $_POST["name"];
            $body = $_POST["message"];
            $sent_to_me = "nathan.zadkovsky@gmail.com";

            #create a smtp connection
            # port 465 sends messages securely
            $transport = ( new Swift_SmtpTransport('smtp.gmail.com', 465))
                        ->setUsername('nathan.zadkovsky@gmail.com')
                        ->setPassword('pbjallday');
            
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
    
        }
    }
    catch(Exception $e){
        echo $e->getMessage();
    }

    # get back to Home tab
    header("Location: index.html");

?>

<!-- 
    $visitor_email = $_POST["email"];
        $name = $_POST["name"];
        $message = $_POST["message"];
        $email_subject = "New Form Submission";

        $sent_to_me = "nathan.zadkovsky@icloud.com";

        $email_body = "User Name: $name \n".
                      "User Email: $visitor_email \n".
                      "Message: $message \n";
        
        $headers = "From: $visitor_email \r\n";
        $headers .= "Reply-To: $visitor_email \r\n";

        #send mail
        mail($sent_to_me, $email_subject, $email_body, $headers);

        header("Location: index.html?mailsend");
-->