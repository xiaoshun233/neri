<?php
function base64_to_blob($base64Str)
{
    $base64Str = str_replace(' ', '+', $base64Str);
    if ($index = strpos($base64Str, 'base64,', 0)) {
        $blobStr = substr($base64Str, $index + 7);
        $typestr = substr($base64Str, 0, $index);
        preg_match("/^data:(.*);$/", $typestr, $arr);
        return ['blob' => base64_decode($blobStr), 'type' => $arr[1]];
    }
    return false;
}
