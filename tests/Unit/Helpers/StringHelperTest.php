<?php

namespace Tests\Unit\Helpers;

use App\Helpers\StringHelper;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class StringHelperTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function it_sanitizes_the_name_for_the_URL(): void
    {
        $this->assertEquals(
            'heloise',
            StringHelper::sanitizeNameForURL('Héloïse')
        );

        $this->assertEquals(
            'cedricceheeeliuse',
            StringHelper::sanitizeNameForURL('CédriçceHeèélïûse')
        );
    }

    /** @test */
    public function it_formats_the_name_from_the_BD(): void
    {
        $this->assertEquals(
            'Héloïse',
            StringHelper::formatNameFromDB('HÉLOÏSE')
        );

        $this->assertEquals(
            'Jean-Jacques',
            StringHelper::formatNameFromDB('JEAN-JACQUES')
        );
    }
}
