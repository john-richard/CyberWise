<?php

namespace Tests\Unit\Admin;

use Tests\TestCase;
use App\Http\Controllers\Admin\UserController;
use App\Services\UserService;
use Mockery;

class UserControllerTest extends TestCase
{
    public function testIndexReturnsUserList()
    {
        $expected = [
            [
                'id' => 1,
                'name' => 'John Doe',
                'email' => 'john@example.com',
            ],
            [
                'id' => 2,
                'name' => 'Jane Smith',
                'email' => 'jane@example.com',
            ],
        ];
    
        $this->userServiceMock
            ->expects('getAllUsers')
            ->andReturn($expected);
    
        $response = $this->controller->index();
    
        $this->assertEquals($expected, $response->getData(true));
    }

    public function testStoreCreatesNewUser()
    {
        $request = new \Illuminate\Http\Request([
            'name' => 'New User',
            'email' => 'newuser@example.com',
            'password' => 'password123',
        ]);

        $this->userServiceMock
            ->expects('create')
            ->with($request->all())
            ->andReturn([
                'id' => 1,
                'name' => 'New User',
                'email' => 'newuser@example.com',
            ]);

        $response = $this->controller->store($request);

        $this->assertEquals(201, $response->status());
    }

    public function testTheApplicationReturnsASuccessfulResponse()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }


}
