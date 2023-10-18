<?php
session_start();
date_default_timezone_set('America/Toronto');
$date = new DateTime();
$TimeDate = $date->format('Y-m-d H:i:s');
 require '../database_SS.php';

    $id=$_POST['id'];
    $password=password_hash($_POST['password'], PASSWORD_DEFAULT);
    $email=$_POST['email'];

    $url=explode("?message", $_SERVER['HTTP_REFERER'])[0];
    $url_error=$url."?message=2";
    $url_success=$url."?message=1";


    $sql = "UPDATE `users` SET `password` = '".$password."', `FirstTime` = '1' WHERE `id` LIKE '".$id."'";
    $stmt = $conn->prepare($sql);
    //Creating New Event
    if( $stmt->execute() ){


            $emailto = $email;
            $replyto= 'support@regid.ca';
            $toname = 'User RegID';
            $emailfrom = 'do-no-reply@regeneratedidentities.org';
            $fromname = 'Regenerated Identities - System Email';
            $subject = '[Regenerated Identities] Changes to Your Account';
            $messagebody = '
            <center style="width: 100%; background-color: white; font: black;">
                <div class="email-container" style="max-width: 600px; margin: 0 auto;">
                    <img style="width: 250px; max-width: 600px; height: auto; margin: auto; display: block;" src="http://regeneratedidentities.org/images/regid_logo.png">
                    <hr style="color : black">
              <div style="text-align: justify; margin: auto;" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" align="center">

                            <div style="padding: 1em 2.5em 0 2.5em; text-align: center;" class="bg_white" valign="top">
                              <h1>Your account password was updated!</h1>
                                <p style=""><br></p><div style="text-align: left;"><span style="font-size: 14px;">

                                Your new password is case-sensitive. Please keep your password confidential.
                                <br><br>
                                Project Name: US Anti-Slavery Laws Archive<br>
                                Project Code: WB<br>
                                <br>
                                If you have not made these changes, please contact us immediately at support@regid.ca
                                <br><br>
                                Best Regards, <br>
                                Technical Team<br>
                                Regenerated Identitites | WWW<br>
                                <br><br>
                                </span></div></p>
                            </div>

                        <hr style="color : black">
                                <div style="text-align: left; padding: 1em 2.5em 0 2.5em; font-size: 1rem;" class="bg_light">
                                  <p style="color: black;">
                                  <span style="font-size: 11px;">You are receiving this e-mail because you have access to one or more projects on the Regenerated Identities network. To unsubscribe emails sent from our team, please email at </span><span style="color: rgb(0, 123, 255); font-size: 10px;"><a style="color: rgb(0, 123, 255);" href="mailto:admin@regid.ca" rel="noopener noreferrer" target="_blank"><span style="font-size: 11px;">admin@regid.ca</span></a><span style="font-size: 11px;">&nbsp;</span></span><span style="font-size: 11px;">with "Unsubscribe" in the subject line.&nbsp;</span><br><span style="font-size: 11px;">Incoming messages to this email account will be blocked and you may never receive a reply! For any questions or concerns please submit a </span><a style="color: rgb(0, 123, 255);" href="tickets.regeneratedidentities.org" rel="noopener noreferrer" target="_blank"><span style="font-size: 11px;">RegID ticket.</span></a><br>
                                  </p>
                                </div>
                        <br>
                        <p style="color: black;  text-align: center;">----------------------------------------------</p>
                          <div style="text-align: left; padding: 1em 2.5em 0 2.5em; font-size: 1rem;" class="bg_light">
                                  <p style="color: black;">
                                    <span style="font-size: 11px;">CONFIDENTIALITY NOTICE: This e-mail message, including any attachments, is for the sole use of the intended recipient(s) and may contain confidential and privileged information. Any unauthorized review, use, disclosure, or distribution is prohibited. If you are not the intended recipient, please contact the sender by reply e-mail and destroy all copies of the original message.
            </span><br><span style="font-size: 11px;">
                                    AVIS DE CONFIDENTIALITÉ : Ce message électronique, ainsi que tout fichier qui y est joint, est reserve à l\'usage exclusif du destinatairevisé et peut contenir des renseignements confidentiels et privilégiés. Toute lecture, utilisation, divulgation ou distribution non autorisée estinterdite. Si vous n\'êtes pas le destinataire visé, veuillez en aviser l\'expéditeur par retour de courriel et détruire toutes les copies du message original.</span>
                                  </p>
                            </div>
                        <p style="color: black; text-align: center;">----------------------------------------------</p>
                      </div>
                      <a href="https://walkwithweb.org" rel="noopener noreferrer" target="_blank"><img style="width: 200px; max-width: 600px; height: auto; margin: auto; display: block;" src="http://regeneratedidentities.org/images/logo-black.png"></a>
                      <a href="https://walkwithweb.org" rel="noopener noreferrer" target="_blank"><b style="color: rgb(0, 123, 255);"><span style="font-size: 16px;">www.walkwithweb.org</span></b></a>
                      <hr style="color : black">
              </div>
             </center>

            ';
            $headers =
            	'Return-Path: ' . $emailfrom . "\r\n" .
            	'From: ' . $fromname . ' <' . $emailfrom . '>' . "\r\n" .
            	'X-Priority: 1' . "\r\n" .
            	'X-Mailer: PHP ' . phpversion() .  "\r\n" .
            	'Reply-To: RegID Support <' . $replyto . '>' . "\r\n" .
            	'MIME-Version: 1.0' . "\r\n" .
            	'Content-Transfer-Encoding: 8bit' . "\r\n" .
            	'Content-Type: text/html; charset=UTF-8' . "\r\n";
            $params = '-f ' . $emailfrom;
            $test = mail($emailto, $subject, $messagebody, $headers, $params);
            // $test should be TRUE if the mail function is called correctly



       header( 'location: '.$url_success);
      }
      else{
    header( 'location: '.$url_error);
      }



?>
