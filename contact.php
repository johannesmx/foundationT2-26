<?php
include "includes/database.php";
?>
<!DOCTYPE html>
<html lang="en">
<?php include "fragment/head.php"; ?>
<body>
   <?php include "fragment/header.php"; ?>
   <main class="content">
        <form id="contact-form">
            <label for="name">Name</label>
            <input type="text" id="name" name="name" placeholder="your name" required>
            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="you@example.com" required>
            <label for="subject">Subject</label>
            <select name="subject" id="subject">
                <option value="product inquiry">Product Inquiry</option>
                <option value="order issue">Order Issue</option>
                <option value="other">Other</option>
            </select>
            <label for="message">Message</label>
            <textarea name="message" id="message" cols="30" rows="5"></textarea>
            <button type="reset">Cancel</button>
            <button type="submit">Send</button>
        </form>
   </main>
   <?php include "fragment/footer.php"; ?>
</body>
</html>