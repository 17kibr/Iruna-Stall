<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ai;
use App\Equipment;
use App\Items;
use App\Relic;
use App\Xtal;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        if($request->isMethod('GET')){
            $input = $request->get('search');
            if(strlen($input) <= 3 && strlen($input) >= 1){
                return redirect()->back()->withErrors(['searcherror' => trans('Please provide more details')]);
            }else{
                $alSearch = Ai::where('name', 'LIKE', "%{$input}%")->paginate(10, ['*'], 'alPage');
                $equipSearch = Equipment::where('name', 'LIKE', "%{$input}%")->orWhere('ability', 'LIKE', "%{$input}%")->paginate(10, ['*'], 'equipPage');
                $itemSearch = Items::where('name', 'LIKE', "%{$input}%")->paginate(10, ['*'], 'itemPage');
                $xtalSearch = Xtal::where('name', 'LIKE', "%{$input}%")->paginate(10, ['*'], 'xtalPage');
                $relicSearch = Relic::where('name', 'LIKE', "%{$input}%")->paginate(10, ['*'], 'relicPage');

                return view('search', compact('alSearch', 'equipSearch', 'itemSearch', 'xtalSearch', 'input', 'relicSearch'));
            }
            
        }
        else{
            abort(404);
        }
    }
}
