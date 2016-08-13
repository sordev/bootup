<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class PaymentContoller extends Controller
{
    //
    public function reward(Request $request){
        $id = $request->get('reward_id');
        $qty = $request->get('reward_qty');
    }
    
    public function donation(Request $request){
        
    }
}
