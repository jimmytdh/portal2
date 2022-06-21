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
        $match = array(
            'fname' => ucwords(strtolower($req->fname)),
            'lname' => ucwords(strtolower($req->lname)),
        );
        $data = array(
            'mname' => ucwords(strtolower($req->mname)),
            'designation' => $req->designation,
            'division' => $req->division,
            'section' => $req->section,
            'username' => $req->username,
            'password' => bcrypt($req->password),
            'user_priv' => 0,
            'status' => 1,
        );

        $user_id = 0;
        $ifExist = User::where($match)->first();
        if($ifExist){
            $user_id = $ifExist->id;
        }
        $check = User::where('username',$req->username)
            ->where('id','<>',$user_id)
            ->first();
        if($check)
            return redirect('register')->with('duplicate',[
                'username' => $req->username,
                'fname' => $req->fname,
                'mname' => $req->mname,
                'lname' => $req->lname
            ]);
        User::updateOrCreate($match,$data);
        return redirect('register')->with('status','saved');
    }
}
