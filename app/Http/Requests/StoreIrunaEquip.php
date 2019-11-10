<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;
use App\Irunaitem;
use Illuminate\Contracts\Validation\Validator;

class StoreIrunaEquip extends FormRequest
{

    const Category = array('Swords', 'Bows', 'Claws', 'Throwing', 'Canes', 'Special', 'Additional', 'Armor');
    const Ability = array('gentleness', 'provoke', "magic", "mp cost", "intelligent", "strength", "agility", 
    "evasion", "fixed melee", "fixed magic", "rate cut", "melee defense", "magic defense", "dexterity", "critical",
    "attack", "quick cool", "quick use", "wind blessing", "earth blessing", "fire blessing", "water blessing", "striver");
    const Xtal = 'Crystas';
    const Null = "";
    const Type = array('Additional','Weapon', 'Special', 'Body');

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
                'name' => 'required',
                'atk' => 'required|max:400|integer|min:0',
                'def' => 'required|max:70|integer|min:0',
                'type' => 'required|alpha',
                'slot1' => 'required',
                'slot2' => 'required',
                'refinement' => 'required|integer|max:9|min:0',
                'price' => 'required|integer|min:0',
        ];
    }

    public function withValidator(Validator $validator){
        $validator->after(function($validator){
           $name = $this->request->get('name');
           $ability = $this->reuqest->get('ability');
           $slot1 = $this->request->get('slot1');
           $slot2 = $this->request->get('slot2');
           $type = $this->request->get('type');

           if($this->invalidEquipName($name)){
            $validator->errors()->add('nameError', 'The name does not seem right');
            $validator->errors()->add('mainError', 'Please check your previous submission, something went wrong');
           }
           if($this->invalidAbility($ability)){
            $validator->error()->add('abilityError', 'The name does not seem right');
            $validator->error()->add('mainError', 'Please check your previous submission');
           }
           if ($this->invalidSlotXtal($slot1)){
            $validator->error()->add('slot1Error', 'The name does not seem right');
            $validator->error()->add('mainError', 'Please check your previous submission');
           }
           if ($this->invalidSlotXtal($slot2)){
            $validator->error()->add('slot2Error', 'The name does not seem right');
            $validator->error()->add('mainError', 'Please check your previous submission');
           }
           if ($this->invalidType($type)){
            $validator->error()->add('typeError', 'Something does not seem right');
            $validator->error()->add('mainError', 'Please check your previous submission');
           }
        });
    }

    public function invalidEquipName($name){
        $item = Irunaitem::where('name', $name)->first();
       if(in_array($item->category, StoreIrunaEquip::Category)){
            return false;
       } else{
           return true;
       }
    }

    public function invalidAbility($ability){
        if(in_array($ability, StoreIrunaEquip::Ability)){
            return false;
        } else{
            return true;
        }
    }

    public function invalidSlotXtal($xtal){
        $item = Irunaitem::where('name', $xtal)->first();
        if($item->category == StoreIrunaEquip::Xtal || $item->category == StoreIrunaEquip::Null){
            return false;
        } else{
            return true;
        }
    }

    public function invalidType($type){
        if(in_array($type, StoreIrunaEquip::Type) || $type == StoreIrunaEquip::Null || $type == NULL){
            return false;
        } else{
            return true;
        }
    }

}