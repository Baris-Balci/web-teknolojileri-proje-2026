<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Güvenli veri alma (XSS koruma)
    function temizle($veri) {
        return htmlspecialchars(trim($veri));
    }

    $name = temizle($_POST["name"] ?? "");
    $email = temizle($_POST["email"] ?? "");
    $phone = temizle($_POST["phone"] ?? "");
    $subject = temizle($_POST["subject"] ?? "");
    $message = temizle($_POST["message"] ?? "");
    $contactType = temizle($_POST["contactType"] ?? "");
    $agree = $_POST["agree"] ?? "";

    echo "<!DOCTYPE html>
    <html lang='tr'>
    <head>
        <meta charset='UTF-8'>
        <title>Form Sonucu</title>
        <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css' rel='stylesheet'>
        <link rel='stylesheet' href='css/style.css'>
    </head>

    <body class='bg-dark text-light'>";

    echo "<div class='container mt-5'>";
    echo "<div class='box'>";

    echo "<h2 class='mb-4 text-info'>📩 Gönderilen Form Bilgileri</h2>";

    // BOŞ KONTROL
    if ($name == "" || $email == "" || $phone == "" || $subject == "" || $message == "") {
        echo "<div class='alert alert-danger'>❌ Lütfen tüm alanları doldurun!</div>";
        echo "<a href='iletisim.html' class='btn btn-light mt-3'>Geri Dön</a>";
        exit;
    }

    // EMAIL KONTROL
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<div class='alert alert-danger'>❌ Geçersiz email formatı!</div>";
        echo "<a href='iletisim.html' class='btn btn-light mt-3'>Geri Dön</a>";
        exit;
    }

    // TELEFON
    if (!preg_match('/^[0-9]+$/', $phone)) {
        echo "<div class='alert alert-danger'>❌ Telefon sadece rakam olmalıdır!</div>";
        echo "<a href='iletisim.html' class='btn btn-light mt-3'>Geri Dön</a>";
        exit;
    }

    // RADIO
    if ($contactType == "") {
        echo "<div class='alert alert-danger'>❌ İletişim tercihi seçilmedi!</div>";
        echo "<a href='iletisim.html' class='btn btn-light mt-3'>Geri Dön</a>";
        exit;
    }

    // CHECKBOX
    if (!$agree) {
        echo "<div class='alert alert-danger'>❌ KVKK onayı gerekli!</div>";
        echo "<a href='iletisim.html' class='btn btn-light mt-3'>Geri Dön</a>";
        exit;
    }

    // BAŞARILI
    echo "<div class='alert alert-success'>✅ Form başarıyla gönderildi!</div>";

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
    header("Location: iletisim.html");
    exit;
}
?>