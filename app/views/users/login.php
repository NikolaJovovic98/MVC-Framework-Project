<?php
   require APPROOT . '/views/includes/head.php';
?>

<div class="navbar">
    <?php
       require APPROOT . '/views/includes/navigation.php';
    ?>
</div>

<div class="container-login">
    <div class="wrapper-login">

  <?php

    if(isset($_GET['success']) && $_GET['success'] == 'registration'){

            echo ' <h3 style="color: green;">Registration successful</h3>';

    }
    
    else {

        echo '';

    }
 

  ?>


        <h2>Sign in</h2>

        <form action="<?php echo URLROOT; ?>/users/login" method ="POST" name="register-form">
            <input type="text" placeholder="Username *" name="username">
            <span class="invalidFeedback">
                <?php echo $data['usernameError']; ?>
            </span>

            <input type="password" placeholder="Password *" name="password">
            <span class="invalidFeedback">
                <?php echo $data['passwordError']; ?>
            </span>

            <button id="submit" type="submit" value="submit">Submit</button>

            <p class="options">Not registered yet? <a href="<?php echo URLROOT; ?>/users/register">Create an account!</a></p>
        </form>
    </div>
</div>


<div class="login-footer">
    
<?php
 require APPROOT . '/views/includes/footer.php';
?>

    </div>