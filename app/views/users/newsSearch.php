<?php
   require APPROOT . '/views/includes/head.php';
?>

<div class="navbar">
    <?php
       require APPROOT . '/views/includes/navigation.php';
    ?>
</div>


<h4>Search results:</h4>


<?php if(empty($data['search-error'])): ?>


<div class="news-flex" >


<?php  foreach($data['news'] as $one_news): ?>

   
  <a href="<?php echo URLROOT; ?>/news/show/<?= $one_news->id; ?>" id="one-user-anchor" >

  <div class="news-section">

  <h3> <?= $one_news->title; ?></h3>
  <p> <?= $one_news->synopsis; ?>   </p>


<?php if(isset($_SESSION['user_id'])): ?>

      <?php if($one_news->user_id == $_SESSION['user_id']): ?>

         <p style="color:green">Written by you !</p>

         <?php else: ?>

         
      <?php endif; ?>


<?php else: ?>

<?php echo ''; ?>

<?php endif; ?>

</div>

</a>

<?php endforeach; ?>


</div>

<?php else: ?>

    <p>No news found.</p>

<?php endif; ?>

