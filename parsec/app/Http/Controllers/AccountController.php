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
//        if ($user->resumes()->exists()) {
//            $resume = $user->resumes()->orderBy('created_at', 'DESC')->get()[0];
//        }
//
//        if ($info->major()->exists()) {
//            $major = $info->major()->get()[0];
//        }
//
//        if ($info->faculty()->exists()) {
//            $faculty = $info->faculty()->get()[0];
//        }
//
//        if ($user->projects()->exists())
//            $projects = $user->projects()->get()->all();
//
//        if ($user->replies()->exists())
//            $data['replies'] = $user->replies()->get();

        $data['info'] = $info?  $info->toArray(): null ;
//        $data['major'] = $major?  $major->toArray(): null;
//        $data['faculty'] = $faculty?  $faculty->toArray(): null;
//        $data['resume'] = $resume?  $resume->toArray(): null;
//        $data['projects'] = $projects?  $projects->toArray(): null;

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
}
