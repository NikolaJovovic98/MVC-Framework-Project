<?php
   require APPROOT . '/views/includes/head.php';
?>

<div class="navbar">
    <?php
       require APPROOT . '/views/includes/navigation.php';
    ?>
</div>


<h1 style="text-align: center;">WRITE NEWS</h1>



<div class="container-login">
    <div class="wrapper-login">


    
  <?php

if(isset($_GET['success']) && $_GET['success'] == 'news'){

        echo ' <h3 style="color: green;">News successfully added</h3>';

}

else {

    echo '';

}


?>

<form action="<?php echo URLROOT; ?>/news/store" method ="POST">

            <input type="text" placeholder="Title *" name="title" >

            <span class="invalidFeedback">
                <?php echo $data['titleError']; ?>
            </span>

            <input type="text" placeholder="Synopsis *" name="synopsis" >

            <span class="invalidFeedback">
                <?php echo $data['synopsisError']; ?>
            </span>

            <input type="hidden" placeholder="User Id *" name="user_id" value=" <?=  $_SESSION['user_id'] ?> " >
            
            <textarea  id="" cols="40" rows="10" placeholder="Body *" name="body" ></textarea>
            <span class="invalidFeedback">
                <?php echo $data['bodyError']; ?>
            </span>

            <button id="submit" type="submit" value="submit">Submit</button>


 </form>

 </div>
</div>