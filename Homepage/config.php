<?php

session_start();

require_once 'vendor/autoload.php';

$google_client = new Google_Client();

$google_client->setClientId('133613878638-8mff2l4a6k3kar445cvffke0sthujvvs.apps.googleusercontent.com');
$google_client->setClientSecret('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');
$google_client->setRedirectUri('http://localhost:8080/PDT/log-sign.php');
$google_client->addScope('email');
$google_client->addScope('profile');

?>