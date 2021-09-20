<?

    // intilize vars or set them from $_POST
    
    $name = isset($_POST["name"]) ? $_POST["name"] : "";
    $email = isset($_POST["email"]) ? $_POST["email"] : "";
    $title = isset($_POST["title"]) ? $_POST["title"] : "";
    $recipe = isset($_POST["recipe"]) ? $_POST["recipe"] : "";
    $submit = isset($_POST["submit"]) ? $_POST["submit"] : "";
    
    $ip = $_SERVER["REMOTE_ADDR"];
?>



<?
include("header.php");
?>



<?php
if ($submit)
{
    if ($name &&  $title && $recipe)
    {
        // send email to couple
        
        $to = $rsvp_email; /* var set in config.php */

        $subject = "Wedding Recipe!";
        
        // change settings below depending on hosting server
        
        //$smtpemail = $email == "" ? "" : $email;
        
        //ini_set('SMTP','mail.shaw.ca');
        //ini_set('sendmail_from',"$smtpemail");
        //ini_set('smtp_port',25);
        
        $headers = "";
        $headers .= "From: Recipe Form <" . strip_tags("donotreply@$domain") . ">\r\n"; // $domain has to be an existing domain on the www
        $headers .= "Reply-To: ". strip_tags($email) . "\r\n";
        //$headers .= "CC: gene@example.com\r\n";
        $headers .= "BCC: lmiok36@gmail.com\r\n";
        //$headers .= "MIME-Version: 1.0\r\n";
        //$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
        
        // prepare content
        $contentemail = $email == "" ? "An email address was not given." : strip_tags($email);
        $name = strip_tags($name);
        $title = strip_tags($title);
        $recipe = strip_tags($recipe);
        
        $dashes="----------------------------------------------------------------------------------------------------";
        //$content = "<html><head></head><body>";
        //$content .= "$name<br/>$contentemail<br/>$contentattending<br/><br/>$contentmessage<br/><br/>Sent from ip address: ($ip)";
        //$content .= "</body></html>";
        
        $content = "Hi Sylvia and Gene,\r\n\r\n$name has sent you a recipe. Below are the details:\r\n\r\n$contentemail\r\n\r\n$title\r\n\r\n$recipe\r\n\r\nSent from ip address: $ip";
        
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
                
                $subject = "Sylvia and Gene's Wedding Recipe Submission!";
                
                $headers = "";
                $headers .= "From: Recipe Form <" . strip_tags("donotreply@$domain") . ">\r\n";
                $headers .= "Reply-To: ". $rsvp_email . "\r\n"; /* var set in config.php */
                $headers .= "BCC: lmiok36@gmail.com\r\n";
                
                $content = "Hello $name,\r\n\r\nYour recipe has been sent to Sylvia and Gene.\r\n\r\nThank You.";
                
                $sendtorsvper = @mail($to, $subject, $content, $headers); // suppress email error messages with @
                
                if ($sendtorsvper)
                {
                    // good
                    
                    $submitmessage = "<div class=\"submitmessageconfirmation\">The recipe has been sent! An email has also been sent to You.</div>\n";
                
                     // clear data
                    $name = "";
                    $email = "";
                    $title = "";
                    $recipe = "";
                    $ip = "";
                }
                else
                {
                    // good and error sending to rsvper - ignore and send confirmation email
            
                    //$submitmessage = "<div class=\"submitmessageerror\">RSVP message could not be sent at this time. Please enter a correct email address or try again later or call the number below.</div>\n";
                    $submitmessage = "<div class=\"submitmessageconfirmation\">The recipe has been sent, however an email was not sent to You.</div>\n";
                }
            }
            else
            {
                //good
                
                $submitmessage = "<div class=\"submitmessageconfirmation\">The recipe has been sent!</div>\n";
                
                 // clear data
                $name = "";
                $email = "";
                $title = "";
                $recipe = "";
                $ip = "";
            }
        }
        else
        {
            //error sending to couple
            
            $submitmessage = "<div class=\"submitmessageerror\">The recipe email could not be sent at this time. Please try again later or call the number below.</div>\n";
        }
    
    }
    else
    {
        // set validation messages... will show messages elsewhere
        $validation_message_name = !$name ? "Name not entered!" : "";
        $validation_message_title = !$title ? "Title not entered!" : "";
        $validation_message_recipe = !$recipe ? "Recipe not entered!" : "";
    }
}
?>



<h2>Favorite Recipes for the Bride</h2>

<hr/>

If you would like, please send the Bride a favorite recipe of yours. 

<hr/>

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
                <label for="name">*Name: </label>
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
                <label for="title">*Title: </label>
            </td>
            <td>
                <textarea class="text" id="title" name="title" maxlength="200"/><?=$title?></textarea>
            </td>
            <td class="td_validationmessageinput">
            <span class="validationmessageinput"><?= isset($validation_message_title) ? $validation_message_title : "" ?></span>
            </td>
        </tr>
        <tr>
            <td>
                <label for="recipe">*Recipe: </label>
            </td>
            <td>
                <textarea class="recipemessage" id="recipe" name="recipe" maxlength="10000" placeholder="...with ingredients and instructions..."><?=$recipe?></textarea>
            </td>
            <td class="td_validationmessageinput">
            <span class="validationmessageinput"><?= isset($validation_message_recipe) ? $validation_message_recipe : "" ?></span>
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

Thank You:)

<?
include("footer.php");
?>
