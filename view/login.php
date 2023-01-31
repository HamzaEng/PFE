<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
@$errors = $_SESSION['loginErrors'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" type="image/x-icon" href="../imgaes/student.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" />
    <title>Login</title>
    <style>
        <?php include_once '../CSS/style.css'; ?>
    </style>
</head>

<body>
    <!-- NAVIGATION && HEADER -->
    <?php
    include_once('includes/header.html');
    include_once('includes/navigation.html');
    ?>
    </div><!-- cette balise fermé est de navigation cela permet d'ignore le lien au desus pour certain pages-->
    <!-- HOME -->

    <section class="login" id="main">
        <form action="../App/Controllers/login.ctrl.php" method="POST" class="login__form">
            <figure class="login__icon"> <img src="../imgaes/utilisateur.png"></figure>
            <div class="formulaire__item">
                <label class="login__label">login</label><br>
                <input class="admin__input" type="text" name="username" id="username" placeholder="username"><br>
                <span class="login__message">! <?php echo @$errors['username']; ?></span>
            </div>
            <div class="formulaire__item">
                <label class="login__label">password</label><br>
                <input class="admin__input" type="password" name="password" id="password" placeholder="mot de passe "><br>
                <span class="login__message">! <?php echo @$errors['password'] ?></span>
            </div>
            <div class="formulaire__item">
                <span class="login__message"><?php echo @$errors['message'] ?></span>
            </div>
            <div class="formulaire__item ">
                <input type="submit" name="login" value="login" id="seConnect">
            </div>
        </form>
    </section>
    <script type="text/javascript">
        <?php include("../JS/login.js") ?>
    </script>
    <script type="text/javascript">
        <?php include("../JS/man.js") ?>
    </script>
</body>

</html>