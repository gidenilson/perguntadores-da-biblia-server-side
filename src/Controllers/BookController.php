<?php
namespace App\Controllers;



use Slim\Http\Request;
use Slim\Http\Response;
use App\Models\Book;

class BookController
{
    public function getOne(Request $request, Response $response, $args) {
        
        $book = Book::find($args['id']);
        return $response->withJson($book, 201);
        
    }
    
    public function getAll(Request $request, Response $response){
        $books = Book::all();
        return $response->withJson($books);
    }
}

