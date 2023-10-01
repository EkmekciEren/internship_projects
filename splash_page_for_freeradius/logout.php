<?php
session_start();

if (isset($_POST['logout'])) {
    // Oturumu sonlandır
    session_unset();
    session_destroy();

    // Kullanıcıyı çıkış sayfasına yönlendir
    header("Location: logout_page.php");
    exit();
}

// Kullanıcı adını oturumdan al
$user = $_SESSION['username'];

echo "Merhaba, $user! Çıkış yapmak için aşağıdaki düğmeye tıklayın.";

?>

<form method="post">
    <input type="submit" name="logout" value="Çıkış Yap">
</form>
