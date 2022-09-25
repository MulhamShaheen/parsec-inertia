<?php

namespace App\Http\Controllers;

use App\Models\Reply;
use Illuminate\Http\Request;

class ReplyController extends Controller
{
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
}
