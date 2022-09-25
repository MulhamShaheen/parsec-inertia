<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faculty extends Model
{
    use HasFactory;

    protected $fillable = [
        'info_id',
        'name',
        'code',
        'icon',
        'description',
    ];

    public function info()
    {
        return $this->belongsToMany(Info::Class);
    }

    public function majors(){
        return $this->hasMany(Major::Class);
    }

}
