<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Ixudra\Curl\CurlService;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CurlService $curlService)
    {
        $response = $curlService->to('https://stg-api.secuna.io/api/v1/organizations/members/roles')
        ->withData([
            'role_uuid'   => $request->role_uuid,
            'member_uuid' => $request->member_uuid,
        ])
        ->withHeader('x-api-key: VplI/8G]Bz5Go+mCjzZh1')
        ->put();

        if ($response->success === true) {
            return response()->json([
            'message' => 'Role changed'
            ]);
        } else if ($response->success === false) {
            return response()->json([
            'message' => 'Role update error'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
