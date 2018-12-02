<?php
namespace App\Services;

use Illuminate\Database\Capsule\Manager as DB;

class BibleService
{

    /*
     * search
     */
    function search($type, $id)
    {
        $key = $type . $id;
        
        
        $cacheService = new CacheService();
        
        $cache = $cacheService->get($key);
        
                
        if ($cache) {
            
            return $cache;
            
        }

        // select table
        if ($type == 'p') {
            $table = 'personages';
        } else if ($type == 'w') {
            $table = 'wheres';
        }

        // get entity
        $entity = DB::table($table)->where('id', $id)->first();

        $verses = DB::table('verses')->leftJoin('books', 'books.id', '=', 'verses.b')
            ->where('t', 'like', "% {$entity->name} %")
            ->orWhere('t', 'like', "% {$entity->name}.%")
            ->orWhere('t', 'like', "% {$entity->name},%")
            //->orWhere('t', 'like', "%{$entity->name} %")
            ->get([
            'verses.id',
            'verses.b',
            'verses.c',
            'verses.v',
            'verses.t',
            'books.name',
            'books.abbreviation as abb'
        ]);

        $books = [];
        $data = [];
        $old = $verses->first();
        foreach ($verses as $verse) {
            if ($verse->b == $old->b) {
                $data[] = ['id'=>$verse->id, 'b'=>$verse->b, 'c'=>$verse->c, 'v'=>$verse->v, 't'=>$verse->t];
            } else if(count($data)){
                $books[] = [
                    'id' => $old->b,
                    'name' => $old->name,
                    'abb'=>$old->abb,
                    'verses' => $data
                ];
                $data = [];
                $old = $verse;
            }
        }
        $books[] = [
            'id' => $verse->b,
            'name' => $verse->name,
            'abb'=>$verse->abb,
            'verses' => [['id'=>$verse->id, 'b'=>$verse->b, 'c'=>$verse->c, 'v'=>$verse->v, 't'=>$verse->t]]
        ];

       
        
        $result =  ['entity'=>['id'=>$id, 'name'=>$entity->name, 'type'=>$type], 'books'=>$books];
        $cacheService->save($key, $result);
        return $result;
    }

 
}





