<?php
 include 'header.php'
 ?>

<div class="login">
    <form id="loginForm" action="includes/login.inc.php" method="post" novalidate>
        <h2>Login</h2>
        <label for="loginUsername">Username:</label>
        <input type="text" id="loginUsername" name="loginUsername" required>

        <label for="loginPassword">Password:</label>
        <input type="password" id="loginPassword" name="loginPassword" required>

        <input type="submit" value="Login">
    </form>
</div>


<?php
    include 'footer.php';
?>
