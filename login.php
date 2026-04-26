<?php

$email = $_POST["email"] ?? "";
$password = $_POST["password"] ?? "";

// SABİT KULLANICI 
$correctEmail = "b251210028@sakarya.edu.tr";
$correctPassword = "b251210028";

// BOŞ KONTROL
if ($email == "" || $password == "") {
    header("Location: login.html");
    exit();
}

// DOĞRULAMA
if ($email == $correctEmail && $password == $correctPassword) {

    echo "
    <!DOCTYPE html>
    <html lang='tr'>
    <head>
        <meta charset='UTF-8'>
        <title>Hoşgeldiniz</title>
        <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css' rel='stylesheet'>
    </head>

    <body class='d-flex justify-content-center align-items-center vh-100'>

        <div class='text-center'>
            <h1 class='text-success'>Hoşgeldiniz</h1>
            <h3>$password</h3>

            <a href='index.html' class='btn btn-primary mt-3'>Ana Sayfa</a>
        </div>

    </body>
    </html>
    ";

} else {

    header("Location: login.html");
    exit();
}

?>