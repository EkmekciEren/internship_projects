<?php
ini_set('display_errors', 1);

// Kullanıcının IP adresini alın
$ipAddress = $_SERVER['REMOTE_ADDR'];

// Kullanıcının MAC adresini elde etmek için ilgili komutları ekleyin
$macCommand = "arp $ipAddress | awk '{print $3}'";
$macAddress = shell_exec($macCommand);
$macAddress = trim(str_replace('HWaddress', '', $macAddress));
$macAddress = str_replace(' ', '', $macAddress);

// Kısıtlamayı kaldırmak için MAC adresiyle birlikte bir iptables kuralı ekleyin

$iptablesCommand = "sudo iptables -D internet -t mangle -m mac --mac-source " . trim($macAddress) . " -j RETURN";
exec($iptablesCommand);

// Kısıtlamanın kaldırıldığına dair mesajı görüntüleyin
$message = "Oturum başarıyla sonlandırıldı. Internet erişiminiz kısıtlandı.";
$message .= "<br>Kısıtlama kaldırıldı. MAC adres: $macAddress, IP adres: $ipAddress";

// İşlem tamamlandıktan sonra login.php sayfasına yönlendirin
//header('Location: login.php');

// İşlem tamamlandıktan sonra mesajı göstermek için otomatik yönlendirmeyi önlemek için aşağıdaki kodu ekleyin
echo $message;
?>
<!DOCTYPE html>
<html>
<head>
    <title>Çıkış</title>
</head>
<body>
    <h1>Çıkış İşlemi</h1>

    <p><?php echo $message; ?></p>
</body>
</html>
