<?php
namespace App\Controllers;



use Slim\Http\Request;
use Slim\Http\Response;
use App\Models\Verse;

class VerseController
{
    public function getOne(Request $request, Response $response, $args) {
        
        $verse = Verse::find($args['id']);
        return $response->withHeader('Access-Control-Allow-Origin', '*')->withJson($verse, 200);
        
    }
    
    public function getAll(Request $request, Response $response){
        $verses = Verse::all();
        return $response->withHeader('Access-Control-Allow-Origin', '*')->withJson($verses);
    }
    
    public function getText(Request $request, Response $response, $args){
        
        $verse = Verse::where('b', $args['b'])
        ->where('c', $args['c'])
        ->where('v', $args['v'])
        ->get(['id', 't', 'v'])->first();
        return $response->withHeader('Access-Control-Allow-Origin', '*')->withJson($verse);
        
    }
    
}

