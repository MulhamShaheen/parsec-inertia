<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Info extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'lastname',
        'firstname',
        'middlename',
        'birthdate',
        'phone',
        'gender',
        'faculty_id',
        'major_id',
    ];


    public function user(){
        return $this->belongsTo(User::class);
    }

    public function getUserAge(){
        return Carbon::parse($this->birthdate)->age;
    }

    public function faculty(){
        return $this->belongsTo(Faculty::class);
    }

    public function major(){
        return $this->belongsTo(Major::class);
    }
}
