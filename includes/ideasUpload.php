<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/core/init.php';
$db = DB::getInstance();
$user = new User();

if($user->isLoggedIn()) {
    if (!empty($_POST['name']) && isset($_POST['name'])
        && !empty($_POST['idea']) && isset($_POST['idea'])
    ) {
        $name = trim($_POST['name']);
        $text = trim($_POST['idea']);
        $db->insert('ideas',array(
            'user_id' => $user->data()->id,
            'name' => $name,
            'text' => $text,
            'date' => date("Y-m-d H:i:s")));
        echo "<h3>Bedankt voor het insturen van je idee</h3><p>We stellen het erg op prijs dat je de tijd hebt genomen om je idee in te sturen.</p><p>Alle ingezonden ideeën zullen bij de desbetreffende commissie terecht komen,</p><p>zij zullen vervolgens de haalbaarheid beoordelen.</p><br>";
        $to = "martijn13795@hotmail.com"; // Dit email adres ontvangt het (stuur naar meerdere emails door e met een komma te schijden)
        $from = "website@ekc2000.nl"; // dit is de email die het verstuurd (kan nep zijn)
        $subject = "Er is een nieuw idee op de site geplaatst";
        $subject2 = "*Kopie* Er is een nieuw idee op de site geplaatst";
        $message = '
            <!DOCTYPE html>
            <html>
            <head>
                <title>EKC 2000</title>
            </head>
            <body style="margin: 0px;">
            <table width="100%" border="0" margin="0px" align="center" cellspacing="0" cellpadding="0" style="text-align: center; border-collapse: collapse;">
                <tbody style="margin: 0px;">
                    <tr>
                        <td align="center" style="background-color: #f1f1f1;">
                            <div style="width: 400px;">
                                <a href="http://www.ekc2000.nl"><img src="http://www.ekc2000.nl/images/logo.png" title="EKC 2000 logo" alt="EKC 2000 logo" href="www.ekc2000.nl" style="max-width: 300px; padding: 15px 15px 15px 0px; margin-left: -30px;"></a>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td align="center">
                            <div style="width: 400px; text-align: left;"><br>
                                <h1 style="font-family: arial, helvetica, sans-serif; line-height: 28px; font-size: 24px;" data-mce-style="font-family: arial, helvetica, sans-serif; line-height: 28px; font-size: 24px;">Hallo,</h1>
                                <p style="font-size: 16px;">
                                    Er is een nieuw idee aangemaakt.<br><br>
                                    <h3>'. $name .'</h3>
                                    <p>'. $text .'</p><br>
                                    Bekijk direct het idee op <a href="http://www.ekc2000.nl/ideeenbus">ekc2000.nl</a>.
                                </p><br>
                                <p style="font-size: 18px; font-family: arial, helvetica, sans-serif; line-height: 19px;" data-mce-style="font-size: 16px; font-family: arial, helvetica, sans-serif;">Met vriendelijke groet,<br>EKC 2000</p>
                            </div><br><br>
                        </td>
                    </tr>
                    <tr>
                        <td align="center" style="background-color: #545454;">
                            <div style="width: 400px;">
                                <div style="margin-top: 15px;">
                                    <a href="https://facebook.com/EKC2000"><img alt="Facebook" title="Facebook" width="32" src="https://pre-bee-resources.s3.amazonaws.com/public/resources/social-networks-icon-sets/circle-color/facebook.png"></a>
                                    <a href="https://twitter.com/EKC2000_Emmen"><img alt="Twitter" title="Twitter" width="32" src="https://pre-bee-resources.s3.amazonaws.com/public/resources/social-networks-icon-sets/circle-color/twitter.png"></a>
                                    <a href="https://nl.linkedin.com/in/martijnposthumainf"><img alt="LinkedIn" title="LinkedIn" width="32" src="https://pre-bee-resources.s3.amazonaws.com/public/resources/social-networks-icon-sets/circle-color/linkedin.png"></a>
                                </div>
                                <div style="color: #BBB;">
                                    <p style="margin-bottom: 10px; margin-top: 5px;"><a href="http://www.ekc2000.nl" style="text-decoration:none; color: #BBB;">&copy; EKC 2000</a></p>
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
            </body>
            </html>';

        $message2 = "*Kopie* " . $message;

        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= "From:" . $from . "\r\n";

        $headers2 = "MIME-Version: 1.0" . "\r\n";
        $headers2 .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers2 .= "From:" . $to . "\r\n";
        mail($to,$subject,$message,$headers);
        mail($from,$subject2,$message2,$headers2); // stuurd een kopie naar de verstuurder
    } else {
        echo "<h3>Er is wat mis gegaan. Probeer het opnieuw.</h3><br>";
    }
}