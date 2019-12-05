<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;
use App\Irunaitem;
use Illuminate\Contracts\Validation\Validator;

class StoreIrunaRelic extends FormRequest
{

    const Category = 'RelicCrystas';
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
            'quantity' => 'required|integer|min:1|max:9999',
            'price' => 'required|numeric|min:1|max:999999999999'
        ];
    }
    public function withValidator(Validator $validator){
        $validator->after(function($validator){
            $relic = $this->request->get('name');
            if($this->invalidRelicName($relic)){
                $validator->errors()->add('nameError', 'The name does not seem right');
                $validator->errors()->add('mainError', 'Please check your previous submission, something went wrong');
            }

            if($this->doNotHaveContactLink()){
                $validator->errors()->add('nameError', 'Please check your spelling again');
                $validator->errors()->add('mainError', 'You do not have contact link, go to /account to edit your contact information');
            }
            
        });
    }


    public function doNotHaveContactLink(){
        if((auth()->user()->facebook == null or auth()->user()->facebook == "") and (auth()->user()->discord == null or auth()->user()->discord == "" )){
            return true;
        } else{
            return false;
        }
    }


    public function invalidRelicName($relic){
        if(substr($relic, 0, 3) != '□'){
            $relic = '□'.$relic;
        }
        $item = Irunaitem::where('name', $relic)->first();
        if($item){
            if($item->category == StoreIrunaRelic::Category){
                return false;
            } else{
                return true;
            }
        }else{
            return true;
        }
        }
        
}
