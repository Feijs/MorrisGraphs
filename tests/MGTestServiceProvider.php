<?php

use Feijs\MorrisGraphs\MorrisGraphsServiceProvider;
use Mockery as m;

/**
 * Service Provider tests
 *
 * @package    Feijs/MorrisGraphs
 * @author     Mike Feijs <mfeijs@gmail.com>
 * @copyright  (c) 2015, Mike Feijs
 */
class MGTestServiceProvider extends MGTestCase
{
    public function tearDown()
    {
        parent::tearDown();
        m::close();
    }

    public function testProviders()
    {
        $app = m::mock('Illuminate\Foundation\Application');
        $provider = new MorrisGraphsServiceProvider($app);

        $this->assertCount(1, $provider->provides());
        $this->assertContains('morris-graphs', $provider->provides());
    }
}