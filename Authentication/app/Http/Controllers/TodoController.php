<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TodoController extends Controller
{

    public function post(Request $request)
    {
        $this->validate($request, [
            "name"=>"required",
            "title"=>"required",
            "description"=>"required",
        ]);

        $user = auth()->user();

        $todo = new Todo();
        $todo->name = $request->input('name');
        $todo->title = $request->input('title');
        $todo->description = $request->input('description');
        $todo->user_id = $user->id;
        $todo->save();

        return redirect(route('list'))->with('success', 'Task assigned successfully.');

    }

    public function list(){

        $todos = Todo::where("user_id", auth()->user()->id)->get();

        return view("dashboard", [
            "todos"=>$todos
        ]);

    }
}
