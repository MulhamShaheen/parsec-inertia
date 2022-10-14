<?php

namespace App\Http\Controllers;

use App\Models\Reply;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Project;
use Inertia\Inertia;

class ProjectController extends Controller
{
    public function create(array $data)
    {
        return Project::create([
            'title' => $data['title'],
            'employer_id' => $data['employer_id'],
            'director' => $data['director'],
            'description' => $data['description'],
            'icon' => isset($data['icon']) ? time() . $data['icon']->getClientOriginalName() : "default.jpg",
        ]);
    }

    public function viewProject(Request $request, int $id)
    {
        $user = Auth::user();
        $role = $user->role == 1 ? "Employer" : "Activist";

        $data = [];

        $project = Project::find($id);
        $employer = $project->employer()->get()[0];

        $data['project'] = $project;
        $data['employer'] = $employer;
        $icon = $employer->user()->get()[0]->prof_picture;
        $data['employer']['icon'] = $icon;

        $employer->icon = $icon;

        if ($employer->id == $user->info()->get()[0]->id) {
            $role = "Author";
            $replies = $project->replies()->get()->all();
            foreach ($replies as $reply){
                $reply->project_icon = $project->icon;
                $user = $reply->user()->get()[0];
                $info = $user->info()->get()->first();
                $reply->user = $info->lastname . " " . $info->firstname . " " . $info->middlename ;
                $reply->user_icon = $user->prof_picture;

            }
            return Inertia::render('Projects/View/' . $role, [
                "project" => $project,
                "employer" => $employer,
                "replies" => $replies,
            ]);
        }



//        if($user->isEmployer()){
//            $data['replies'] = $project->replies()->get();
//        }
//        return view('projects.view',compact('id','data'));

        return Inertia::render('Projects/View/' . $role, [
            "project" => $project,
            "employer" => $employer,
        ]);
    }

    public function validateNewProject(Request $request)
    {

        $request->validate([
            'title' => 'required',
            'icon' => 'mimes:jpg,jpeg,png|max:2048',
        ]);

        $user = Auth::user();
        $data = $request->all();
        $data['employer_id'] = $user->aboutEmployer()->get()[0]->id;
        $project = $this->create($data);


        if ($request->hasFile('icon')) {
            $file = $request->file('icon');
            $filename = $data['icon'];
            $file->storeAs('/', $filename, 'public_projects');
        }
        $project->save();


//        dd($project);
//        dd(Auth::user()->projects()->get()->last());
        return redirect('account');
    }

    public function editProject(Request $request, $id)
    {
        $project = Project::find($id);
        return view('projects.edit', compact('project'));
    }

    public function updateProject(Request $request, int $id)
    {
        $project = Project::find($id);
        $request->validate([
            'title' => 'required',
            'icon' => 'mimes:jpg,jpeg,png|max:2048',
        ]);
        $data = $request->all();

        if ($request->hasFile('icon')) {
            $file = $request->file('icon');
            $filename = $data['icon'];
            $file->storeAs('/', $filename, 'public_projects');
        }

        $project->update($data);
        $project->save();

//        dd($data);

        return redirect(route('view.project', $id));
    }

    public function deleteProject(Request $request, $id)
    {
        $project = Project::find($id);
        return view('projects.delete', compact('project'));
    }

    public function removeProject(Request $request, $id)
    {
        $project = Project::find($id);
        $project->delete();

        return redirect('account');
    }

    public function replyToProject(Request $request, $id)
    {
        $project = Project::find($id);

        return view('projects.reply', compact('project'));
    }

    public function saveReplyToProject(Request $request, $id)
    {

        $data = $request->all();
        $data['user_id'] = Auth::user()->id;
        $data['project_id'] = $id;

        $reply = Reply::create($data);
        $reply->save();

        return redirect('account');
    }

    public function createProject(Request $request)
    {
        $info = Auth::user()->info()->get()->first();
        return Inertia::render('Projects/Create', [
            "employer_id" => $info->id,
        ]);
    }

    public function submitProject(Request $request)
    {
        $request->validate([
            'title' => 'required',
//            'icon' => 'mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->all();
        $project = $this->create($data);


        if ($request->hasFile('icon')) {
            $file = $request->file('icon');
            $filename = $data['icon'];
            $file->storeAs('/', $filename, 'public_projects');
        }
        $project->save();

        return redirect()->route('account');
    }

    public function listProjects(Request $request)
    {
        $projects = Project::whereIn('status', [0, 1, 2])->get();
        return Inertia::render('Projects/List', [
            "projects" => $projects
        ]);
    }

    public function joinProject(Request $request)
    {
        return Inertia::render('Projects/Join');
    }
}
