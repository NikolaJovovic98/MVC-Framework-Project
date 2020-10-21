<?php
   require APPROOT . '/views/includes/head.php';
?>

<div class="navbar">
    <?php
       require APPROOT . '/views/includes/navigation.php';
    ?>
</div>





<div class="news-flex-one">

<!--Prikazivanje naslova vijesti -->
 <h1 style="text-align: center;"> <?= $data['news']->title ; ?> </h1>

 
        <div class="news-section-one">

            


<!--Prikazivanje sadrzaja vijesti -->
             <p> <?= $data['news']->body; ?>  </p>
  
   <div class="written-by-p">
    
   
<!--Prikazivanje username korisnika koji je napisao vijest -->
   <p>Written by: <a href="<?php echo URLROOT; ?>/users/show/<?=$data['user']->id ?>"><b><?= $data['user']->username ?></b></a>   </p>
 
</div>
        

<!--Prikazivanje dugmeta DELETE koje brise vijest a koje je prikazano samo ukoliko je korisnik prijavljen i samo ukoliko je on napisao tu vijest-->
<?php if(isset($_SESSION['user_id'])): ?>

      <?php if($data['news']->user_id == $_SESSION['user_id']): ?>

               <form action="<?php echo URLROOT; ?>/news/delete/<?= $data['news']->id ?>" method="POST">
 
                  <label for="delete-news-button" style="margin-right: 10px;">Do you want to delete this news?</label>
                   <button id="deleteNewsButton" type="submit" name="delete-news-button">Delete</button>

               </form>
               

         <?php else: ?>

         

      <?php endif; ?>


<?php else: ?>

<?php echo ''; ?>

<?php endif; ?>


      </div>


      </div>

      <hr class="news-comment-separator">


<!--Session zasluzan za prikazivanje poruke da je komentar uspjesno postaljen -->
      <?php

    if(isset($_GET['success']) && $_GET['success'] == 'commentPosted'){

            echo ' <h3 style="color: green;text-align:center;">Comment posted</h3>';

    }
    
    else {

        echo '';

    }
 

  ?>


      <div style="text-align: center;"><h3>Leave a comment</h3></div>

     
      
<!--Prikazivanje forme za postavljanje komentara ukoliko je korisnik loginovan ukoliko nije prikazuje se poruka sa odredjenim sadrzajem -->
      <?php if(isset($_SESSION['user_id'])): ?>

                        <div class="comment-news-section">

                           <form  action="<?php echo URLROOT; ?>/comments/store" method="POST" >


                                    <input  type="hidden" name="userid" value=" <?php echo $_SESSION['user_id'] ?> " readonly >

                                    <input  type="hidden" name="newsid" value=" <?php echo $data['news']->id ?>    " readonly >


                                    <textarea class="comment-body" name="body" id="comment" rows="3" placeholder="Comment" required></textarea>
                                      

                                    <button type="submit" name="comment-button" >Comment</button>

                           </form>


               </div>


      <?php else: ?>

         <div class="forbidden-comment-section" >

            <p >You need to be <a style="color: blue;text-decoration: none;" href="<?php echo URLROOT; ?>/users/login"> <b>Signed In</b></a> to comment </p>


         </div>


      <?php endif; ?>

      <hr class="news-comment-separator">

      
<!--Prikazivanje komentara njegovog teksta datuma na koji je postavljen kao i korisnika koji ga je postavio -->
<div class="one-comment-flex">
      <?php foreach($data['comments'] as $comment): ?>

         <div class="one-comment">

         <p>  <i><?= $comment->body; ?></i>  </p>
          

<!--Prikazivanje datuma i imena korisnika koji je postavio taj komentar-->
         <?php foreach($data['usersComments'] as $user):  ?>

            <?php if($user->id == $comment->user_id): ?>

             <p><small> Posted by:   <b><?= $user->username; ?></b>  </small></p>  
             <p><small>Posted on: <?= $comment->date; ?> </small> </p>

             
<!--Prikazivanje dugmeta DELETE za brisanje komentara ukoliko je postavljen session i ukoliko je taj korisnik koji je postavio komentar
prijavljen na sajt -->
            <?php if(isset($_SESSION['user_id'])): ?>

                   <?php  if($comment->user_id == $_SESSION['user_id'] ): ?>

                               <form  action="<?php echo URLROOT; ?>/comments/delete/<?= $comment->id; ?>" method="POST" >

                               <input type="hidden" name="redirect" value="<?php echo htmlspecialchars($_SERVER['REQUEST_URI']) ?>">

                                    <button type="submit" name="delete-comment" id="delete-comment">Delete</button>

                              </form>

                  <?php else:  ?>

                   <?php endif;?>

            <?php else: ?>

            <?php endif; ?>


         <?php else: ?>



         <?php endif;?>


         <?php endforeach; ?>


      </div>

    

      <?php endforeach; ?>

        </div>



