<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Resume;
use Illuminate\Support\Facades\Auth;

class ResumesController extends Controller
{
    public function createResume(Request $request)
    {
        $data = $request->only(['title', 'description']);
        $resume = Resume::create([
            'title' => $data['title'],
            'description' => $data['description'],
            'user_id' => Auth::user()->id,
        ]);

        return redirect('account');
    }

//    public function viewResume(Request $request, $id){
//        return view('employees.resumes.view',compact('id'));
//    }

    public function viewEditResume(Request $request){
        return view('employees.resumes.edit');
    }


    public function editResume(Request $request, $id){

        $data = $request->only(['title', 'description']);
        $resume = Resume::find($id);
        $resume->title = $data['title'];
        $resume->description = $data['description'];
        $resume->save();
        return view('employees.resumes.edit',compact('id'));
    }
}
