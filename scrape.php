<?php

use Symfony\Component\DomCrawler\Crawler;

require __DIR__ . '/vendor/autoload.php';

$client = new GuzzleHttp\Client(['verify' => false]);
$response = $client->get('sexylosers.com/?');
$html = $response->getBody()->getContents();
$crawler = new Crawler($html);
// latest link
$link = $crawler->filter('header.entry-header > h2.entry-title > a.entry-title-link')->attr('href');
var_dump($link);
$numberOfComics = 10;
for ($i = 0; $i < $numberOfComics; $i++) {
    $picClient = new GuzzleHttp\Client(['verify' => false]);
    $picResponse = $picClient->get($link);
    $picHtml = $picResponse->getBody()->getContents();
    $picCrawler = new Crawler($picHtml);
    $pic = $picCrawler->filter('div.entry-content > p > a')->attr('href');
    var_dump($pic);
//  previous link
    $link = $picCrawler->filter('div.pagination-previous > a')->attr('href');
    var_dump($link);
}