<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Str;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class SearchTest extends TestCase
{
    use DatabaseTransactions;

    #[Test]
    public function search_screen_can_be_rendered(): void
    {
        $response = $this->get('/recherche');

        $response->assertOk();
    }

    #[Test]
    public function search_can_be_triggered(): void
    {
        $name = \App\Models\Name::factory()->create();

        $response = $this->post('/recherche', ['term' => $name->name]);

        $response->assertOk();
        $response->assertSee($name->name);
    }

    #[Test]
    public function name_can_be_found(): void
    {
        $names = \App\Models\Name::factory(10)->create();

        $response = $this->post('/recherche', ['term' => Str::substr($names[0]->name, 0, 3)]);

        $response->assertOk();
        $response->assertSee($names[0]->name);
    }

    #[Test]
    public function search_not_valid_on_one_letter(): void
    {
        $name = \App\Models\Name::factory()->create();

        $response = $this->post('/recherche', ['term' => $name->name[0]]);

        $response->assertInvalid(['term']);
        $response->assertRedirect();
    }
}
