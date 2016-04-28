<?php

namespace Ruvents\TwigExtensions;

use Ruvents\TwigExtensions\Fixtures\UsortContainer;

/**
 * Class IntegrationTest
 */
class IntegrationTest extends \Twig_Test_IntegrationTestCase
{
    /**
     * @inheritdoc
     */
    public function getExtensions()
    {
        return array(
            new SortExtension(new UsortContainer()),
            new ClassExtension(),
        );
    }

    /**
     * @return string
     */
    public function getFixturesDir()
    {
        return __DIR__.'/Fixtures/';
    }
}
