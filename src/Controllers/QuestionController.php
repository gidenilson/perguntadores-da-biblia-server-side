<?php
namespace App\Controllers;



use Slim\Http\Request;
use Slim\Http\Response;
use App\Models\Question;

class QuestionController
{
    public function getOne(Request $request, Response $response, $args) {
        
        $question = Question::find($args['id']);
        return $response->withJson($question, 201);
        
    }
    
    public function getAll(Request $request, Response $response){
        $questions = Question::all();
        return $response->withJson($questions);
    }
    
    public function create(Request $request, Response $response){
        $question = new Question();
        $data = $request->getParsedBody();        
        $question->entity = $data['entity'];
        $question->kind = $data['kind'];
        $question->verse = $data['verse'];
        $question->text = $data['text'];
        $question->owner = $data['owner'];
        $question->save();        
        
        return $response->withJson($question)->withHeader("Access-Control-Allow-Origin", "*");
        
        
    }
}

