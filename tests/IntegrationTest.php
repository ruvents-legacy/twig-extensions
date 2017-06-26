<?php

namespace Ruvents\TwigExtensions;

use Twig\Test\IntegrationTestCase;

class IntegrationTest extends IntegrationTestCase
{
    public function getExtensions()
    {
        return array(
            new ClassExtension(),
            new SortExtension(),
            new InflectorExtension(),
            new StringExtension(),
            new FileExtension(),
            new MarkdownExtension(),
        );
    }

    public function getFixturesDir()
    {
        return __DIR__.'/Fixtures/';
    }
}
