<?php

namespace App\Database;

use Illuminate\Database\Capsule\Manager as Capsule;
class Database {

    function __construct() {
        $capsule = new Capsule();
        $capsule->addConnection([
            'driver' => 'sqlite',
            'host' => '',
           'database' => '../storage/database/bible.sqlite',
            'username' => '',
            'password' => '',
            'charset' => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix' => '',
        ]);
        $capsule->setAsGlobal();
        $capsule->bootEloquent();
    }
}