<?php
namespace App\Controllers;

use Slim\Http\Request;
use Slim\Http\Response;
use App\Models\Where;
use Illuminate\Database\Capsule\Manager as DB;

class WhereController
{

    public function getOne(Request $request, Response $response, $args)
    {
        $where = Where::find($args['id']);
        return $response->withJson($where, 201);
    }

    public function getAll(Request $request, Response $response)
    {
        $wheres = Where::all();
        return $response->withJson($wheres);
    }

    public function WhereLetters(Request $request, Response $response)
    {
        $letters = $this->getLetters();
        $letterWheres = [];
        $wheres = [];

        foreach ($letters as $letter) {
            $wheres = [];
            foreach (DB::table('wheres')->where('letter', '=', $letter->letter)->get() as $where) {
                $wheres[] = [
                    'id' => $where->id,
                    'name' => $where->name
                ];
            }
            $letterWheres[] = [
                'letter' => $letter->letter,
                'wheres' => $wheres
            ];
        }
        return $response->withJson($letterWheres);
    }

    private function getLetters()
    {
        $letters = DB::table('wheres')->groupBy('letter')->get([
            'letter'
        ]);
        return $letters;
    }
    
    public function populateLetter() {
       $wheres = Where::all(['name', 'letter', 'id']);
       foreach ($wheres as $where){
           $where->letter = $this->tirarAcentos(strtolower(substr($where->name, 0,1 )));
           $where->save();
       }
       
    }
    private function tirarAcentos($string){
        return preg_replace(array("/(á|à|ã|â|ä)/","/(Á|À|Ã|Â|Ä)/","/(é|è|ê|ë)/","/(É|È|Ê|Ë)/","/(í|ì|î|ï)/","/(Í|Ì|Î|Ï)/","/(ó|ò|õ|ô|ö)/","/(Ó|Ò|Õ|Ô|Ö)/","/(ú|ù|û|ü)/","/(Ú|Ù|Û|Ü)/","/(ñ)/","/(Ñ)/"),explode(" ","a A e E i I o O u U n N"),$string);
    }
}

