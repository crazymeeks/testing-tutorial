<?php

namespace Tests\Feature\Controllers;

use Tests\TestCase;
use Mockery\MockInterface;
use Ixudra\Curl\CurlService;

class RoleControllerTest extends TestCase
{
    public function testShouldChangeRoleOfOrgUser() : void
    {
        $request = [
            "role_uuid"   => "60770f6e-3367-4849-b8c4-efeb2eb0ce13",
            "member_uuid" => "4aa59c49-b8df-4b64-9509-ce9560ff2356"
        ];

        $this->mock(CurlService::class, function (MockInterface $mock) use ($request) {
            $mock->shouldReceive('to')
                 ->with('https://stg-api.secuna.io/api/v1/organizations/members/roles')
                 ->andReturnSelf();
            $mock->shouldReceive('withData')
                 ->with($request)
                 ->andReturnSelf();
            $mock->shouldReceive('withHeader')
                 ->with('x-api-key: VplI/8G]Bz5Go+mCjzZh1')
                 ->andReturnSelf();
            $mock->shouldReceive('put')
                 ->andReturn(json_decode(json_encode([
                    'success' => true,
                    'message' => 'Role changed',
                    'type'    => null,
                    'data'    => []
                 ])));
        });

        $response = $this->json('PUT', route('api.v1.organizations.members.roles'), $request);

        $this->assertEquals('Role changed', $response->original['message']);
    }

    public function testShouldNotChangeRoleWhenApiRespondedWithError() : void
    {
        $request = [
            "role_uuid"   => "60770f6e-3367-4849-b8c4-efeb2eb0ce13",
            "member_uuid" => "4aa59c49-b8df-4b64-9509-ce9560ff2356"
        ];

        $this->mock(CurlService::class, function (MockInterface $mock) use ($request) {
            $mock->shouldReceive('to')
                 ->with('https://stg-api.secuna.io/api/v1/organizations/members/roles')
                 ->andReturnSelf();
            $mock->shouldReceive('withData')
                 ->with($request)
                 ->andReturnSelf();
            $mock->shouldReceive('withHeader')
                 ->with('x-api-key: VplI/8G]Bz5Go+mCjzZh1')
                 ->andReturnSelf();
            $mock->shouldReceive('put')
                 ->andReturn(json_decode(json_encode([
                    'success' => false,
                    'message' => 'Role update failed',
                    'type'    => null,
                    'data'    => []
                 ])));
        });

        $response = $this->json('PUT', route('api.v1.organizations.members.roles'), $request);

        $this->assertEquals('Role update error', $response->original['message']);
    }
}
