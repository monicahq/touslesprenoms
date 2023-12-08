<?php

namespace Tests\Unit\Traits;

use App\Models\Role;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class TranslatableTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function it_translates(): void
    {
        $role = Role::factory()->create([
            'label' => 'this is the real name',
            'label_translation_key' => 'role.label',
        ]);

        $this->assertEquals(
            'this is the real name',
            $role->label
        );

        $role = Role::factory()->create([
            'label' => null,
            'label_translation_key' => 'role.label',
        ]);

        $this->assertEquals(
            'role.label',
            $role->label
        );
    }
}
