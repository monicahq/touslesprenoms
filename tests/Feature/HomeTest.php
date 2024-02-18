<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class HomeTest extends TestCase
{
    use DatabaseTransactions;

    #[Test]
    public function home_screen_can_be_rendered(): void
    {
        \App\Models\Name::factory(10)->create();

        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
