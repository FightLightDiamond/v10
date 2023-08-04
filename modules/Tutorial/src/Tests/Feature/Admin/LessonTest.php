<?php
/**
 * Created by cuongpm/modularization.
 * Author: Fight Light Diamond i.am.m.cuong@gmail.com
 * MIT: 2e566161fd6039c38070de2ac4e4eadd8024a825
 */

namespace Tutorial\Tests\Feature\Admin;


use Cuongpm\Modularization\MultiInheritance\TestTrait;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LessonTest extends TestCase
{
    use TestTrait;



    public function setAuth()
    {
        $this->setUsername(config('modularization.test.admin_account.username'));
        $this->setPassword(config('modularization.test.admin_account.password'));
        $this->setProvider('admins');
    }

    private function getId()
    {
        return \Tutorial\Models\Lesson::value('id');
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testIndex()
    {
        $server = $this->getServer();
        $params = [

        ];

        $response = $this->call('GET', route('admin.services.index'), $params, [], [], $server);

        $response->assertStatus(200);
    }

    public function testStore()
    {
        $params = [ 'title' => rand(1, 9), 'intro' => rand(1, 9), 'content' => rand(1, 9), 'section_id' => rand(1, 9), 'views' => rand(1, 9), 'last_view' => rand(1, 9), 'created_by' => rand(1, 9), 'updated_by' => rand(1, 9), 'is_active' => rand(1, 9), 'no' => rand(1, 9),  ];
        $response = $this->post(route('admin.lessons.store'), $params, $this->getHeader());

        $response->assertStatus(201);
    }

    public function testShow()
    {
        $response = $this->get(route('admin.lessons.show', $this->getId()), $this->getHeader());

        $response->assertStatus(200);
    }

    public function testUpdate()
    {
        $params = [ 'title' => rand(1, 9), 'intro' => rand(1, 9), 'content' => rand(1, 9), 'section_id' => rand(1, 9), 'views' => rand(1, 9), 'last_view' => rand(1, 9), 'created_by' => rand(1, 9), 'updated_by' => rand(1, 9), 'is_active' => rand(1, 9), 'no' => rand(1, 9),  ];
        $response = $this->put(route('admin.lessons.update', $this->getId()), $params, $this->getHeader());

        $response->assertStatus(200);
    }

    public function testDestroy()
    {
        $response = $this->delete(route('admin.lessons.destroy', $this->getId()), [], $this->getHeader());

        $response->assertStatus(200);
    }
}
