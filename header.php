
<?php include 'src/Base.php';
$login = new Base\register_connexion();
?>

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="styles/style.css">
</head>

<header>
    <div class="container">
        <h1 class="title">TO DO LIST</h1>
        <?php if (isset($_SESSION['id'])) { ?>
        <nav class="nav">
            <h5 class="text-white"><a class="lien" href="disconnect.php">Déconnexion</a></h5>
          <?php  } ?>
        </nav>
    </div>
</header>
