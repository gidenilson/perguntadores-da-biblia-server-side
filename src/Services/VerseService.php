<?php

namespace App\Services;

Class VerseService {

    public function getSqlFile(){
        return file("../storage/verses.sql");
    }

}