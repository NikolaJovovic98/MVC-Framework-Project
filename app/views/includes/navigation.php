<nav class="top-nav">

    <ul class="nav-ul">

        <li class="active">
            <a href="<?php echo URLROOT; ?>">Home</a>
        </li>

        <li>
            <a href="<?php echo URLROOT; ?>/home/about">About</a> 
        </li>

        <li >
            <a href="<?php echo URLROOT; ?>/users/index">Users List</a>
        </li>
        
        <li >
            <a href="<?php echo URLROOT; ?>/news/index">News</a>
        </li>

        
        <?php if(isset($_SESSION['user_id'])): ?>

            <li >
                 <a href="<?php echo URLROOT; ?>/news/store">Write News</a>
            </li>

        <?php else: ?>
            
        <?php endif; ?>
    
        <?php if(isset($_SESSION['user_id'])): ?>

                <li >
                    <a href="<?php echo URLROOT; ?>/users/showUserProfile/<?php echo $_SESSION['user_id']?>">Your Profile</a>
                </li>

        <?php else: ?>

        <?php endif; ?>


        <?php
        
        if(isset($_SESSION['user_id'])){


                echo '<li style="color:gold"> '.$_SESSION['username'].'  </li>';

        }
        else {

            echo '';

        }
              ?>
        <li class="btn-login">
            <?php if(isset($_SESSION['user_id'])) : ?>
                <a href="<?php echo URLROOT; ?>/users/logout">Log out</a>
            <?php else : ?>
                <a href="<?php echo URLROOT; ?>/users/login">Login</a>
            <?php endif; ?>
        </li>
    </ul>
</nav>
