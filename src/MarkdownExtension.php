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
            new TwigFilter('md_line',
                function ($string, bool $lineBreaks = null, bool $html = null, bool $autoUrls = null) {
                    return $this->createParsedown($lineBreaks, $html, $autoUrls)->line($string);
                },
                ['is_safe' => ['html']]
            ),
            new TwigFilter('md_text',
                function ($string, bool $lineBreaks = null, bool $html = null, bool $autoUrls = null) {
                    return $this->createParsedown($lineBreaks, $html, $autoUrls)->text($string);
                },
                ['is_safe' => ['html']]
            ),
        ];
    }

    private function createParsedown(bool $lineBreaks = null, bool $html = null, bool $autoUrls = null): \Parsedown
    {
        $parsedown = clone $this->parsedown;

        if (null !== $lineBreaks) {
            $parsedown->setBreaksEnabled($lineBreaks);
        }

        if (null !== $html) {
            $parsedown->setMarkupEscaped(!$html);
        }

        if (null !== $autoUrls) {
            $parsedown->setUrlsLinked($autoUrls);
        }

        return $parsedown;
    }
}
