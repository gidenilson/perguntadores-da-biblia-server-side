<?php
namespace App\Controllers;



use Slim\Http\Request;
use Slim\Http\Response;
use App\Models\Owner;

class OwnerController
{
    public function getOne(Request $request, Response $response, $args) {
        
        $owner = Owner::find($args['id']);
        return $response->withJson($owner, 201);
        
    }
    
    public function getAll(Request $request, Response $response){
        $owners = Owner::all();
        return $response->withJson($owners, 201);
    }
    
    public function create(Request $request, Response $response){
        $owner = new Owner();
        $data = $request->getParsedBody();
        $owner->name = $data['name'];
        $owner->userID = $data['userID'];

        $owner->save();
        
        return $response->withStatus(200);
        
    }
}

