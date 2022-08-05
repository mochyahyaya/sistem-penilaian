<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    use HasFactory;

    public $table = 'penilaian'; 

    public $guarded = [''];

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
