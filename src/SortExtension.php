<?php

namespace Ruvents\TwigExtensions;

class SortExtension extends \Twig_Extension
{
    /**
     * {@inheritdoc}
     */
    public function getFilters()
    {
        return [
            new \Twig_SimpleFilter('sort', function ($traversable, $flags = null, $preserveKeys = true) {
                $array = $this->toArray($traversable);

                if ($preserveKeys) {
                    asort($array, $flags);
                } else {
                    sort($array, $flags);
                }

                return $array;
            }),
            new \Twig_SimpleFilter('ksort', function ($traversable, $flags = null) {
                $array = $this->toArray($traversable);

                ksort($array, $flags);

                return $array;
            }),
            new \Twig_SimpleFilter('natsort', function ($traversable) {
                $array = $this->toArray($traversable);

                natsort($array);

                return $array;
            }),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'ruvents_twig_extensions.sort';
    }

    /**
     * @param array|\Traversable $traversable
     * @return array
     * @throws \Twig_Error_Runtime
     */
    private function toArray($traversable)
    {
        if ($traversable instanceof \Traversable) {
            return iterator_to_array($traversable);
        } elseif (is_array($traversable)) {
            return $traversable;
        }

        throw new \Twig_Error_Runtime(sprintf(
            'Sorted variable must be an array or an instance of Traversable, got "%s".',
            gettype($traversable)
        ));
    }
}
