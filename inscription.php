<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
            integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
            crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
            integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
            crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="styles/style.css">
    <title>Inscription</title>
</head>
<body>
<?php include 'header.php' ?>
<main>
    <div class="container">
    <form action="action.php" method="post" id="form" class="form form-ajax">
        <div class="form-co">
            <h2 class="text">INSCRIPTION</h2>
            <label for="login">Login :</label>
            <input type="text" id="login" name="login" class="input-form">
        </div>
        <div class="form-co">
            <label for="password">Mot de passe :</label>
            <input type="password" id="password" name="password" class="input-form">
        </div>
        <div class="form-co">
            <label for="confpassword">Confirmer mot de passe :</label>
            <input type="password" id="confpassword" name="confpassword" class="input-form">
        </div>
        <div class="error"></div>
        <input type="hidden" id="inscription" value="inscription" name="type" class="input-form">
        <button class="btn-form type="submit">Envoyer</button>
    </form>
    </div>
</main>
</body>
</html>
<script src="script.js"></script>
