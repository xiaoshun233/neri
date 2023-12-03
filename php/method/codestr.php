<?php
function codestr(){
    $result = "";
    for ($i=0; $i < 6; $i++) { 
        $result .= rand(1,9);
    }
    return $result;
}
?>