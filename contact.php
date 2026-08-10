<?php
include "includes/session.php";
include "includes/shopping_cart.php";
include "includes/database.php";
$success = false;
// if the form is submitted
if( $_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $subject = $_POST["subject"];
    $message = $_POST["message"];
    // echo "name:$name email:$email subject:$subject message:$message";
    // put form data in the database
    $query = "INSERT INTO contact_us (name,email,subject,message) 
    VALUES(?,?,?,?)";
    $statement = $connection -> prepare($query);
    $statement -> bind_param("ssss",$name,$email,$subject,$message);
    $statement -> execute();
    $success = true;
}
?>
<!DOCTYPE html>
<html lang="en">
<?php include "fragment/head.php"; ?>
<body>
   <?php include "fragment/header.php"; ?>
   <main class="content">
        <form id="contact-form" method="post" action="contact.php">
            <?php 
            if( $success == true ) {
                echo "
                <dialog id='success'>
                    Thank you for contacting us. 
                    <button commandFor='success' command='close'>Close</button>
                </dialog>
                ";
            }
            ?>
            <div class="group">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" placeholder="your name" required>
            </div>
            <div class="group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="you@example.com" required>
            </div>
            <div class="group">
                <label for="subject">Subject</label>
                <select name="subject" id="subject">
                    <option value="product inquiry">Product Inquiry</option>
                    <option value="order issue">Order Issue</option>
                    <option value="other">Other</option>
                </select>
            </div>
            <div class="group">
                <label for="message">Message</label>
                <textarea name="message" id="message" cols="30" rows="5" required></textarea>
            </div>
            <div class="buttons">
                <button type="reset">Cancel</button>
                <button type="submit">Send</button>
            </div>
        </form>
   </main>
   <?php include "fragment/footer.php"; ?>
</body>
</html>