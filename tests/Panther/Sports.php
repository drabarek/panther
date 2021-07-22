<?php

use Symfony\Component\Panther\Client;

include getcwd() . '/vendor/autoload.php';

$client = Client::createChromeClient(null,
    ['headless','no-sandbox','disable-dev-shm-usage'],
    ['capabilities' => ['acceptInsecureCerts' => true], 'port' => 4551]
);
$client->wait(180);
$client->request('GET', 'https://develop.sb.dev.praetorian.technology');

$crawler = $client->waitFor('#site_name');
echo $crawler->filter('#site_name')->text();

$client->executeScript("document.querySelector('.MuiIconButton-label').click()");
sleep(10);
$crawler = $client->waitFor('#game-nav-football');
$client->executeScript("document.querySelector('#game-nav-football').click()");
sleep(10);
//$form = $crawler->selectButton('LOGIN')->form([
//    'email' => 'marcin@praetorian.technology',
//    'password' => ''
//]);
//$crawler = $client->submit($form);

$client->takeScreenshot('sports.png');