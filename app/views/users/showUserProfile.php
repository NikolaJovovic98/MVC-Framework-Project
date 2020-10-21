<?php
   require APPROOT . '/views/includes/head.php';
?>

<div class="navbar">
    <?php
       require APPROOT . '/views/includes/navigation.php';
    ?>
</div>

<?php if(isset($_GET['success']) && $_GET['success']=='update'): ?>

         <h3 style="color: green;text-align: center;">Profile updated!</h3>

<?php else: ?>


<?php endif; ?>

<h1 style="text-align: center;"><?=$data['user']->username?></h1>

<p style="text-align: center;"> <?= $data['user']->email?> </p>


<div class="edit-profile-div">


<p>Would you like to change your personal info ? <a href="<?php echo URLROOT; ?>/users/edit/">Edit your profile.</a></p>




</div>


<h4>News written by you:</h4>
<div  class="news-flex">

      <?php foreach($data['user-news'] as $userNews): ?>

         <a href="<?php echo URLROOT; ?>/news/show/<?= $userNews->id; ?>" id="one-user-anchor" >
         
         <div class="news-section">

               <h3> <?= $userNews->title; ?></h3>
               <p> <?= $userNews->synopsis; ?>   </p>
            
          </div>

         </a>

      <?php endforeach; ?>


</div>




<div class="user-followers">

    <div style="width: 100%;background-color: #888888;text-align: center;">
    
    <h4 >Users you follow</h4>

    </div>
    

    <?php foreach($data['users-you-follow'] as $follower): ?>

      
         <div class="follower-username">

                <a href="<?php echo URLROOT; ?>/users/show/<?= $follower->id; ?>" id="one-follower-anchor">  
                

                        <p> <?= $follower->username ?> </p> <br>

                </a>

        </div>

    <?php endforeach; ?>

</div>
