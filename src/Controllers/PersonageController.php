<?php
namespace App\Controllers;

use Slim\Http\Request;
use Slim\Http\Response;
use App\Models\Personage;
// use Illuminate\Support\Facades\DB;
use Illuminate\Database\Capsule\Manager as DB;

class PersonageController
{

    public function getOne(Request $request, Response $response, $args)
    {
        //print_r($this->db);
        $personage = Personage::find($args['id']);
        return $response->withHeader('Access-Control-Allow-Origin', '*')->withJson($personage, 201);
    }

    public function getAll(Request $request, Response $response)
    {
        $personages = Personage::all();
        return $response->withHeader('Access-Control-Allow-Origin', '*')->withJson($personages);
    }

    public function personageLetters(Request $request, Response $response)
    {
        $letter = $this->getLetters();
        $letterPersonages = [];
        $personages = [];

        foreach ($letter as $letter) {
            foreach (DB::table('personages')->where('letter', '=', $letter->letter)->get() as $personage) {
                $personages[] = [
                    'id' => $personage->id,
                    'name' => $personage->name
                ];
            }
            $letterPersonages[] = [
                'letter' => $letter->letter,
                'personages' => $personages
            ];
        }
        return $response->withHeader('Access-Control-Allow-Origin', '*')->withJson($letterPersonages);
    }

    private function getLetters()
    {
        $letters = DB::table('personages')->groupBy('letter')->get([
            'letter'
        ]);
        return $letters;
    }
}

