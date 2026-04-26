<?php
// Form sadece POST ile geldiyse çalışsın
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Verileri al ve temizle
    $name = trim($_POST["name"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $phone = trim($_POST["phone"] ?? "");
    $subject = trim($_POST["subject"] ?? "");
    $message = trim($_POST["message"] ?? "");
    $contactType = $_POST["contactType"] ?? "";

    echo "<!DOCTYPE html>
    <html lang='tr'>
    <head>
        <meta charset='UTF-8'>
        <title>Form Sonucu</title>
        <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css' rel='stylesheet'>
    </head>
    <body class='bg-light'>";

    echo "<div class='container mt-5'>";
    echo "<div class='card shadow p-4'>";

    echo "<h2 class='mb-4 text-primary'>📩 Gönderilen Form Bilgileri</h2>";

    // Boş kontrol
    if ($name == "" || $email == "" || $phone == "" || $subject == "" || $message == "") {
        echo "<div class='alert alert-danger'>❌ Lütfen tüm alanları doldurun!</div>";
        exit;
    }

    // Email kontrol
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<div class='alert alert-danger'>❌ Geçersiz email formatı!</div>";
        exit;
    }

    // Telefon kontrol
    if (!preg_match('/^[0-9]+$/', $phone)) {
        echo "<div class='alert alert-danger'>❌ Telefon sadece rakam olmalıdır!</div>";
        exit;
    }

    echo "<ul class='list-group'>";

    echo "<li class='list-group-item'><b>Ad Soyad:</b> $name</li>";
    echo "<li class='list-group-item'><b>Email:</b> $email</li>";
    echo "<li class='list-group-item'><b>Telefon:</b> $phone</li>";
    echo "<li class='list-group-item'><b>Konu:</b> $subject</li>";
    echo "<li class='list-group-item'><b>İletişim Türü:</b> $contactType</li>";
    echo "<li class='list-group-item'><b>Mesaj:</b> $message</li>";

    echo "</ul>";

    echo "<a href='iletisim.html' class='btn btn-primary mt-3'>Geri Dön</a>";

    echo "</div></div>";

    echo "</body></html>";

} else {
    // direkt giriş yapılırsa
    header("Location: iletisim.html");
    exit;
}
?>