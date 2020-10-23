<nav class="top-nav">

    <ul class="nav-ul">


            <li class="active">
                <a href="<?php echo URLROOT; ?>">Home</a>
            </li>

            <li>
                <a href="<?php echo URLROOT; ?>/users/index">Users List</a>
            </li>

            <li>
                <a href="<?php echo URLROOT; ?>/news/index">News</a>
            </li>

            <li>
                <a href="<?php echo URLROOT; ?>/home/about">About</a>
            </li>

     

        <?php if (isset($_SESSION['user_id'])) : ?>

            <li>
                <a href="<?php echo URLROOT; ?>/news/store">Write News</a>
            </li>

        <?php else : ?>

        <?php endif; ?>



        <?php if (isset($_SESSION['user_id'])) : ?>

            <li>
                <a href="<?php echo URLROOT; ?>/users/showUserProfile/<?php echo $_SESSION['user_id'] ?>">Your Profile</a>
            </li>

        <?php else : ?>

        <?php endif; ?>


        <?php

        if (isset($_SESSION['user_id'])) {


            echo '<li style="color:gold"> ' . $_SESSION['username'] . '  </li>';
        } elseif (isset($_SESSION['admin_id'])) {

            echo '<li style="color:gold"> ' . $_SESSION['admin_username'] . '  </li>';
        } else {

            echo '';
        }
        ?>
        <li class="btn-login">
            <?php if (isset($_SESSION['user_id'])) : ?>
                <a href="<?php echo URLROOT; ?>/users/logout">Log out</a>
            <?php else : ?>
                <a href="<?php echo URLROOT; ?>/users/login">Login</a>
            <?php endif; ?>
        </li>


        <li id="search-form-li">
        
            <form action="<?php echo URLROOT; ?>/news/search" method ="POST" id="search-form">
            
                <input type="text" name="search_text" placeholder="Search for news...">
                

                 <button type="submit" id="search-button"><i class="fa fa-search"></i></button>
                
            </form>    
        

        </li>        


    </ul>
</nav>