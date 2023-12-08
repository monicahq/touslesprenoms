<?php

namespace Tests\Unit\Models;

use App\Models\Level;
use App\Models\Organization;
use App\Models\Role;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class OrganizationTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function it_has_many_roles(): void
    {
        $organization = Organization::factory()->create();
        Role::factory()->create(['organization_id' => $organization->id]);

        $this->assertTrue($organization->roles()->exists());
    }

    /** @test */
    public function it_has_many_levels(): void
    {
        $organization = Organization::factory()->create();
        Level::factory()->create(['organization_id' => $organization->id]);

        $this->assertTrue($organization->levels()->exists());
    }
}
