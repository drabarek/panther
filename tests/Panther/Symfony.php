<?php

use Symfony\Component\Panther\Client;

include getcwd() . '/vendor/autoload.php';

$client = Client::createChromeClient(null,
    ['headless','no-sandbox','disable-dev-shm-usage'],
    ['capabilities' => ['acceptInsecureCerts' => true], 'port' => 4442]
);

$client->request('GET', 'https://symfony.com');

$crawler = $client->waitFor('.sr-only');
$client->clickLink('About');

$client->takeScreenshot('symfony.png');