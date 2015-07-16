<?php

/**
 * Graph creator tests
 *
 * @package    Feijs/MorrisGraphs
 * @author     Mike Feijs <mfeijs@gmail.com>
 * @copyright  (c) 2015, Mike Feijs
 */
class FactoryTest extends MGTestCase
{
	public function testFactoryCreation()
	{
	    $graph = App::make('Feijs\MorrisGraphs\Factory');
	    $this->assertInstanceOf('Feijs\MorrisGraphs\Factory', $graph);
	}
}