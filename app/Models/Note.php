<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;
    protected $guarded = [];

    // Udah bisa langsung di route api, ini coba aja
    // public function getRouteKeyName()
    // {
    //     return 'slug';
    // }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
}
