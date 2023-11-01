<?php
namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class MyService
{
    protected $path = 'assets/image/';
    public function returnNameMultiple(array $arr) :string
    {
       $result = implode(',',$arr);
       return $result;
    }
    public function returnStringMerge(string $string) :array
    {
        $result = explode(",",$string);
        return $result;
    }
    public function removeMultipleImage(string $string)
    {
        foreach($this->returnStringMerge($string) as $img)
        {
            File::delete($this->path.$img);
        }

    }
}