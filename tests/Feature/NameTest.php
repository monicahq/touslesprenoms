<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;
use Illuminate\Support\Str;

class NameTest extends TestCase
{
    use DatabaseTransactions;

    #[Test]
    public function name_screen_can_be_rendered(): void
    {
        $names = \App\Models\Name::factory(10)->create();

        $response = $this->get('/prenoms');

        $response->assertStatus(200);
        $response->assertSee($names[0]->name);
    }

    #[Test]
    public function name_letter_can_be_rendered(): void
    {
        $name = \App\Models\Name::factory()->create();

        $response = $this->get('/prenoms/' . $name->name[0]);

        $response->assertStatus(200);
        $response->assertSee('Tous les prénoms commençant par la lettre ' . Str::upper($name->name[0]));
        $response->assertSee($name->name);
    }

    #[Test]
    public function male_screen_can_be_rendered(): void
    {
        $names = \App\Models\Name::factory(10)->male()->create();

        $response = $this->get('/prenoms/garcons');

        $response->assertStatus(200);
        $response->assertSee($names[0]->name);
    }

    #[Test]
    public function male_letter_can_be_rendered(): void
    {
        $name = \App\Models\Name::factory()->male()->create();

        $response = $this->get('/prenoms/garcons/' . $name->name[0]);

        $response->assertStatus(200);
        $response->assertSee('Tous les prénoms masculins commençant par la lettre ' . Str::upper($name->name[0]));
        $response->assertSee($name->name);
    }

    #[Test]
    public function female_screen_can_be_rendered(): void
    {
        $names = \App\Models\Name::factory(10)->female()->create();

        $response = $this->get('/prenoms/filles');

        $response->assertStatus(200);
        $response->assertSee($names[0]->name);
    }

    #[Test]
    public function female_letter_can_be_rendered(): void
    {
        $name = \App\Models\Name::factory()->female()->create();

        $response = $this->get('/prenoms/filles/' . $name->name[0]);

        $response->assertStatus(200);
        $response->assertSee('Tous les prénoms féminins commençant par la lettre ' . Str::upper($name->name[0]));
        $response->assertSee($name->name);
    }

    #[Test]
    public function unisex_screen_can_be_rendered(): void
    {
        $names = \App\Models\Name::factory(10)->unisex()->create();

        $response = $this->get('/prenoms/mixtes');

        $response->assertStatus(200);
        $response->assertSee($names[0]->name);
    }

    #[Test]
    public function unisex_letter_can_be_rendered(): void
    {
        $name = \App\Models\Name::factory()->unisex()->create();

        $response = $this->get("/prenoms/mixtes/{$name->name[0]}");

        $response->assertStatus(200);
        $response->assertSee('Tous les prénoms mixtes commençant par la lettre ' . Str::upper($name->name[0]));
        $response->assertSee($name->name);
    }

    #[Test]
    public function name_page_can_be_rendered(): void
    {
        $name = \App\Models\Name::factory()->create();

        $response = $this->get("/prenoms/$name->id/" . Str::slug($name->name));

        $response->assertStatus(200);
        $response->assertSee($name->name);
    }
}