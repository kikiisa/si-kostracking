<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Maping extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    public function categori()
    {
        return $this->belongsTo(WisataCategory::class,'bahari_id');
    }
}
