<?php
   require APPROOT . '/views/includes/head.php';
?>

<div class="navbar">
    <?php
       require APPROOT . '/views/includes/navigation.php';
    ?>
</div>

<?php

if(isset($_GET['success']) ){

   if($_GET['success'] == 'followed'){


      echo ' <h3 style="color: green;text-align:center">You followed '. $data['user']->username .'</h3>';


   }

   else if($_GET['success'] == 'unfollowed'){

      echo ' <h3 style="color: red;text-align:center">You unfollowed '. $data['user']->username .'</h3>';
   }
      

}

else {

   echo '';

}


?>

<h1 style="text-align: center;"><?=$data['user']->username?></h1>

<p>You can contact this user by sending him mail at adress: <a href="mailto: <?= $data['user']->email?>"><b><?=$data['user']->email?></b></a> </p>

<?php if(isset($_SESSION['user_id'])): ?>

      <?php if($_SESSION['user_id']==$data['user']->id): ?>

        
         <?php else: ?>


            <?php if($data['singed-In-User-Followers']==1): ?>


               <div id="follow-button-section">
              
              
          <p> <small>You are following this user!</small> </p>
       
          <form action="<?php echo URLROOT; ?>/follows/delete" method="POST">

             <input type="hidden" name="userID" value=" <?= $_SESSION['user_id'] ?> " readonly>
          
             <input type="hidden" name="followingUserID" value=" <?= $data['user']->id ?> " readonly>

             <button type="submit" style="background-color: red;">Unfollow</button>

          </form>

          </div>
   
<?php else: ?>


   <div id="follow-button-section">
              
             
          <p> <small>Would you like to see more content from this user ? You can follow !</small> </p>
       
          <form action="<?php echo URLROOT; ?>/follows/store" method="POST">

             <input type="hidden" name="userID" value=" <?= $_SESSION['user_id'] ?> " readonly>
          
             <input type="hidden" name="followingUserID" value=" <?= $data['user']->id ?> " readonly>

             <button type="submit">Follow</button>

          </form>

          </div>

 <?php endif; ?>


         <?php endif; ?>


<?php else: ?>


<?php endif; ?>



<h4>News written by user:</h4>

<?php if($data['user-news-count']==0): ?>

   <p>No news yet.</p>

<?php else: ?>

<div class="news-flex">

      <?php foreach($data['user-news'] as $userNews): ?>

         <a href="<?php echo URLROOT; ?>/news/show/<?= $userNews->id; ?>" id="one-user-anchor" >
         
         <div class="news-section">

               <h3> <?= $userNews->title; ?></h3>
               <p> <?= $userNews->synopsis; ?>   </p>
            
          </div>

         </a>

      <?php endforeach; ?>


</div>

      <?php endif; ?>




