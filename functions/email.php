<?php
function email($to, $subject, $title, $text){

    $from = "website@ekc2000.nl";
    $message = '
            <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "https://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
                <html xmlns="https://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
                    <head>
                        <title>EKC 2000</title>
                        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
                        <style type="text/css">
                            body, html {
                                margin: 0;
                                width: 100%;
                                height: 100%;
                                background: #FFFFFF;
                            }
                            iframe {
                                width: 100%;
                                border-top: 1px solid #c6c6c6;
                            }
                            .ie iframe {
                                margin-top: -2px;
                            }

                            .email-client .bar-mid {
                                background: #FFFFFF;
                                position: relative;
                                z-index: 10;
                                -webkit-box-shadow: rgba(0, 0, 0, 0.05) 0px 1px 2px 2px;
                                -moz-box-shadow: rgba(0, 0, 0, 0.05) 0px 1px 2px 2px;
                                box-shadow: rgba(0, 0, 0, 0.05) 0px 1px 2px 2px;
                            }
                            .email-client .bar-mid .details {
                                padding: 20px 0px 20px 0px;
                                min-width: 320px;
                                width: 100%;
                            }
                            .email-client .bar-mid .details .avatar {
                                width: 38px;
                                height: 38px;
                                display: inline-block;
                                float: left;
                                margin-right: 10px;
                                margin-left: 20px;
                            }
                            .email-client .bar-mid .details .text {
                                width: 45%;
                                display: inline-block;
                            }
                            .email-client .bar-mid .details .text p {
                                color: #888888;
                                font-size: 13px;
                                padding-bottom: 2px;
                            }

                            .dynamic-content {
                                width: 220px;
                                display: block;
                                background: #595d65;
                                float: left;
                                padding: 30px;
                                margin: 0px;
                                color: #FFFFFF;
                                overflow: auto;
                                -moz-box-shadow:    inset -4px 0px 9px -6px #000000;
                                -webkit-box-shadow: inset -4px 0px 9px -6px #000000;
                                box-shadow:         inset -4px 0px 9px -6px #000000;

                            }

                            .dynamic-content .title {
                                color: #b8babc;
                                font-size: 18px;
                                font-weight: bold;
                                margin-bottom: 20px;
                            }

                            .dynamic-content .custom-field {
                                font-size: 14px;
                                font-weight: bold;
                                border-bottom: #686b72 solid 1px;
                                padding-bottom: 3px;
                                margin: 25px 0px 10px 0px;
                                display: block;
                                word-break: break-all;
                            }

                            .dynamic-content .new-form .ko-radio, .dynamic-content .new-form .ko-checkbox {
                                position: relative;
                                margin-right: 0;
                            }

                            .dynamic-content label{
                                width: 100%;
                                text-align: left;
                                font-weight: normal;
                                margin-bottom: 5px;
                                float: none;
                                line-height: 16px;
                            }

                            @media only screen
                            and (max-width : 580px) {

                                .email-client .bar-mid .details .text {
                                    width: 75%;
                                }
                            }
                        </style>
                    </head>
                    <body class="full-padding" style="margin: 0;padding: 0;min-width: 100%;background-color: #f5f7fa;">
                        <table style="width: 100%; height: 100%; background-color: #f5f7fa;">
                            <tbody>
                                <tr>
                                    <td>
                                        <center class="wrapper" style="display: table;table-layout: fixed;width: 100%;min-width: 620px;-webkit-text-size-adjust: 100%;-ms-text-size-adjust: 100%;background-color: #f5f7fa;">
                                            <table class="header centered" style="border-collapse: collapse;border-spacing: 0;Margin-left: auto;Margin-right: auto;width: 600px;">
                                                <tbody>
                                                    <tr>
                                                        <td style="padding: 0;vertical-align: top;">
                                                            <table class="preheader" style="border-collapse: collapse;border-spacing: 0;" align="right">
                                                                <tbody>
                                                                    <tr>
                                                                        <td class="emb-logo-padding-box" style="padding: 0;vertical-align: top;padding-bottom: 24px;padding-top: 24px;text-align: right;width: 280px;letter-spacing: 0.01em;line-height: 17px;font-weight: 400;font-size: 11px;">
                                                                            <div class="spacer" style="font-size: 1px;line-height: 2px;width: 100%;">&nbsp;</div>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                            <table style="border-collapse: collapse;border-spacing: 0;" align="left">
                                                                <tbody>
                                                                    <tr>
                                                                        <td class="logo emb-logo-padding-box" style="padding: 0;vertical-align: top;mso-line-height-rule: at-least;width: 280px;padding-top: 24px;padding-bottom: 24px;">
                                                                            <div class="logo-left" style="font-weight: 700;font-family: Avenir,sans-serif;color: #555555;font-size: 0px !important;line-height: 0 !important;" align="left" id="emb-email-header"><a style="text-decoration: none;transition: opacity 0.2s ease-in;color: #555555;" href="https://ekc2000.nl" target="_blank"><img style="border: 0;-ms-interpolation-mode: bicubic;display: block;max-width: 200px;" src="https://ekc2000.nl/images/logo.png" alt="EKC 2000" width="200" height="120"></a></div>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>

                                            <table class="centered" style="border-collapse: collapse;border-spacing: 0;Margin-left: auto;Margin-right: auto;">
                                                <tbody>
                                                    <tr>
                                                        <td class="border" style="padding: 0;vertical-align: top;font-size: 1px;line-height: 1px;background-color: #dddee1;width: 1px;">&nbsp;</td>
                                                            <td style="padding: 0;vertical-align: top;">
                                                            <table class="one-col" style="border-collapse: collapse;border-spacing: 0;Margin-left: auto;Margin-right: auto;width: 600px;background-color: #ffffff;table-layout: fixed;" emb-background-style="">
                                                                <tbody>
                                                                    <tr>
                                                                        <td class="column" style="padding: 0;vertical-align: top;text-align: left;">
                                                                            <div class="column-top" style="font-size: 32px;line-height: 32px;transition-timing-function: cubic-bezier(0, 0, 0.2, 1);transition-duration: 150ms;transition-property: all;">&nbsp;</div>
                                                                            <table class="contents" style="border-collapse: collapse;border-spacing: 0;table-layout: fixed;width: 100%;">
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td class="padded" style="padding: 0;vertical-align: top;padding-left: 32px;padding-right: 32px;word-break: break-word;word-wrap: break-word;">
                                                                                            <h2 style="font-style: normal;font-weight: 700;Margin-bottom: 16px;Margin-top: 0;font-size: 24px;line-height: 32px;font-family: &quot;Open Sans&quot;,sans-serif;color: #44a8c7;"><span style="color:rgb(55, 192, 251)">'. $title .'</span></h2>
                                                                                        </td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>

                                                                            <table class="contents" style="border-collapse: collapse;border-spacing: 0;table-layout: fixed;width: 100%;">
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td class="padded" style="padding: 0;vertical-align: top;padding-left: 32px;padding-right: 32px;word-break: break-word;word-wrap: break-word;">
                                                                                            <div class="divider" style="Margin-bottom: 16px;Margin-top: 0;">
                                                                                                <div class="border" style="font-size: 1px;line-height: 1px;background-color: #dddee1;">&nbsp;</div>
                                                                                            </div>
                                                                                        </td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>

                                                                            <table class="contents" style="border-collapse: collapse;border-spacing: 0;table-layout: fixed;width: 100%;">
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td class="padded" style="padding: 0;vertical-align: top;padding-left: 32px;padding-right: 32px;word-break: break-word;word-wrap: break-word;">
                                                                                            <p style="font-style: normal;font-weight: 400;Margin-bottom: 0;Margin-top: 16px;font-size: 15px;line-height: 24px;font-family: &quot;Open Sans&quot;,sans-serif;color: #60666d;text-align: left;">'. $text .'</p><br>
                                                                                        </td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>

                                                                            <table class="contents" style="border-collapse: collapse;border-spacing: 0;table-layout: fixed;width: 100%;">
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td class="padded" style="padding: 0;vertical-align: top;padding-left: 32px;padding-right: 32px;word-break: break-word;word-wrap: break-word;">
                                                                                            <p class="size-16" style="font-style: normal;font-weight: 400;Margin-bottom: 0;Margin-top: 0;font-size: 16px;line-height: 24px;font-family: &quot;Open Sans&quot;,sans-serif;color: #60666d;">Met vriendelijke groet,<br>EKC 2000</p>
                                                                                        </td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>

                                                                            <div class="column-bottom" style="font-size: 32px;line-height: 32px;transition-timing-function: cubic-bezier(0, 0, 0.2, 1);transition-duration: 150ms;transition-property: all;">&nbsp;</div>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </td>
                                                        <td class="border" style="padding: 0;vertical-align: top;font-size: 1px;line-height: 1px;background-color: #dddee1;width: 1px;">&nbsp;</td>
                                                    </tr>
                                                </tbody>
                                            </table>

                                            <table class="border" style="border-collapse: collapse;border-spacing: 0;font-size: 1px;line-height: 1px;background-color: #dddee1;Margin-left: auto;Margin-right: auto;" width="602">
                                                <tbody>
                                                    <tr>
                                                        <td style="padding: 0;vertical-align: top;">&nbsp;</td>
                                                    </tr>
                                                </tbody>
                                            </table>

                                            <table class="footer centered" style="border-collapse: collapse;border-spacing: 0;Margin-left: auto;Margin-right: auto;width: 100%;">
                                                <tbody>
                                                    <tr>
                                                        <td style="padding: 0;vertical-align: top;">&nbsp;</td>
                                                        <td class="inner" style="padding: 28px 0 29px 0;vertical-align: top;width: 600px;">
                                                            <table class="right" style="border-collapse: collapse;border-spacing: 0;" align="right">
                                                                <tbody><tr>
                                                                    <td style="padding: 0;vertical-align: top;color: #b9b9b9;font-size: 12px;line-height: 22px;max-width: 200px;mso-line-height-rule: at-least;">
                                                                        <div class="sharing">
                                                                            <div class="links emb-web-links" style="line-height: 26px;Margin-bottom: 26px;mso-line-height-rule: at-least;">

                                                                                <a style="transition: opacity 0.2s ease-in;color: #b9b9b9; text-decoration: none;" href="https://facebook.com/EKC2000" target="_blank">
                                                                                    <img style="border: 0;-ms-interpolation-mode: bicubic;vertical-align: middle;" src="https://i8.createsend1.com/static/eb/master/03-fresh/imgf/facebook-sf.png" width="29" height="26">
                                                                                </a>
                                                                                <a style="transition: opacity 0.2s ease-in;color: #b9b9b9; text-decoration: none;" href="https://twitter.com/EKC2000_Emmen" target="_blank">
                                                                                    <img style="border: 0;-ms-interpolation-mode: bicubic;vertical-align: middle;" src="https://i9.createsend1.com/static/eb/master/03-fresh/imgf/twitter-sf.png" width="29" height="26">
                                                                                </a>
                                                                                <a style="transition: opacity 0.2s ease-in;color: #b9b9b9; text-decoration: none;" href="https://nl.linkedin.com/in/martijnposthumainf" target="_blank">
                                                                                    <img style="border: 0;-ms-interpolation-mode:bicubic;vertical-align: middle;" src="https://i2.createsend1.com/static/eb/master/03-fresh/imgf/linkedin-sf.png" width="29" height="26">
                                                                                </a>
                                                                                <a style="transition: opacity 0.2s ease-in;color: #b9b9b9; text-decoration: none;" href="https://nl.linkedin.com/in/casvandinter" target="_blank">
                                                                                    <img style="border: 0;-ms-interpolation-mode:bicubic;vertical-align: middle;" src="https://i2.createsend1.com/static/eb/master/03-fresh/imgf/linkedin-sf.png" width="29" height="26">
                                                                                </a>
                                                                                <a style="transition: opacity 0.2s ease-in;color: #b9b9b9; text-decoration: none;" href="http://www.ekc2000.nl" target="_blank">
                                                                                    <img style="border: 0;-ms-interpolation-mode: bicubic;vertical-align: middle;" src="https://i3.createsend1.com/static/eb/master/03-fresh/imgf/website-sf.png" width="29" height="26">
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                </tbody>
                                                            </table>
                                                            <table class="left" style="border-collapse: collapse;border-spacing: 0;" align="left">
                                                                <tbody>
                                                                    <tr>
                                                                        <td style="padding: 0;vertical-align: top;color: #b9b9b9;font-size: 12px;line-height: 22px;text-align: left;width: 400px;">
                                                                            <div class="address" style="font-family: &quot;Open Sans&quot;,sans-serif;Margin-bottom: 18px;">
                                                                                <div>EKC 2000<br>7827&nbsp;XA&nbsp;Emmen<br>Zwaanenveld 5</div>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </td>
                                                        <td style="padding: 0;vertical-align: top;">&nbsp;</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </center>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </body>
                </html>';

    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= "From:" . $from . "\r\n";

    mail($to, $subject, $message, $headers);

//    $subject2 = "*Kopie*" . $subject . "*Kopie*";
//    $message2 = "*Kopie*" . $message . "*Kopie*";
//    mail($from, $subject2, $message2, $headers);
}