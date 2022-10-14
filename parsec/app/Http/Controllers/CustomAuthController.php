<?php

namespace App\Http\Controllers;

use App\Models\Faculty;
use App\Models\Info;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Hash;
use Session;
use App\Models\User;
use App\Models\Employer;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;


class CustomAuthController extends Controller
{
    public function home()
    {
        if (Auth::check()) {
            return view('home');
        }
        return redirect('login')->withSucces('Sign in please.');
    }

    public function login()
    {
        return Inertia::render('Auth/Login');
    }

    public function loginSubmit(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials, $request['remember'] == 'on')) {

            return redirect()->intended('main')
                ->withSuccess('Signed in');
        }
//        dd($credentials);
        return redirect("login")->withError( "Аккаунт не найден");


    }

    public function register(Request $request)
    {
        return Inertia::render('Auth/Register');
    }

    public function registerSubmit(Request $request)
    {
        $data = $request->validate([
            'username' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        $user = $this->create($data);
        $user->save();
        Auth::login($user, true);

        if (!Auth::check()) {
            return Inertia::render('Auth/Register');
        }

        return redirect()->route('account.info', 'activist');

    }

    public function fillInfo(Request $request, $role = null)
    {

        $user = Auth::user();

        if(is_null($role)){
            if($user->role != 0){
                $role = $user->role == 1? "Employer" : "Activist";
                $info = $user->info()->get()->first();
//                return redirect()->route('account.info', $role);
                return Inertia::render('Auth/Account/Info/'.$role,[
                    'hasInfo' => $info ? $info->toArray() : false,
                ]);
            }
            return redirect()->route('homepage');
        }


        $info = $user->info()->get()->first();

        if($role == "activist"){
            return Inertia::render('Auth/Info/Activist', [
                'hasInfo' => $info ? $info->toArray() : false,
            ]);
        }

        else if($role == "employer"){
            return Inertia::render('Auth/Info/Employer', [
                'hasInfo' => $info ? $info->toArray() : false,
            ]);
        }


    }

    public function infoPersonalSubmit(Request $request)
    {
        if (Auth::check()) {
//            dd($request->all());
            $request->validate([
                'firstname' => 'required',
                'lastname' => 'required',
            ]);
            $data = $request->all();

            $user = Auth::user();
            $user->role = 2;
            $user->save();

            if ($user->info()->exists()) {
                $info = $user->info()->get()->first();
                $info->update($data);
//                dd($info);
            } else {
                $data['user_id'] = $user->id;
                $info = Info::create($data);
            }
//            dd($info);
            return redirect()->route('account.info', [
                "role" => 'activist',
            ]);

        }

    }

    public function infoEmployerSubmit(Request $request)
    {
        if (Auth::check()) {
//            dd($request->all());
            $request->validate([
                'title' => 'required',
                'description' => 'required',
            ]);
            $data = $request->all();

            $user = Auth::user();
            $user->role = 1;
            $user->save();
            if ($user->info()->exists()) {
                $info = $user->info()->get()->first();
                $info->update($data);
//                dd($info);
            } else {
                $data['user_id'] = $user->id;
                $info = Employer::create($data);
            }
//            dd($info);
            return redirect()->route('account.info', [
                'role' => 'employer',
            ]);

        }

    }

    public function infoSubmit(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);
    }

    public function registration()
    {
        $faculities = Faculty::all();
        return view('auth.register');
    }

    public function registrationEmployer()
    {
        return view('auth.employers.register');
    }

    public function customRegistration(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'prof_picture' => 'mimes:jpg,jpeg,png|max:2048',
        ]);
        $data = $request->all();
        $user = $this->create($data);

        if ($request->hasFile('prof_picture')) {
            $file = $request->file('prof_picture');
            $filename = $user->prof_picture;
            $file->storeAs('/', $filename, 'public_profiles');
        }
        $data['gender'] = true;
        $data['user_id'] = $user->id;
        $info = Info::create($data);
        $info->save();

//        dd($request);
        return ($this->customLogin($request));

    }

    public function employerRegistration(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'prof_picture' => 'mimes:jpg,jpeg,png|max:2048',
        ]);
        $data = $request->all();
        $user = $this->create($data);
        $employer = $this->createEmployer($data, $user);

        if ($request->hasFile('prof_picture')) {
            $file = $request->file('prof_picture');
            $filename = $user->prof_picture;
            $file->storeAs('/', $filename, 'public_profiles');
        }

        return ($this->customLogin($request));

    }

    public function customLogin(Request $request)
    {

        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials, $request['remember'] == 'on')) {
//            dd($credentials);
            return redirect()->intended('home')
                ->withSuccess('Signed in');
        }

        return redirect("login")->withSuccess('Login details are not valid');
    }

    public function create(array $data)
    {
        return User::create([
            'name' => $data['username'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'prof_picture' => isset($data['prof_picture']) ? time() . $data['prof_picture']->getClientOriginalName() : "default.jpg",
            'role' => $data['role'] ?? "0",
        ]);
    }

    public function createEmployer(array $data, User $user)
    {
        return Employer::create([
            'title' => $data['title'],
            'description' => $data['description'],
            'user_id' => $user->id,

        ]);
    }

    public function signOut()
    {
        Session::flush();
        Auth::logout();

        return Redirect('/');
    }

    public function userReturner()
    {
        if (Auth::check()) {
            return Auth::user();
        }
    }

    public function accountManager(Request $request)
    {
        $user = Auth::user();
        if ($user->isEmployer()) {
            $employer = $user->aboutEmployer()->get()[0];
            $projects = $user->projects()->get()->all();
            return view('accounts.employer', compact('user', 'employer', 'projects'));
        }

        $info = $user->info()->get()[0];
        $major = null;
        $faculty = null;
        $resume = null;
        $projects = [];
        $data = [];
        if ($user->resumes()->exists()) {
            $resume = $user->resumes()->orderBy('created_at', 'DESC')->get()[0];
        }

        if ($info->major()->exists()) {
            $major = $info->major()->get()[0];
        }

        if ($info->faculty()->exists()) {
            $faculty = $info->faculty()->get()[0];
        }

        if ($user->projects()->exists())
            $projects = $user->projects()->get()->all();

        if ($user->replies()->exists())
            $data['replies'] = $user->replies()->get();

        $data['info'] = $info;
        $data['major'] = $major;
        $data['faculty'] = $faculty;
        $data['resume'] = $resume;
        $data['projects'] = $projects;

        return Inertia::render('Auth/Account/Activist');

//        return view('accounts.activist', compact('user', 'data'));
    }

    public function updateProfPicture(Request $request)
    {
        if ($request->file('photo')) {
            $user = Auth::user();
            $now = time();
            $file = $request->file('photo');
            $filename = $now . $file->getClientOriginalName();
            $file->storeAs('/', $filename, 'public_profiles');

            $user->prof_picture = $now . $request['photo']->getClientOriginalName();

            $user->save();
        }
        return redirect()->route('account.info');
    }

    public function updateProfName(Request $request)
    {

        if ($request->name) {
            $user = Auth::user();

            $user->name = $request->name;

            $user->save();
        }
        return Redirect('account');
    }

}
