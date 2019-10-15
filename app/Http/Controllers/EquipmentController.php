<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Equipment;
use RealRashid\SweetAlert\Facades\Alert;

class EquipmentController extends Controller
{
    public function update($id){
        
        if(Auth::check()){
            $item = Equipment::where('item_id', $id);
            if($item->owner_id != Auth::user()->id){
                abort(403);
            }
            else{
                $item->price = request('price');
                $item->atk = request('atk');
                $item->def = request('def');
                $item->slots = request('slots');
                $item->slots1 = request('slot1');
                $item->slot2 = request('slot2');
                $item->ability = request('ability');
                $item->ability_level = request('ability_level');
                $item->refinement = request('refinement');
                $item->save();
                Alert::toast('successfully edited an item', 'success');
                return redirect('/viewitem');

            }
        }
    }
    public function delete($id){
        if(Auth::check()){
            $item = Equipment::where('item_id', $id)->firstOrFail();
            if($item->owner_id != Auth::user()->id){
                abort(403);
            }
            else{
                Equipment::where('item_id', $id)->firstOrFail()->delete();
                //$item = Ai::where('owner_id', auth()->id())->get();
                Alert::toast('You have deleted an item', 'warning');
                return redirect('/viewitem');
            }
        }
    }
    
}