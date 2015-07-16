<?php

/**
 * Package config test
 *
 * @package    Feijs/MorrisGraphs
 * @author     Mike Feijs <mfeijs@gmail.com>
 * @copyright  (c) 2015, Mike Feijs
 */
class MGTestConfig extends MGTestCase
{
    public function testLabelTranslationsConfig()
    {
        $this->assertEquals('morris-graphs::labels', Config::get('morris-graphs::config.translations.labels'));
    }
}