<?php

    namespace Controllers;

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    class Email
    {   
        private $sender_email, $email_password, $sender_name; 
        function __construct($sender_name ,$sender_email, $email_password) {
            $this->sender_name = $sender_name;
            $this->sender_email = $sender_email;
            $this->email_password = $email_password;
        }

        public function send($send_email_to, $send_to_name, $subject, $html_content) 
        {  
            $email = new PHPMailer(true); 
            try {
                $email->Username = $this->sender_email;                   //SMTP username
                $email->Password = $this->email_password;                 //SMTP password
                $email->Host = 'smtp.office365.com';                      //Set the SMTP server to send through
                $email->Port = 587;                                       //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
                $email->SMTPAuth = true;                                  //Enable SMTP authentication
                $email->isSMTP();                                         //Send using SMTP
                //$email->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;       //Enable implicit TLS encryption
                //$email->SMTPDebug = SMTP::DEBUG_SERVER;                 //Enable verbose debug output
                
                $email->setFrom($this->sender_email, $this->sender_name); 
                $email->addAddress($send_email_to, $send_to_name);    //Add a recipient
                //$email->addAddress('ellen@example.com');
                //$email->addReplyTo('info@example.com', 'Information');
                //$email->addCC('cc@example.com');
                //$email->addBCC('bcc@example.com');
            
                //Attachments
                //$email->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
                //$email->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name
            
                //Content
                $email->isHTML(true);                                  //Set email format to HTML
                $email->Subject = $subject;
                $email->Body = $html_content;            
                $email->send();
                return 'success';
            } catch (Exception $e) {
                return "Error: {$email->ErrorInfo}";
            }
        }

        
    }