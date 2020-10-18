
<!--

View je ono sto korisnik vidi na ekranu tj html nema baza podataka i nikakve logike oni nista ne znaju o Modelu
 vec im se prosljedjuju podaci iz kontrolera i onda je view zasluzan za prikazivanje tih podataka u odgovarajucem html formatu 

 Dakle ovo je view on se vodi kao php fajl stim sto prestavlja kombinaciju php-a i html-a dakle on sluzi za samu interakciju sa korisnikom
 ovo sto se odje pojavljuje jeste ono sto korisnik vidi na svom monitoru view prima podatke iz kontrolera kao sto smo prethodno odradili
 kod kontrolera News u kom smo vratili ovaj view sa podacima smjestenim u $data e sad tim podacima pristupamo na razne nacine i kombinujemo ih
 sa html elementima radi prikazivanja njih samih korisniku idemo sad dolje 

 Framework kao sto je Laravel ima svoj koncept view-a i mnogo je lakse spajati php kod sa html-om 
 

 -->

<?php
   require APPROOT . '/views/includes/head.php';
?>

<div class="navbar">
    <?php
       require APPROOT . '/views/includes/navigation.php';
    ?>
</div>


<h1 style="text-align: center;">NEWS FEED</h1>


<?php

if(isset($_GET['success']) && $_GET['success'] == 'newsDeleted'){

      echo '<h3 style="color: green;text-align: center">News deleted successfully</h3> ';

}

else {

   echo '';

}


?>


<div class="news-flex">

<!--Dakle otvaramo php tagove i kroz petlju govorimo za svaki $data['news'] (dakle name key 'news' koji sadrzi svaki objekat News
izvucen iz News modela ) as $one_news dakle taj niz razlazemo na pojedince i onda pristupamo podacima pojedinaca tako sto dodamo npr
$one_news->title tj daj mi naslov od tog objekta itd itd ima mnogo nacina da se manipulise ovim podacima -->


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