<?php
   require APPROOT . '/views/includes/head.php';
?>

<div class="navbar">
    <?php
       require APPROOT . '/views/includes/navigation.php';
    ?>
</div>



<h1 style="text-align: center;">EDIT YOUR PROFILE</h1>



<div class="container-login">
    <div class="wrapper-login">

            <form
                id="edit-form"
                method="POST"
                action="<?php echo URLROOT; ?>/users/update"
                name="edit-form"
                >

            <input type="hidden" name="userid" value="<?php echo $_SESSION['user_id'] ?>">    

            <input type="text" placeholder="Username *" name="username" value=" <?php echo $_SESSION['username'] ?> ">
          
            <input type="email" placeholder="Email *" name="email" value="<?php echo $_SESSION['email'] ?>">
          
            <button id="submit" type="submit" value="submit">Update</button>

            
        </form>
    </div>
</div>