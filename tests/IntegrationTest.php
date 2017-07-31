<?php

namespace Ruvents\TwigExtensions;

use Twig\Test\IntegrationTestCase;

class IntegrationTest extends IntegrationTestCase
{
    public function getExtensions()
    {
        return array(
            new ClassExtension(),
            new FileExtension(),
            new InflectorExtension(),
            new MarkdownExtension(),
            new SortExtension(),
            new StringExtension(),
            new TimeExtension(),
        );
    }

    public function getFixturesDir()
    {
        return __DIR__.'/Fixtures/';
    }
}
