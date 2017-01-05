<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\IndiaReads\Repository\Eloquent\PinCodeRepository;

class PinController extends ApiController
{
    
    protected $pinCodeRepository;

    function __construct(PinCodeRepository $pinCodeRepository) {
        $this->pinCodeRepository = $pinCodeRepository;
    }

    public function checkPinCode(Request $request)
    {
        $pin_code = $request->input('pin_code');
        $pin_codes_array = $this->pinCodeRepository->findWhere(array('pincode' => intval($pin_code)))->getData();
        if(count($pin_codes_array)>0){
            return $this->respond($pin_codes_array[0]);
        }
        return $this->respond(array('message' => 'fail'));
    }
}
