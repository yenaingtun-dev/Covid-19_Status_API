<?php

namespace App\Http\Controllers;

use Goutte\Client;
use Illuminate\Http\Request;
use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\BrowserKit\HttpBrowser;


class ScrapingController extends Controller
{
    public function index()
    {
        $client = new Client();
        $page = $client->request('GET', 'https://www.worldometers.info/coronavirus/country/brazil/');
         $page->filter('#maincounter-wrap')->each(function ($item) {
            $this->results[$item->filter('h1')->text()] = $item->filter('.maincounter-number')->text();
        });
        $data = $this->results;
        return $data;
     }

    public function show($id)
    {
        $client = new Client();
        $page = $client->request('GET', 'https://www.worldometers.info/coronavirus/country/'.$id.'/' );
         $page->filter('#maincounter-wrap')->each(function ($item) {
            $this->results[$item->filter('h1')->text()] = $item->filter('.maincounter-number')->text();
        });
        $data = $this->results;
        return $data;
    }
}
