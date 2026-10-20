<?php

namespace Tests\Feature;

use App\Models\Department;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DepartmentPagesTest extends TestCase
{
    use RefreshDatabase;

    public function test_department_index_shows_create_edit_and_delete_actions(): void
    {
        $department = Department::create(['name' => 'Operasional']);

        Employee::create([
            'department_id' => $department->id,
            'name' => 'Budi Santoso',
            'position' => 'Staf',
            'salary' => 5000000,
            'joined_at' => '2025-01-15',
        ]);

        $response = $this->actingAs(User::factory()->create())
            ->get(route('departments.index'));

        $response->assertOk()
            ->assertSee('Data Departemen')
            ->assertSee('Operasional')
            ->assertSee('1 pegawai')
            ->assertSee(route('departments.create'), false)
            ->assertSee(route('departments.edit', $department), false)
            ->assertSee(route('departments.destroy', $department), false);
    }

    public function test_department_forms_and_crud_routes_work(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->get(route('departments.create'))
            ->assertOk()
            ->assertSee('name="name"', false);

        $this->post(route('departments.store'), ['name' => 'Operasional'])
            ->assertRedirect(route('departments.index'));

        $department = Department::firstOrFail();

        $this->get(route('departments.edit', $department))
            ->assertOk()
            ->assertSee('name="name"', false);

        $this->put(route('departments.update', $department), ['name' => 'Keuangan'])
            ->assertRedirect(route('departments.index'));

        $this->assertDatabaseHas('departments', [
            'id' => $department->id,
            'name' => 'Keuangan',
        ]);

        $this->delete(route('departments.destroy', $department))
            ->assertRedirect(route('departments.index'));

        $this->assertDatabaseMissing('departments', ['id' => $department->id]);
    }
}
