<?php

namespace Tests\Unit;

use App\Models\Role;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use App\Models\Task;
use Carbon\Carbon;

class ModelTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test that a user can be created.
     *
     * @return void
     */
    public function test_user_creation()
    {
        $user = User::factory()->create([
            'name' => 'John Doe',
            'email' => 'john@example.com',
        ]);

        $this->assertDatabaseHas('users', [
            'name' => 'John Doe',
            'email' => 'john@example.com',
        ]);
    }

    /**
     * Test that a task can be created.
     *
     * @return void
     */
    public function test_task_creation()
    {
        $user = User::factory()->create();
        $task = Task::factory()->create([
            'title' => 'Sample Task',
            'start_date' => Carbon::now(),
            'end_date' => Carbon::now()->addDays(7),
            'frequency' => 'weekly',
            'is_completed' => false,
        ]);

        $this->assertDatabaseHas('tasks', [
            'title' => 'Sample Task',
        ]);
    }

    public function test_user_role_assignment()
{
    $user = User::factory()->create();
    $role = Role::create(['name' => 'admin', 'slug' => 'admin']);
    $user->roles()->attach($role);

    $this->assertTrue($user->roles->contains('slug', 'admin'));
}

   
}

