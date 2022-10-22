<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'prof_picture',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function resumes()
    {
        return $this->hasOne(Resume::class);
    }
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
    public function boards()
    {
        return $this->hasMany(Board::class);
    }
    public function accesses()
    {
        return $this->hasMany(Access::class);
    }

    public function tokenCreator(){
        $rights = [];
        foreach ($this->accesses as $access){
            $output[] = 'board-'.$access->board->id;
        }
        return $this->createToken('local_token',$rights)->plainTextToken;
    }

    public function isAdmin()
    {
        return $this->role == 0;
    }

    public function isEmployer()
    {
        return $this->role == 1;
    }

    public function aboutEmployer()
    {
        if($this->role == 1){
            return $this->hasOne(Employer::class,'user_id','id');
        }
        return false;
    }

    public function projects()
    {
        if($this->role == 2) {
            return $this->belongsToMany(Project::class, 'project_user', 'user_id', 'project_id');
        }
        else if ($this->role == 1){
            $employer = $this->aboutEmployer()->get()[0];
            return $employer->projects();
        }
    }

    public function info(){
        if($this->role == 1){
            return $this->aboutEmployer();
        }
        return $this->hasOne(Info::class,'user_id','id');
    }

    public function replies(){
        if($this->role == 1){
            $projects = $this->projects()->get()->all();
            $replies = [];
            foreach ($projects as $project){
                $replies += $project->replies()->get()->all();
            }
            return $replies;
        }
        return $this->hasMany(Reply::class);
    }
}
