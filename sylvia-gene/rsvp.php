<?

    // intilize vars or set them from $_POST
    
    $name = isset($_POST["name"]) ? $_POST["name"] : "";
    $email = isset($_POST["email"]) ? $_POST["email"] : "";
    $attending = isset($_POST["attending"]) ? $_POST["attending"] : "";
    $numberattending = isset($_POST["numberattending"]) ? $_POST["numberattending"] : "";
    $message = isset($_POST["message"]) ? $_POST["message"] : "";
    $submit = isset($_POST["submit"]) ? $_POST["submit"] : "";
    
    $ip = $_SERVER["REMOTE_ADDR"];
?>



<?
include("header.php");
?>

<script type="text/javascript">
$(document).ready(function(){
    
    $('input[name=attending]').change(function(){
        if (this.value == "yes") {
            $('textarea[name="numberattending"]').attr('disabled', false).focus();
        } else {
            $('textarea[name="numberattending"]').val('0');//.text('0'); 
            $('textarea[name="numberattending"]').attr('disabled', true);
        }
    });
    
    $('textarea[name="numberattending"]').attr('disabled', false);
            
});
</script>


<?php
if ($submit)
{
    if ($name && ($numberattending || (!$numberattending && $attending=="no")))
    {
        // send email to couple
        
        $to = $rsvp_email; /* var set in config.php */

        $subject = "Wedding RSVP!";
        
        // change settings below depending on hosting server
        
        //$smtpemail = $email == "" ? "" : $email;
        
        //ini_set('SMTP','mail.shaw.ca');
        //ini_set('sendmail_from',"$smtpemail");
        //ini_set('smtp_port',25);
        
        $headers = "";
        $headers .= "From: RSVP Form <" . strip_tags("donotreply@$domain") . ">\r\n"; // $domain has to be an existing domain on the www
        $headers .= "Reply-To: ". strip_tags($email) . "\r\n";
        //$headers .= "CC: gene@example.com\r\n";
        $headers .= "BCC: lmiok36@gmail.com\r\n";
        //$headers .= "MIME-Version: 1.0\r\n";
        //$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
        
        // prepare content
        $contentemail = $email == "" ? "An email address was not given." : strip_tags($email);
        $contentattending = $attending == "yes" ? "Yes, " . strip_tags($numberattending) . " guests attending!" : "No, not attending:(";
        $contentmessage = $message == "" ? "A message was not given." : strip_tags($message);
        
        $name = strip_tags($name);
        
        //$content = "<html><head></head><body>";
        //$content .= "$name<br/>$contentemail<br/>$contentattending<br/><br/>$contentmessage<br/><br/>Sent from ip address: ($ip)";
        //$content .= "</body></html>";
        
        $content = "Hi Sylvia and Gene,\r\n\r\n$name has sent you an RSVP. Below are the details:\r\n\r\n$name\r\n$contentemail\r\n$contentattending\r\n\r\n$contentmessage\r\n\r\nSent from ip address: $ip";
        
        $sendtocouple = @mail($to, $subject, $content, $headers); // suppress email error messages with @
        //$sendtocouple = mail("lmiok36@gmail.com", "Message from Mars", "TEST", "From: RSVP@$domain");
        
        $submitmessage ="";
        
        if ($sendtocouple)
        {
            if (!filter_var($email, 274) === false) // FILTER_VALIDATE_EMAIL=274
            {
                // $email is a valid email address
                
                // send email to rsvper
                $to = $email;
                
                $subject = "Sylvia and Gene's Wedding RSVP!";
                
                $headers = "";
                $headers .= "From: RSVP Form <" . strip_tags("donotreply@$domain") . ">\r\n";
                $headers .= "Reply-To: ". $rsvp_email . "\r\n"; /* var set in config.php */
                $headers .= "BCC: lmiok36@gmail.com\r\n";
                
                $content = "Hello $name,\r\n\r\nYour RSVP has been sent to Sylvia and Gene.\r\n\r\nThank You.";
                
                $sendtorsvper = @mail($to, $subject, $content, $headers); // suppress email error messages with @
                
                if ($sendtorsvper)
                {
                    // good
                    
                    $submitmessage = "<div class=\"submitmessageconfirmation\">The RSVP has been sent! An email has also been sent to You.</div>\n";
                
                     // clear data
                    $name = "";
                    $email = "";
                    $attending = "";
                    $numberattending = "";
                    $message = "";
                    $ip = "";
                }
                else
                {
                    // good and error sending to rsvper - ignore and send confirmation email
            
                    //$submitmessage = "<div class=\"submitmessageerror\">RSVP message could not be sent at this time. Please enter a correct email address or try again later or call the number below.</div>\n";
                    $submitmessage = "<div class=\"submitmessageconfirmation\">The RSVP  has been sent, however an email was not sent to You.</div>\n";
                }
            }
            else
            {
                //good
                
                $submitmessage = "<div class=\"submitmessageconfirmation\">The RSVP has been sent!</div>\n";
                
                 // clear data
                $name = "";
                $email = "";
                $attending = "";
                $numberattending = "";
                $message = "";
                $ip = "";
            }
        }
        else
        {
            //error sending to couple
            
            $submitmessage = "<div class=\"submitmessageerror\">The RSVP could not be sent at this time. Please try again later or call the number below.</div>\n";
        }
    
    }
    else
    {
        // set validation messages... will show messages elsewhere
        $validation_message_name = !$name ? "Name(s) not entered!" : "";
        $validation_message_numberattending = !$numberattending && $attending=="yes" ? "Number Attending not entered!" : "";
    }
}
?>



<h2>RSVP</h2>

<hr/>
<!--
Beautiful Bride, Handsome Groom, Food, Booze, Dancing... You in or what?

<hr/>
-->

<?=isset($submitmessage) ? $submitmessage : ""?>

<form id="input-form" name="input-form" method="post" action="">
    <table id="rsvp">
        <colgroup>
            <col id="col_rsvp_1"/>
            <col id="col_rsvp_2"/>
            <col id="col_rsvp_3"/>
        </colgroup>
        <tr>
            <td>
                <label for="name">*Name(s): </label>
            </td>
            <td>
                <textarea class="text" id="name" name="name" maxlength="200"/><?=$name?></textarea>
            </td>
            <td class="td_validationmessageinput">
            <span class="validationmessageinput"><?= isset($validation_message_name) ? $validation_message_name : "" ?></span>
            </td>
        </tr>
        <tr>
            <td>
                <label for="email">Email: </label>
            </td>
            <td>
                <textarea class="text" id="email" name="email" maxlength="200"/><?=$email?></textarea>
            </td>
        </tr>
        <tr>
            <td>
            </td>
            <td>
                <input type="radio" name="attending" value="yes" <?= $attending=="yes" || !$attending ? "checked" : "";?>> Attending
            </td>
        </tr>
        <tr>
            <td>
            </td>
            <td>
                <input type="radio" name="attending" value="no" <?= $attending=="no" ? "checked" : "";?>> Not Attending
            </td>
        </tr>
        <tr>
            <td>
                <label for="numberattending">*Number Attending:</label>
            </td>
            <td>
                <textarea class="text" id="numberattending" name="numberattending" rows="1" maxlength="200" disabled><?=$numberattending?></textarea>
            </td>
            <td class="td_validationmessageinput">
            <span class="validationmessageinput"><?= isset($validation_message_numberattending) ? $validation_message_numberattending : "" ?></span>
            </td>
        </tr>
        <tr>
            <td>
                <label for="message">Message: </label>
            </td>
            <td>
                <textarea class="textmessage" id="message" name="message" maxlength="400"><?=$message?></textarea>
            </td>
        </tr>
        <tr>
            <td>
            </td>
            <td id="td_submit">
                <input type="submit" id="submit" name="submit" value="Send"/>
            </td>
        </tr>
    </table>
    
</form>

<hr/>

For any questions, changes, or to RSVP by  phone, please call Gene &amp; Sylvia at (780) 449-1075 and leave a message:)

<?
include("footer.php");
?>
