<?php

namespace App\Http\Controllers;

use App\Models\Reply;
use Illuminate\Http\Request;
use Inertia\Inertia;


class ReplyController extends Controller
{
    public function sendReply(Request $request, $project)
    {

        $data = $request->all();
        $reply = Reply::create($data);

        return redirect()->route('project.view', $data['project_id']);
    }

    public function acceptReply(Request $request, $id){
        $reply = Reply::find($id);
        $reply->status= 2;
        $reply->save();

        dd($request);

    }
    public function declineReply(Request $request){
        $reply = Reply::find($request['reply']);
        $reply->status= -1;
        $reply->save();

        return redirect(route('view.project', $request['project']));
    }

    public function viewReply(Request $request, $id)
    {
        $reply = Reply::findOrFail($id);
        $author = $reply->user()->get()->first();
        $project = $reply->project()->get()->first();

        return Inertia::render('Reply/View/Employer',[
            "reply"=>$reply,
            "author"=>$author,
            "project"=>$project,
        ]);
    }
}
