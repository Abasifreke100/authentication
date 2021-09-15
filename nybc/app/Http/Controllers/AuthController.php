<?php

namespace App\Http\Controllers;

// use auth;
use App\Models\User;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    protected $studentModel;
    
    public function __construct(Student $student)
    {
        $this->studentModel = $student;
    }
    
    public function login(Request $request){

        $this->validate($request, [
            "email"=>"required",
            "password"=>"required"
        ]);
 
        $credentials = $request->only(["email","password"]);

        $token = Auth::attempt($credentials);

        
        if (!$token){
            return response()->json("Invalid Email or Password",422);
        }
 
        $user = User::where("email", $credentials['email'])->first();

        return [
            "user" => $user,
            "token" => $token
        ];
    }


    public function logout(){
        auth()->logout();
        return response()->json("User successfully logout");
    }

    public function addAdmin(Request $request){
        $this->validate($request,[
            "name"=>"required",
            "user_name"=>"required",
            "email"=>"required",
            "password"=>"required"
        ]);

        $user = User::create([
            "name"=>$request->name,
            "user_name"=>$request->user_name,
            "email"=>$request->email,
            "password"=>bcrypt($request->password)
        ]);

        return response()->json([
            "status"=>"success",
            "user"=>$user
        ]);
    }

    public function addStudent(Request $request)
    {
        $this->validate($request,[
            "full_name"=>"required",
            "phone"=>"required",
            "state"=>"required",
            "gender"=>"required",
            "amount"=>"required",
            "user_id"=>"required"
        ]);

        $user = auth()->user();

        $student = Student::create([
            "full_name"=>$request->full_name,
            "phone"=>$request->phone,
            "state"=>$request->state,
            "gender"=>$request->gender,
            "amount"=>$request->amount,
            "user_id"=>$user->id
        ]);

        return response()->json([
            "status"=>200,
            "student"=>$student
        ]);
        
    }

    public function listAllStudent($data){

        $query = $this->studentModel;

        if (!empty($data['full_name'])) {
            $query = $query->ofFullName($data['full_name']);
        }

        return $query->orderBy("created_at","ASC")->paginate(10);

    }

    public function myStudent($data){

        $query = $this->studentModel->ofUser();

        if (!empty($data['full_name'])) {
            $query = $query->ofFullName($data['full_name']);
        }

        return $query->orderBy("created_at","ASC")->paginate(10);
    }

}
