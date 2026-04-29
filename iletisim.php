<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Güvenli veri alma
    function temizle($veri) {
        return htmlspecialchars(trim($veri));
    }

    $name = temizle($_POST["name"] ?? "");
    $email = temizle($_POST["email"] ?? "");
    $phone = temizle($_POST["phone"] ?? "");
    $subject = temizle($_POST["subject"] ?? "");
    $message = temizle($_POST["message"] ?? "");
    $contactType = temizle($_POST["contactType"] ?? "");
    $age = temizle($_POST["age"] ?? "");
    $date = temizle($_POST["date"] ?? "");
    $city = temizle($_POST["city"] ?? "");
    $range = temizle($_POST["range"] ?? "");
    $interests = $_POST["interest"] ?? [];

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

    // ======================
    // BOŞ KONTROL
    // ======================
    if ($name == "" || $email == "" || $phone == "" || $subject == "" || $message == "" || $age == "" || $date == "") {
        echo "<div class='alert alert-danger'>❌ Lütfen tüm alanları doldurun!</div>";
        echo "<a href='iletisim.html' class='btn btn-light mt-3'>Geri Dön</a>";
        exit;
    }

    // ======================
    // EMAIL
    // ======================
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<div class='alert alert-danger'>❌ Geçersiz email formatı!</div>";
        echo "<a href='iletisim.html' class='btn btn-light mt-3'>Geri Dön</a>";
        exit;
    }

    // ======================
    // TELEFON (05xxxxxxxxx)
    // ======================
    if (!preg_match('/^05[0-9]{9}$/', $phone)) {
        echo "<div class='alert alert-danger'>❌ Telefon 05 ile başlamalı ve 11 haneli olmalı!</div>";
        echo "<a href='iletisim.html' class='btn btn-light mt-3'>Geri Dön</a>";
        exit;
    }

    // ======================
    // YAŞ
    // ======================
    if ($age < 0 || $age > 120) {
        echo "<div class='alert alert-danger'>❌ Yaş 0-120 arasında olmalı!</div>";
        echo "<a href='iletisim.html' class='btn btn-light mt-3'>Geri Dön</a>";
        exit;
    }

    // ======================
    // RADIO
    // ======================
    if ($contactType == "") {
        echo "<div class='alert alert-danger'>❌ İletişim tercihi seçilmedi!</div>";
        echo "<a href='iletisim.html' class='btn btn-light mt-3'>Geri Dön</a>";
        exit;
    }

    // ======================
    // KVKK
    // ======================
    if (!$agree) {
        echo "<div class='alert alert-danger'>❌ KVKK onayı gerekli!</div>";
        echo "<a href='iletisim.html' class='btn btn-light mt-3'>Geri Dön</a>";
        exit;
    }

    // ======================
    // INTEREST ARRAY
    // ======================
    $interestText = "";
    if (!empty($interests)) {
        $interestText = implode(", ", array_map("temizle", $interests));
    } else {
        $interestText = "Seçilmedi";
    }

    // ======================
    // BAŞARILI
    // ======================
    echo "<div class='alert alert-success'>✅ Form başarıyla gönderildi!</div>";

    echo "<ul class='list-group'>";

    echo "<li class='list-group-item'><b>Ad Soyad:</b> $name</li>";
    echo "<li class='list-group-item'><b>Email:</b> $email</li>";
    echo "<li class='list-group-item'><b>Telefon:</b> $phone</li>";
    echo "<li class='list-group-item'><b>Yaş:</b> $age</li>";
    echo "<li class='list-group-item'><b>Tarih:</b> $date</li>";
    echo "<li class='list-group-item'><b>Konu:</b> $subject</li>";
    echo "<li class='list-group-item'><b>İletişim Türü:</b> $contactType</li>";
    echo "<li class='list-group-item'><b>Şehir:</b> $city</li>";
    echo "<li class='list-group-item'><b>Memnuniyet:</b> $range</li>";
    echo "<li class='list-group-item'><b>İlgi Alanları:</b> $interestText</li>";
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