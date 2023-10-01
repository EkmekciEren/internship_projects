<?php
ini_set('display_errors', 1);

/**
 * RADIUS client example using PAP password.
 */

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once '/var/www/html/Radius/autoload.php';

$server = (getenv('RADIUS_SERVER_ADDR')) ?: '127.0.0.1';
$secret = (getenv('RADIUS_SECRET')) ?: 'Azerty12';

$user = $_POST['username'] ?? '';
$pass = $_POST['password'] ?? '';
$result = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $radius = new \Dapphp\Radius\Radius();
    $radius->setServer($server)
           ->setSecret($secret)
           ->setNasIpAddress('192.168.89.55')
           ->setAttribute(32, 'vpn');

    echo "Sending access request to $server with username $user<br>";

    $response = $radius->accessRequest($user, $pass);

    if ($response === false) {
        $result = sprintf("Access-Request failed with error %d (%s).",
            $radius->getErrorCode(),
            $radius->getErrorMessage()
        );
    } else {
        $result = "Success! Received Access-Accept response from RADIUS server.";

        // Kullanıcıyı bilgilendiren bir mesaj ekle
        $result .= "<br>Hoş geldiniz, $user! Giriş başarılı.";
    }
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>Giriş Formu</title>
    <style>
        @import url('https://fonts.googleapis.com/css?family=Poppins&display=swap');
        * {
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif;
        }

        body {
            display: flex;
            height: 100vh;
            text-align: center;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            background-color: #421c77;
        }

        .login-form {
            position: relative;
            width: 370px;
            height: auto;
            background: rgba(255, 255, 255, 0.9);
            padding: 40px 35px 60px;
            box-sizing: border-box;
            border: 1px solid black;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        }

        .text {
            font-size: 30px;
            color: #421c77;
            font-weight: 600;
            letter-spacing: 2px;
            margin-bottom: 30px;
        }

        form {
            margin-top: 20px;
        }

        form .field {
            margin-bottom: 20px;
            display: flex;
            align-items: center;
        }

        .field .fas {
            height: 20px;
            width: 30px;
            color: #421c77;
            font-size: 20px;
            margin-right: 10px;
        }

        .field input,
        form button {
            height: 40px;
            width: 100%;
            outline: none;
            font-size: 16px;
            color: #421c77;
            padding: 0 15px;
            border-radius: 5px;
            border: 1px solid #421c77;
            caret-color: #421c77;
        }

        input:focus {
            color: #421c77;
            box-shadow: 0 0 5px rgba(66, 28, 119, 0.5);
            background: rgba(66, 28, 119, 0.1);
        }

        button {
            margin-top: 30px;
            background-color: #6f47bd;
            color: #fff;
            font-weight: 600;
            letter-spacing: 1px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #421c77;
        }

        .link {
            margin-top: 20px;
            color: #421c77;
        }

        .link a {
            color: #6f47bd;
            text-decoration: none;
        }

        .link a:hover {
            text-decoration: underline;
        }

        #background-container {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
        }

        #background-wave {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: linear-gradient(to right, #6f47bd, #421c77);
            background-repeat: no-repeat;
            background-size: 200% 200%;
            animation: waveAnimation 20s infinite;
        }

        @keyframes waveAnimation {
            0% {
                background-position: 0% 50%;
            }
            50% {
                background-position: 100% 50%;
            }
            100% {
                background-position: 0% 50%;
            }
        }
    </style>
</head>
<body>
    <div id="background-container">
        <div id="background-wave"></div>
    </div>

    <div class="login-form">
        <div class="text">
            LOGIN
        </div>
        <form action="login.php" method="post">
            <div class="field">
                <div class="fas fa-envelope"></div>
                <input type="text" id="username" name="username" placeholder="Email or Phone">
            </div>
            <div class="field">
                <div class="fas fa-lock"></div>
                <input type="password" id="password" name="password" placeholder="Password">
            </div>
            <button type="submit">LOGIN</button>
        </form>
    </div>
</body>
</html>
