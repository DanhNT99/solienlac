<?php

    function inMultiArray($element, array $array) {

        foreach($array as $key => $value){
            // foreach($value as $key => $item) {
            $bool = $element === $value;

                if($bool) return true;
    
                if(is_array($value)){
                    $bool = inMultiArray($element, $value);
                } else {
                    $bool = $element === $value;
                }
    
                if($bool) return true;
           
        }
        return $bool;
    }
    function inNumberArray($number, array $array, $idloaihocky) {
        
        foreach($array as $key => $value){
                $bool = false;
                if(is_array($value)){
                    if($value['id_loaihocky'] == $idloaihocky){
                        $bool = $value['Diem'] ? $value['Diem'] < $number : false;
                    }                 
                }
                if($bool) return true;
           
        }
        return $bool;
    }

    function deleteValueNullOfArray($array) {
        foreach($array as $key => $value) {
            if($value == NULL) unset($array[$key]);
        }
        return $array;
    }

?>