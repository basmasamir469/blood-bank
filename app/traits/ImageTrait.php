<?php
namespace App\traits;

Trait ImageTrait{
public function storeImage($photo,$path){
    $file_extension=$photo->getClientOriginalExtension();
    // $file=time().".".$file_extension;
    $file = date('YmdHis') . "." . $file_extension;

    $photo->move($path,$file);
    return $file;
}
}
