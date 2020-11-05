<?php
require APPROOT . '/views/includes/head.php';
?>

<div class="navbar">
    <?php
    require APPROOT . '/views/includes/navigation.php';
    ?>
</div>




<h2 style="text-align: center;">USERS LIST (number of users: <?= $data['usersNum']; ?>)</h2>

<div class="quick-search-div">

    <input type="text" placeholder="Quick Search..." id="quick-search-user">

</div>  

<div class="users-list-div" >

<?php foreach ($data['users'] as $user) : ?>


    <?php if (isset($_SESSION['user_id'])) : ?>


        <a href="<?php echo URLROOT; ?>/users/show/<?= $user->id; ?>" id="one-user-anchor-list">

        <?php else : ?>

            <a href="javascript:singupAlert()" id="one-user-anchor-list">


            <?php endif; ?>


            <div id="fan_div">


                <ul>

                    <li class="username-user"> <b>Username:</b> <?= $user->username; ?> </li>

                </ul>

            </div>

            </a>

        <?php endforeach; ?>


        </div>

        <?php
    require APPROOT . '/views/includes/footer.php';
    ?>

        <script>
            function singupAlert() {

                alert("You must be logged in to view user info");

            }
        </script>