<?php
 include 'header.php';
 ?>

<div class="signup">
    <form id="signupForm" action="includes/signup.inc.php" method="post" novalidate>
        <h2>Sign Up</h2>
        <label for="signupUsername">Username:</label>
        <input type="text" id="signupUsername" name="signupUsername" required>

        <label for="signupUseremail">Email:</label>
        <input type="text" id="signupUseremail" name="signupUseremail" required>

        <label for="signupPassword">Password:</label>
        <input type="password" id="signupPassword" name="signupPassword" required>
                
        <input type="submit" value="Sign Up">
    </form>
</div>


<?php
    include 'footer.php';
?>
   