<?php

namespace Tests\Feature;

use App\Models\Name;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class NameTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function name_screen_can_be_rendered(): void
    {
        $names = Name::factory(10)->create();

        $response = $this->get('/prenoms');

        $response->assertOk();
        $response->assertSee($names[0]->name);
    }

    #[Test]
    public function name_letter_can_be_rendered(): void
    {
        $name = Name::factory()->create();

        $response = $this->get('/prenoms/' . Str::lower($name->name[0]));

        $response->assertOk();
        $response->assertSee('Tous les prénoms commençant par la lettre ' . $name->name[0]);
        $response->assertSee($name->name);
    }

    #[Test]
    public function male_screen_can_be_rendered(): void
    {
        $names = Name::factory(10)->male()->create();

        $response = $this->get('/prenoms/garcons');

        $response->assertOk();
        $response->assertSee($names[0]->name);
    }

    #[Test]
    public function male_letter_can_be_rendered(): void
    {
        $name = Name::factory()->male()->create();

        $response = $this->get('/prenoms/garcons/' . Str::lower($name->name[0]));

        $response->assertOk();
        $response->assertSee('Tous les prénoms masculins commençant par la lettre ' . $name->name[0]);
        $response->assertSee($name->name);
    }

    #[Test]
    public function female_screen_can_be_rendered(): void
    {
        $names = Name::factory(10)->female()->create();

        $response = $this->get('/prenoms/filles');

        $response->assertOk();
        $response->assertSee($names[0]->name);
    }

    #[Test]
    public function female_letter_can_be_rendered(): void
    {
        $name = Name::factory()->female()->create();

        $response = $this->get('/prenoms/filles/' . Str::lower($name->name[0]));

        $response->assertOk();
        $response->assertSee('Tous les prénoms féminins commençant par la lettre ' . $name->name[0]);
        $response->assertSee($name->name);
    }

    #[Test]
    public function unisex_screen_can_be_rendered(): void
    {
        $names = Name::factory(10)->unisex()->create();

        $response = $this->get('/prenoms/mixtes');

        $response->assertOk();
        $response->assertSee($names[0]->name);
    }

    #[Test]
    public function unisex_letter_can_be_rendered(): void
    {
        $name = Name::factory()->unisex()->create();

        $response = $this->get("/prenoms/mixtes/{$name->name[0]}");

        $response->assertOk();
        $response->assertSee('Tous les prénoms mixtes commençant par la lettre ' . $name->name[0]);
        $response->assertSee($name->name);
    }

    #[Test]
    public function name_page_can_be_rendered(): void
    {
        $name = Name::factory()->create();

        $response = $this->get("/prenoms/$name->id/" . Str::slug($name->name));

        $response->assertOk();
        $response->assertSee($name->name);
    }
}
