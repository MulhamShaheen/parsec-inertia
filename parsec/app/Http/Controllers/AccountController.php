<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Faculty;
use App\Models\Info;
use App\Models\User;
use App\Models\Employer;
use Inertia\Inertia;


class AccountController extends Controller
{
    public function accountManager(Request $request)
    {
        $user = Auth::user();
        if ($user->isEmployer()) {
            $employer = $user->aboutEmployer()->get()[0];
            $projects = $user->projects()->get()->all();

            $data['info'] = $employer?  $employer->toArray(): null;
            $data['projects'] = $projects?  $projects: null;

            return Inertia::render('Auth/Account/Employer',[
                'info'=> $data
            ]);
        }

        $info = $user->info()->get()[0];
        $major = null;
        $faculty = null;
        $resume = null;
        $projects = [];
        $data = [];


        $data['info'] = $info?  $info->toArray(): null ;


        return Inertia::render('Auth/Account/Activist',[
            'info'=>$data
        ]);

    }
    public function viewProjects(Request $request){
        $user = Auth::user();
        $role = $user->role == 1? "Employer" : "Activist";
        $hasProjects = [];
        if($user->projects()->exists()){
            $projects = $user->projects()->get()->all();
            $hasProjects = $projects;
        }

        return Inertia::render('Auth/Account/Projects/'.$role,[
            "hasProjects" => $hasProjects,
        ]);
    }

    public function viewReplies(Request $request)
    {

        $user = Auth::user();
        $role = $user->role == 1? "Employer" : "Activist";
        $replies = [];

        if($role == "Activist" && $user->replies()->exists()){
            $replies = $user->replies()->get()->all();
        }
        else if($role == "Employer"){
            $replies = $user->replies();
        }
        foreach ($replies as $reply) {
            $user = $reply->user()->get()->first();
            $info = $user->info()->get()->first();
            $project = $reply->project()->get()->first();
            $reply->user = $info->lastname . " " . $info->firstname . " " . $info->middlename ;
            $reply->user_icon = $user->prof_picture;
            $reply->project_icon = $project->icon;
        }
        return Inertia::render('Auth/Account/Replies/'.$role,[
            "replies" => $replies,
        ]);
    }
}