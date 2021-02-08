<?php

namespace App\Http\Controllers;

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
}
