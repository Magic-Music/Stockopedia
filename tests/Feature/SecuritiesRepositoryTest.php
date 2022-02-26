<?php

namespace Tests\Feature;

use App\Repositories\SecuritiesRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SecuritiesRepositoryTest extends TestCase
{
    private $securitiesRepository;

    public function setUp(): void
    {
        parent::setUp();

        $this->securitiesRepository = $this->app->make(SecuritiesRepository::class);
    }

    public function testItReturnsTheRightValue()
    {
        $this->assertEquals(
            9,
            $this->securitiesRepository->getAttributeValueForSecurity("ABC", "debt")
        );
    }

    public function testUnknownSecurityReturnsNull()
    {
        $this->assertNull($this->securitiesRepository->getAttributeValueForSecurity("XXX", "debt"));
    }

    public function testUnknownAttributeReturnsNull()
    {
        $this->assertNull($this->securitiesRepository->getAttributeValueForSecurity("ABC", "gnu"));
    }
}
