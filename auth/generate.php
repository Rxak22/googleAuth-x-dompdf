<?php

require_once '../vendor/autoload.php';
session_start();

use Dompdf\Dompdf;
use Dompdf\Options;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$client = new Google\Client();

$clientID = $_ENV['GOOGLE_CLIENT_ID'];
$clientSecret = $_ENV['GOOGLE_CLIENT_SECRET'];
$client->setClientId($clientID);
$client->setClientSecret($clientSecret);
$client->setRedirectUri('http://localhost/googleAuth-with-dompdf/auth/generate.php');

$name = 'No name';
$email = 'No email';
if (isset($_GET['code'])){
    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
    $client->setAccessToken($token['access_token']);
    
    $oauth = new Google\Service\Oauth2($client);
    $userinfo = $oauth->userinfo->get();

    $name = $userinfo->name;
    $email = $userinfo->email;
} else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
} else
    exit('Login failed');

$options = new Options();
$options->setCHroot(__DIR__);

$dompdf = new Dompdf($options);

$dompdf->setPaper('A4', 'portrait');

$html = file_get_contents('template.html');
$html = str_replace(['{{name}}', '{{email}}'], [$name, $email], $html);

$dompdf->loadHtml($html);
// $dompdf->loadHtmlFile('template.html');

$dompdf->render();

$dompdf->addInfo('Title', 'PDF Generated');

// $dompdf->stream('pdf_generated.pdf', ['Attachment' => false]);

$output = $dompdf->output();
file_put_contents('credentials.pdf', $output);

$_SESSION['user'] = [
    'name' => $name,
    'email' => $email
];
header('location: ../index.php');
exit();