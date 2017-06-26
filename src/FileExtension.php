<?php

namespace Ruvents\TwigExtensions;

use Symfony\Component\HttpFoundation\File\File;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class FileExtension extends AbstractExtension
{
    /**
     * {@inheritdoc}
     */
    public function getFilters()
    {
        return [
            new TwigFilter('base64', function ($file) {
                if (!$file instanceof File) {
                    if (!is_string($file) && !(is_object($file) && method_exists($file, '__toString'))) {
                        throw new \InvalidArgumentException(
                            'Expected string or instance of "Symfony\Component\HttpFoundation\File\File" or object implementing __toString() method.'
                        );
                    }

                    $file = new File((string)$file);
                }

                $contents = file_get_contents($file->getPathname());

                return sprintf('data:%s;base64,%s', $file->getMimeType(), base64_encode($contents));
            }, ['is_safe' => ['html']]),
        ];
    }
}
