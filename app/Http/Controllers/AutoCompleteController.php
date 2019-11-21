<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Irunaitem;
use App\Ability;
use App\Http\Requests\StoreIrunaEquip;

class AutoCompleteController extends Controller
{
    public function search(Request $request){
        $search = $request->get('term');
        $result = Irunaitem::where('name', 'LIKE',  '%'. $search. '%')->get();
        return response()->json($result);
    }

    public function searchAbility(Request $request){
        $search = $request->get('term');
        $result = Ability::where('type', 'LIKE', '%'.$search.'%')->get();
        return response()->json($result);
    }

    public function searchEquip(Request $request){
        $search = $request->get('term');
        $result = Irunaitem::whereIn('category', StoreIrunaEquip::Category)
            ->where('name', 'LIKE', '%'.$search.'%')->get();
        return response()->json($result);
    }
}
