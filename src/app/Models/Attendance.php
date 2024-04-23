<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'work_start',
        'work_finish',
    ];

    public function userID(){
        return $this->belongsTo(User::class);
    }

    
}
