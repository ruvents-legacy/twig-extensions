<?php

namespace Ruvents\TwigExtensions;

use Ruvents\TwigExtensions\Fixtures\ComparatorsContainer;

class IntegrationTest extends \Twig_Test_IntegrationTestCase
{
    public function getExtensions()
    {
        return array(
            new ClassExtension(),
            new SortByExtension(),
            new SortExtension(),
            new TextExtension(),
            new UsortExtension(new ComparatorsContainer()),
        );
    }

    public function getFixturesDir()
    {
        return __DIR__.'/Fixtures/';
    }
}
