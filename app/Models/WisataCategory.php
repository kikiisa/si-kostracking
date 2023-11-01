<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WisataCategory extends Model
{
    use HasFactory;
    protected $guarded = [
        'id'
    ];

    public function maping()
    {
        return $this->hasMany(Maping::class,"bahari_id");
    }
}
