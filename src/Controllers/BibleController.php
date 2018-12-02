<?php
namespace App\Controllers;



use Slim\Http\Request;
use Slim\Http\Response;
use App\Models\Book;
use App\Services\BibleService;
use Illuminate\Database\Capsule\Manager as DB;


class BibleController
{
    private $bs;
    
    public function __construct(){
        $this->bs = new BibleService();
    }
    
    public function search(Request $request, Response $response, $args){
        
        return $response->withHeader('Access-Control-Allow-Origin', '*')->withJson($this->bs->search($args['type'], $args['id']));
    }
    
    public function mount(Request $request, Response $response) {
        
        $bible = [];
        $books = Book::all();
        
        foreach($books as $book){
          
           $chapters = $this->chapters($book);
           $verses = $this->verses($book, $chapters);          

           $bible[] = ['id'=>$book->id,
                       'name' => $book->name, 
                       'abb'=>$book->abbreviation, 
                       'chapters-number' => $chapters, 
                       'chapters'=>$verses];           
        }
        return $response->withHeader('Access-Control-Allow-Origin', '*')->withJson($bible);        
    }
    
    private function chapters($book){
        $chapters = DB::table('verses')
        ->select(DB::raw('count(*) as chapters'))
        ->where('b', $book->id)
        ->groupBy('c')
        ->get();
        
        return $chapters->count(); 
    }
    
    private function verses($book, $chapters){
        $verses = [];
        for($i = 1; $i <= $chapters; $i++){       
                   
            $verses[] = DB::table('verses')
                            ->whereColumn([['c', '=', $i],['b', '=', $book->id]])
                            ->orderByDesc('id')
                            ->first(['v'])->v;
        }
        return $verses;
    }

}
