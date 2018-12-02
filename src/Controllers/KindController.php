<?php
namespace App\Controllers;



use Slim\Http\Request;
use Slim\Http\Response;
use App\Models\Kind;

class KindController
{
    public function getOne(Request $request, Response $response, $args) {
        
        $kind = Kind::find($args['id']);
        return $response->withJson($kind, 201);
        
    }
    
    public function getAll(Request $request, Response $response){
        $kinds = Kind::all();
        return $response->withJson($kinds);
    }
}