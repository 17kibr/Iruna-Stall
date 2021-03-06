<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Irunaitem;
use App\Ability;
use App\Http\Requests\StoreIrunaEquip;
use App\Equipment;

class AutoCompleteController extends Controller
{
    const Material = array('Chests', 'Collectibles', 'Strenthening', 'Recovery',
     'Status', 'Teleport', 'Ores', 'IslandItems');
    /**
     * 
     * Global search
     */
    public function __construct()
    {
       
    }
    public function search(Request $request){
        $search = $request->get('term');
        $result = Irunaitem::where('name', 'LIKE',  '%'. $search. '%')->get();
        return response()->json($result);
    }

    /**
     * seach ability type
     */
    public function searchAbility(Request $request){
        $search = $request->get('term');
        $result = Ability::where('type', 'LIKE', '%'.$search.'%')->get();
        return response()->json($result);
    }

    /**
     * Search equipment type
     */
    public function searchEquip(Request $request){
        $search = $request->get('term');
        $result = Irunaitem::whereIn('category', StoreIrunaEquip::Category)
            ->where('name', 'LIKE', '%'.$search.'%')->get();
        return response()->json($result);
    }

    /**
     * 
     * search al crystas
     */
    public function searchAL(Request $request){
        $search = $request->get('term');
        $result = Irunaitem::where('category', 'AlCrystas')
                ->where('name', 'LIKE', '%'.$search.'%')
                ->get();
        return response()->json($result);
    }

    /**
     * 
     * search common material
     */

    public function searchMaterial(Request $request){
        $search = $request->get('term');
        $result = Irunaitem::whereIn('category', AutoCompleteController::Material)
            ->where('name', 'LIKE', '%'.$search.'%')->get();
        return response()->json($result);

    }

    /**
     * 
     * search crystas
     */
    public function searchCrystas(Request $request){
        $search = $request->get('term');
        $result = Irunaitem::where('category', 'Crystas')
                ->where('name', 'LIKE', '%'.$search.'%')
                ->get();
        return response()->json($result);
    }

    /**
     * 
     * search relic
     */
    public function searchRelic(Request $request){
        $search = $request->get('term');
        $result = Irunaitem::where('category', 'RelicCrystas')
                ->where('name', 'LIKE', '%'.$search.'%')
                ->get();
        return response()->json($result);
    }




}
