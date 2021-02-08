<?php

namespace App\Http\Controllers;

use App\Models\Designation;
use App\Models\Division;
use App\Models\Section;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $user = User::count();
        $section = Section::count();
        $division = Division::count();
        $system = DB::table('user_priv')
                    ->select(DB::raw('count(*) as total'))
                    ->groupBy('syscode')
                    ->get();

        $system = count($system);
        return view('home',compact('user','section','division','system'));
    }

    public function contact(Request $req)
    {
        return 0;
    }

    public function register()
    {
        $designation = Designation::orderBy('description','asc')->get();
        $division = Division::orderBy('description','asc')->get();
        return view('register',compact('designation','division'));
    }

    public function sections($id)
    {
        $list = Section::where('division',$id)
            ->orderBy('description','asc')
            ->get();
        return $list;
    }

    function save(Request $req)
    {
        $data = array(
            'fname' => strtoupper($req->fname),
            'mname' => strtoupper($req->mname),
            'lname' => strtoupper($req->lname),
            'designation' => $req->designation,
            'division' => $req->division,
            'section' => $req->section,
            'username' => $req->username,
            'password' => bcrypt($req->password),
            'user_priv' => 0,
            'status' => 1,
        );

        $check = User::where('username',$req->username)->first();

        if($check)
            return redirect('register')->with('duplicate',[
                'username' => $req->username,
                'fname' => $req->fname,
                'mname' => $req->mname,
                'lname' => $req->lname
            ]);
        User::create($data);
        return redirect('register')->with('status','saved');
    }
}
