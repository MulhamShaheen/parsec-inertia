<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'projects';
    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'description',
        'employer_id',
        'director',
        'icon',
        'status'
    ];

    public function users()
    {
        return $this->belongsToMany(User::Class, 'project_user', 'project_id', 'user_id');
    }

    public function employer()
    {
        return $this->belongsTo(Employer::class);
    }

    public function replies(){
        return $this->hasMany(Reply::class);
    }
}
