<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Ixudra\Curl\CurlService;

class RegistrationController extends Controller
{

    public function postRegister(Request $request, CurlService $curlService)
    {
        
        $response = $curlService->to('https://stg-api.secuna.io/api/v1/register')
                        ->withData([
                            'account_type' => $request->account_type,
                            'firstname' => $request->firstname,
                            'lastname' => $request->lastname,
                            'username' => $request->username,
                            'email' => $request->email,
                            'password' => $request->password,
                            'password_confirmation' => $request->password_confirmation,
                            'agree_tac' => 1,
                        ])
                        ->withHeader('x-api-key: VplI/8G]Bz5Go+mCjzZh1')
                        ->post();

        if ($response->success === true) {
            return response()->json([
                'message' => 'Registration successful'
            ]);
        } else if ($response->success === false) {
            return response()->json([
                'message' => 'Registration error'
            ]);
        }
    }
}
