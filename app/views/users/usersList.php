<?php
require APPROOT . '/views/includes/head.php';
?>

<div class="navbar">
    <?php
    require APPROOT . '/views/includes/navigation.php';
    ?>
</div>




<?php foreach ($data['user_num_of_news'] as $user_news) : ?>

    <p><?= $user_news ?> </p>

<?php endforeach; ?>

<h1 style="text-align: center;">USERS LIST (number of users: <?= $data['usersNum']; ?>)</h1>


<?php foreach ($data['users'] as $user) : ?>


    <?php if (isset($_SESSION['user_id'])) : ?>


        <a href="<?php echo URLROOT; ?>/users/show/<?= $user->id; ?>" id="one-user-anchor-list">

        <?php else : ?>

            <a href="javascript:singupAlert()" id="one-user-anchor-list">


            <?php endif; ?>


            <div id="fan_div">


                <ul>

                    <li> <b>Username:</b> <?= $user->username; ?> </li>

                </ul>

            </div>

            </a>

        <?php endforeach; ?>


        <script>
            function singupAlert() {

                alert("You must be logged in to view user info");

            }
        </script>