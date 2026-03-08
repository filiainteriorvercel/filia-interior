<?php

namespace Tests\Feature\ProjectManagement;

use App\Models\Project;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AutoProjectCodeTest extends TestCase
{
    use RefreshDatabase;

    public function test_owner_creating_a_project_gets_an_auto_generated_project_code(): void
    {
        $owner = User::factory()->create([
            'role' => 'owner',
        ]);

        $customer = User::factory()->create([
            'role' => 'customer',
            'phone' => '081234567890',
        ]);

        $response = $this->actingAs($owner)->post(route('dashboard.projects.store'), [
            'user_id' => $customer->id,
            'customer_name' => $customer->name,
            'customer_phone' => $customer->phone,
            'customer_email' => $customer->email,
            'deal_date' => now()->toDateString(),
            'status' => 'in_progress',
            'notes' => 'Project baru dari form admin.',
        ]);

        $project = Project::query()->firstOrFail()->fresh();

        $response->assertRedirect(route('dashboard.projects.show', $project, false));
        $this->assertSame('PRJ-0001', $project->project_code);
    }

    public function test_existing_manual_project_code_is_preserved_when_new_auto_code_is_generated(): void
    {
        $owner = User::factory()->create([
            'role' => 'owner',
        ]);

        $customer = User::factory()->create([
            'role' => 'customer',
            'phone' => '081234567890',
        ]);

        $legacyProject = Project::create([
            'project_code' => 'PRJ-0002',
            'user_id' => $customer->id,
            'customer_name' => $customer->name,
            'customer_phone' => $customer->phone,
            'customer_email' => $customer->email,
            'deal_date' => now()->toDateString(),
            'status' => 'in_progress',
            'notes' => 'Project lama dengan kode manual.',
        ]);

        $this->actingAs($owner)->post(route('dashboard.projects.store'), [
            'user_id' => $customer->id,
            'customer_name' => $customer->name,
            'customer_phone' => $customer->phone,
            'customer_email' => $customer->email,
            'deal_date' => now()->toDateString(),
            'status' => 'in_progress',
            'notes' => 'Project baru setelah data legacy.',
        ]);

        $newProject = Project::query()
            ->whereKeyNot($legacyProject->id)
            ->latest('id')
            ->firstOrFail()
            ->fresh();

        $this->assertSame('PRJ-0002', $legacyProject->fresh()->project_code);
        $this->assertSame('PRJ-0002-1', $newProject->project_code);
    }
}
