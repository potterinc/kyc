<?php

/**
 * This controls all the mail function for this project
 * @Booking appointments
 * @contacting customer service
 * @contacting technical support teams
 * @NEWSLETTER
 * https://www.celteckwireless.com
 * 
 * Send the mail to yourself because the sender may use a forged email address
 * Instead, add the sender's mail to the replyPath
 * in whichc case, the entire request should be ignored
 * 
 * */


// PHPMailer configuration and dependencies
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once 'src/PHPMailer.php';
require_once 'src/Exception.php';
require_once 'src/SMTP.php';

//Server settings
$mailer->isSMTP();
$mailer->SMTPAuth = 0;
$mailer->SMTPDebug = false;
$mailer->Host = '';
$mailer->Username = '';
$mailer->Password = '';
$mailer->SMTPSecure = 'ssl';
$mailer->Port = 465;

function kyc()
{
    $mailer = new PHPMailer;


    $mailer->setFrom('info@celteckwireless.com', 'SUBSCRIBER');
    $mailer->addAddress('sales@celteckwireless.com');

    if ($mailer->addReplyTo($_REQUEST['CustomerEmail'], 'no-reply@Newsletter')) {

        $mailer->isHTML(true);
        $mailer->Subject = "NEWSLETTER";
        $mailer->Body = "
        <div>
            <p>Dear Admin, </p>
            It is a great pleasure to notify you, concerning my interest to be receiving more \ 
            Email notification as regarding news updates on your products and services. \
            <p>Also, {$_REQUEST['CustomerNote']}</p>
            I am very pleased with your services and do notify me whenever there is any update.<br> Thank you.
        </div>
            
            <p>Yours sincerely,<br>
                <strong>{$_REQUEST['CustomerFullName']}</strong><br />
                <strong>{$_REQUEST['CustomerTelephone']}</strong><br />
                <strong>{$_REQUEST['CustomerEmail']}</strong><br>
            </p>";

        $mailer->AltBody = "
        Dear Admin,\n
            It is a great pleasure to notify you, concerning my interest to be receiving more \ 
            Email notification as regarding news updates on your products and services. \n\n
            Also, {$_REQUEST['CustomerNote']}\n
            I am very pleased with your services and do notify me whenever there is any update.\n Thank you.\n\n
            Yours sincerely,\n
                {$_REQUEST['CustomerFullName']}\n
                {$_REQUEST['CustomerTelephone']}\n
                {$_REQUEST['CustomerEmail']}\n
                Source: https://your-domain.com\n
        ";

        // processing request
        if ($mailer->send())
            print("<span class='alert alert-success w3-animate-bottom'><i class='fa fa-info-circle'></i> <strong>SENT:</strong> Thank you for subscribing</span>");
        else
            print("<span class='alert alert-danger w3-animate-bottom'><i class='fa fa-times'></i> <strong>FAILED:</strong> Try Again</span>");
    } else
        print("<span class='alert alert-warning w3-animate-bottom'><i class='fa fa-exclamation-triangle'></i> <strong>ERROR:</strong> Invalid Email, Try Again</span>");
    response_mail();
}

function response_mail(){
    $mailer = new PHPMailer;
    $mailer->setFrom('info@celteckwireless.com', 'SUBSCRIBER');
    $mailer->addAddress('sales@celteckwireless.com');

    $mailer->isHTML(true);
    $mailer->Subject = "NEWSLETTER";

    $mailer->Body = "
    <div>
        THANK YOU for subscribing to our Newsletter. We promise to always inform and update you \
        with the latest information concerning our products and services.
        <p>Yours faithfully,<br>
            For more information concerning our products and services, please \
            contact us @<strong>{$_REQUEST['business-email']}</strong> or Call: {$_REQUEST['business-phone']}<br>
            You can also visit us at:<a href='https://celteckwireless.com'><strong>https://celteckwireless.com</strong</a>
        </p>
    </div>
    ";

    $mailer->AltBody = "
    THANK YOU for subscribing to our Newsletter. We promise to always inform and update you \
        with the latest information concerning our products and services.\n\n
        Yours faithfully,\n
            For more information concerning our products and services, please \
            contact us @<strong>{$_REQUEST['business-email']}</strong> or Call: {$_REQUEST['business-phone']}\n
            You can also visit us at:https://celteckwireless.com";

    $mailer->send();

}
