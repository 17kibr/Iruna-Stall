<?php

namespace App\Http\Controllers;

use App\User;
use App\Ai;
use Illuminate\Http\Request;
use App\Equipment;
use App\Items;
use Auth;

class AccountController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * 
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('account');
    }

    public function getUserId($id){
        $user = User::where('user_id', $id)->firstOrFail();
        
        return view('user', compact('user'));
    }
    
    public function view(){
        $aiitem = Ai::where('owner_id', Auth::user()->user_id)->get();
        $equipitem = Equipment::where('owner_id', Auth::user()->user_id)->get();
        $item = Items::where('owner_id', Auth::user()->user_id)->get();
        return view('viewitem', compact('aiitem', 'equipitem', 'item'));
    }

    public function show(){
        return view('accsettings');
    }
}
