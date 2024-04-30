<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \DateTimeInterface;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'work_start',
        'work_finish',
    ];

    // serializeDate メソッドをオーバーライドしてタイムゾーンを設定
    // protected $dates = ['work_start', 'work_finish'];
    // protected function serializeDate(DateTimeInterface $date)
    // {
    //     $dateTime = new \DateTime($date->format('Y-m-d H:i:s'), new \DateTimeZone('UTC'));
    //     $dateTime->setTimezone(new \DateTimeZone('Asia/Tokyo'));
    //     return $dateTime->format('Y-m-d H:i:s');
    // }


    public function user(){
        return $this->belongsTo(User::class);
    }

    public function rests()
    {
        return $this->hasMany(Rest::class);
    }

    
}
