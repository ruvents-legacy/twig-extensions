<?php

namespace Ruvents\TwigExtensions;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class MarkdownExtension extends AbstractExtension
{
    /**
     * @var \Parsedown
     */
    private $parsedown;

    public function __construct(\Parsedown $parsedown = null)
    {
        if (null === $parsedown) {
            $parsedown = (new \Parsedown())
                ->setBreaksEnabled(true)
                ->setMarkupEscaped(true)
                ->setUrlsLinked(true);
        }

        $this->parsedown = $parsedown;
    }

    /**
     * {@inheritdoc}
     */
    public function getFilters()
    {
        return [
            new TwigFilter('md_line', function ($string) {
                return $this->parsedown->line($string);
            }, ['is_safe' => ['html']]),
            new TwigFilter('md_text', function ($string) {
                return $this->parsedown->text($string);
            }, ['is_safe' => ['html']]),
        ];
    }
}
