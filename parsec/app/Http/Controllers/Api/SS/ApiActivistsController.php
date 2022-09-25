<?php

namespace App\Http\Controllers\Api\SS;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Activist;

class ApiActivistsController extends Controller
{
    public function getAll(Request $request){
        return Activist::all();
    }
    public function getActivist(Request $request,$id){
        if(!$activist = Activist::find($id)){
            return response("Activist not found",404);
        }
        return response(Activist::find($id),200);
    }
    public function editActivist(Request $request,$id){
        if(!$activist = Activist::find($id)){
            return response("Activist not found",404);
        }
        $activist->name = $request->name ?? $activist->name;
        $activist->group = $request->group ?? $activist->group;
        $activist->save();

        return response($activist,200);
    }
    public function deleteActivist(Request $request,$id){
        if(!$activist = Activist::find($id)){
            return response("Activist not found",404);
        }
        $activist->delete();
        return response("deleted successfuly",200);
    }

    public function createActivist(Request $request){
        $data = $request->all();
        $activist = Activist::create([
            'name' => $data['name'],
            'group' => $data['group'],
        ]);
        if(!$activist){
            return response("Bad request",400);
        }
        return response($activist,200);
    }

}
