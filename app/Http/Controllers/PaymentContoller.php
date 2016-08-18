<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Payment;
use App\User;
use App\Reward;

class PaymentContoller extends Controller {

    //
    public function offer(Request $request) {
        $order_user_id = null;

        $v = Validator::make($request->all(), [
                    'project_id' => 'required|numeric',
        ]);
        
        if ($v->fails()) {
//            return redirect('post/create')
//                        ->withErrors($validator)
//                        ->withInput();
        }
        if ($request->has('fullname') && $request->has('email') && $request->has('phone') && empty($this->user->id)) {
            /*
             *  хэрэв fullname, email, phone 3 орж ирвэл хэрэглэгч шинээр бүртгэнэ
             */
            $user = new User;
            $user->fullname = $request->get('fullname');
            $user->email = $request->get('email');
            $user->phone = $request->get('phone');
            $user->register_ip = $_SERVER['REMOTE_ADDR'];
            $user->registered_with = 'local';
            $user->public = 0;
            $user->status = 1;
            $user->role = 2;
            $user->save();
            $order_user_id = $user->id;
            //user controller-оос авч хэрэглэх /яаж??/
            //$this->sendThankYouEmail($user);
        } else {
            /*
             *  хэрэглэгч нэвтэрсэн гэж ойлгоно
             */
            $order_user_id = $this->user->id;
        }

        $payment = new Payment;
        if ($request->has('reward_id') && $request->has('reward_qty')) {
            /*
             *  хэрэв reward_id, reward_qty 2 орж ирвэл reward авч байна гэж ойлно
             */
            $reward = Reward::find($request->get('reward_id'));
            $payment->reward_id = $reward->id;
            $payment->value = $reward * $request->get('reward_qty');
            $payment->gateway = 'reward';
        } else {
            /*
             *  хэрэв donation орж ирвэл хандив өгч байна гэж ойлно
             */
            $payment->value = $request->get('donation');
            $payment->gateway = 'donation';
        }

        $payment->project_id = $request->get('project_id');
        $payment->user_id = $order_user_id;
        $payment->note = $request->get('note');
        $payment->save();
        $result = $this->process_payment($payment);
        
        if(!$result){
            //харгалзах view дуудах
        }
    }

    public function process_payment($obj) {
        if ($curl = curl_init()) {
            $responseHandlerURI = 'payment/response'; //Банкнаас буцах хаяг
            $url = "https://epp.khanbank.com/payment/rest/register.do";
            $language = 'en';
            $currency = '496';
            $orderId = $obj->id;
            $desc = '';
            $amount = number_format($obj->value, 2, '', '');

            // new api
            $data = array(
                'amount' => $amount,
                'currency' => $currency,
                'language' => $language,
                'orderNumber' => $orderId,
                'userName' => env('KhanBankUname'),
                'password' => env('KhanBankUpass'),
                'returnUrl' => $responseHandlerURI,
                'failUrl' => $responseHandlerURI,
                'description' => $desc,
                'jsonParams' => '{"orderNumber":' . $orderId . '}'
            );

            curl_setopt($curl, CURLOPT_FAILONERROR, 1);
            curl_setopt($curl, CURLOPT_HEADER, 0);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 0);
            curl_setopt($curl, CURLOPT_ENCODING, "UTF-8");
            curl_setopt($curl, CURLOPT_AUTOREFERER, 1);
            $response = curl_exec($curl);
            curl_close($curl);
            $response = json_decode($response);
            // var_dump($response);
            if($response->errorCode ==0){
                header("Location: " . $response->formUrl);
                exit;
            }else{
                $obj->status = $response->errorCode;
                $obj->save();
                /*
                Алдааны код тайлбар
                0	No system error.
                1	Order with this number is already registered in the system.
                3	Unknown or forbidden currency.
                4	Mandatory request parameter was not specified.
                5	Erroneous value of a request parameter.
                7	System error.
                */
                return false;
            }
        } else {
            return false;
        }
    }

    public function response(Request $request) {
        $url = "https://epp.khanbank.com/payment/rest/getOrderStatus.do";

        $data = array('language' => 'en',
            'orderId' => $request->get('orderId'),
            'userName' => env('KhanBankUname'),
            'password' => env('KhanBankUpass'));

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_FAILONERROR, 0);
        curl_setopt($curl, CURLOPT_HEADER, 0);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 0);
        curl_setopt($curl, CURLOPT_ENCODING, "UTF-8");
        curl_setopt($curl, CURLOPT_AUTOREFERER, 1);
        $response = curl_exec($curl);
        curl_close($curl);

        $response = json_decode($response);
        $payment = Payment::find($request->get('orderId'));
        $payment->status = $response->orderStatus;
        $payment->save();
        /*
        Төлөвийн код тайлбар /Order Status/
        0	Order registered, but not paid off.
        1	Pre-authorisation of order amount was held (for two-stage payment)
        2	Order amount is fully authorized.
        3	Authorization canceled.
        4	Transaction was refunded.
        5	Initiated authorization using ACS of the issuer bank.
        6	Authorization declined.
         */
        
        if ($response->ErrorCode == 0) {
            if ($response->ErrorMessage == 'Success' && $response->orderStatus == 2) {
                //төлбөр амжилттай төлөгдлөө 
                $return_content = 'Таны төлбөр амжилттай төлөгдлөө';
                //мэйл илгээх гэх мэт үйлдэл
            } else {
                // энийг note рүү хийхиймүү яахын
                $return_content = $response->ErrorMessage;
            }
        } else {
            $return_content = 'Таны төлбөр хийгдсэнгүй! ' . $response->ErrorMessage;
            $payment = Payment::find($request->get('orderId'));
            $payment->status = $response->ErrorCode;
            $payment->save();
            /*
            Алдааны код тайлбар /Error code/
            0	No system error.
            2	The order is declined because of an error in the payment credentials.
            5	Erroneous value of a request parameter.
            6	Unregistered OrderId.
            */
        }
        //харгалзах view дуудах
        //$return_content;
    }

}
