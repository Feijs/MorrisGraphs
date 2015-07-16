<?php
use Orchestra\Testbench\TestCase as TestBenchTestCase;

/**
 * Package test case
 *
 * @package    Feijs/MorrisGraphs
 * @author     Mike Feijs <mfeijs@gmail.com>
 * @copyright  (c) 2015, Mike Feijs
 */
abstract class MGTestCase extends TestBenchTestCase
{
    protected function getPackageProviders()
    {
        return array('Feijs\MorrisGraphs\MorrisGraphsServiceProvider');
    }

    protected function getPackagePath()
    {
        return realpath(implode(DIRECTORY_SEPARATOR, array(
            __DIR__,
            '..',
            'src',
            'Feijs',
            'MorrisGraphs'
        )));
    }
}