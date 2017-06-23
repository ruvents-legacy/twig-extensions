<?php

namespace Ruvents\TwigExtensions;

class MarkdownExtension extends \Twig_Extension
{
    /**
     * @var \ParsedownExtra
     */
    private $parsedown;

    public function __construct(\ParsedownExtra $parsedown = null)
    {
        $this->parsedown = $parsedown ?: new \ParsedownExtra();
    }

    /**
     * {@inheritdoc}
     */
    public function getFilters()
    {
        return [
            new \Twig_SimpleFilter('md_line',
                function ($string, $lineBreaks = true, $html = false, $autoUrls = true) {
                    return $this->parsedown
                        ->setBreaksEnabled($lineBreaks)
                        ->setMarkupEscaped(!$html)
                        ->setUrlsLinked($autoUrls)
                        ->line($string);
                },
                ['is_safe' => ['html']]
            ),
            new \Twig_SimpleFilter('md_text',
                function ($string, $lineBreaks = true, $html = false, $autoUrls = true) {
                    return $this->parsedown
                        ->setBreaksEnabled($lineBreaks)
                        ->setMarkupEscaped(!$html)
                        ->setUrlsLinked($autoUrls)
                        ->text($string);
                },
                ['is_safe' => ['html']]
            ),
        ];
    }
}
