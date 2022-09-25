<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'replies';
    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';


    protected $fillable = [
        'project_id',
        'user_id',
        'message',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::Class, 'user_id');
    }

    public function project()
    {
        return $this->belongsTo(Project::Class, 'project_id');
    }

}
