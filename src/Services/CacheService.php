<?php
namespace App\Services;

class CacheService
{
    private $folder = "../storage/cache";
    private $ext = "cache";
    
    function __construct(){
        
    }
    
    public function save($key, $value){
        $filename = $this->folder . '/' . $key;
        if (!file_exists($filename)) {
            file_put_contents($filename, json_encode($value));
            return true;
        }else{
            return false;
        }
        
    }
    public function get($key) {
        $filename = $this->folder . '/' . $key;
        if(!file_exists($filename)){
            return false;
        }else{
            return json_decode(file_get_contents($filename));
            
        }
    }
    public function delete($key){
        
    }
}

