<?php
   require APPROOT . '/views/includes/head.php';
?>


<div id="section-landing">

<?php
       require APPROOT . '/views/includes/navigation.php';
    ?>


    <div class="wrapper-landing">

    
      
       <?php

          if(isset($_SESSION['user_id'])){

            echo '<h1 style="color: orange;"><b>Welcome '.$_SESSION['username'].' !</b></h1>';
            

          }
          else {

            echo '';

          }

        ?>


        <h1>MVC Project</h1>

        <?php

if(isset($_SESSION['user_id'])){

  echo '<h1>Feel free to explore our site!</h1>';
  

}
else {

  echo '<h2>Login or register for full expirience</h2>';

}

?>

        
    </div>


    
</div>
