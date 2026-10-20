<?php

namespace Tests\Feature;

use App\Models\Department;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EmployeePagesTest extends TestCase
{
    use RefreshDatabase;

    public function test_employee_index_shows_create_edit_and_delete_actions(): void
    {
        $department = Department::create(['name' => 'Operasional']);
        $employee = Employee::create([
            'department_id' => $department->id,
            'name' => 'Budi Santoso',
            'position' => 'Staf',
            'salary' => 5000000,
            'joined_at' => '2025-01-15',
        ]);

        $response = $this->actingAs(User::factory()->create())
            ->get(route('employees.index'));

        $response->assertOk()
            ->assertSee('Tambah Pegawai')
            ->assertSee(route('employees.create'), false)
            ->assertSee(route('employees.edit', $employee), false)
            ->assertSee(route('employees.destroy', $employee), false)
            ->assertSee('name="_method" value="DELETE"', false);
    }

    public function test_employee_forms_include_the_controller_fields_and_crud_routes_work(): void
    {
        $department = Department::create(['name' => 'Operasional']);
        $user = User::factory()->create();

        $this->actingAs($user)
            ->get(route('employees.create'))
            ->assertOk()
            ->assertSee('name="name"', false)
            ->assertSee('name="position"', false)
            ->assertSee('name="salary"', false)
            ->assertSee('name="joined_at"', false)
            ->assertSee('name="department_id"', false);

        $this->post(route('employees.store'), [
            'department_id' => $department->id,
            'name' => 'Budi Santoso',
            'position' => 'Staf',
            'salary' => 5000000,
            'joined_at' => '2025-01-15',
        ])->assertRedirect(route('employees.index'));

        $employee = Employee::firstOrFail();

        $this->get(route('employees.edit', $employee))
            ->assertOk()
            ->assertSee('name="name"', false)
            ->assertSee('name="position"', false)
            ->assertSee('name="salary"', false)
            ->assertSee('name="joined_at"', false)
            ->assertSee('name="department_id"', false);

        $this->put(route('employees.update', $employee), [
            'department_id' => $department->id,
            'name' => 'Budi Santoso Updated',
            'position' => 'Supervisor',
            'salary' => 6500000,
            'joined_at' => '2025-02-15',
        ])->assertRedirect(route('employees.index'));

        $this->assertDatabaseHas('employees', [
            'id' => $employee->id,
            'name' => 'Budi Santoso Updated',
            'position' => 'Supervisor',
        ]);

        $this->delete(route('employees.destroy', $employee))
            ->assertRedirect(route('employees.index'));

        $this->assertDatabaseMissing('employees', ['id' => $employee->id]);
    }
}
