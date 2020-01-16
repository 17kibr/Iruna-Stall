<?php
namespace App\Traits;

trait ItemName{


    /**
     * format the name
     * 
     * @param string $name
     * @param string $symbol optional
     * 
     * @return string
     */
    public function formatName($name, $symbol = null){
        if($symbol !== null){
            return $this->convertSymbol($name, $symbol);
        }
        else{
            return str_replace(['Of'], ['of'],ucwords($name));
        }
        
    }

    private function convertSymbol($name, $symbol){
        if(substr($name, 0, 3) != $symbol){
            
            
            $itemName = preg_replace_callback('/\b(?=[LXIVCDM]+\b)([a-z]+)\b/i', 
            function($matches) {
                return strtoupper($matches[0]);
            }, str_replace(['Of'], ['of'], ucwords(strtolower(request('name')))));
            return $symbol.$itemName;

        }else{
             return $name;
        }
    }
    
}
?>