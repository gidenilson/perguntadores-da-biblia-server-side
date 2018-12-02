<?php

namespace App\Controllers;

use App\Database\Database;
use App\Models\Verse;
use App\Services\VerseService;



class HomeController
{
    public function home()
    {
        $pdo = new \PDO("sqlite:../storage/bible.sqlite");
        $service = new VerseService();
        $verses = $service->getSqlFile();

        foreach ($verses as $verse){
            $pdo->query($verse);
            echo $verse . PHP_EOL;
        }


    }
}