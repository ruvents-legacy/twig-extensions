<?php

namespace Ruvents\TwigExtensions;

class UsortExtension extends \Twig_Extension
{
    /**
     * @var ComparatorsAbstractContainer
     */
    private $comparators;

    public function __construct(ComparatorsAbstractContainer $comparators)
    {
        $this->comparators = $comparators;
    }

    /**
     * {@inheritdoc}
     */
    public function getFilters()
    {
        return [
            new \Twig_SimpleFilter('usort', function ($traversable, $name, $preserveKeys = true) {
                $comparator = $this->comparators->get($name);
                $array = $this->toArray($traversable);

                if ($preserveKeys) {
                    uasort($array, $comparator);
                } else {
                    usort($array, $comparator);
                }

                return $array;
            }, ['deprecated' => true]),
            new \Twig_SimpleFilter('uksort', function ($traversable, $name) {
                $comparator = $this->comparators->get($name);
                $array = $this->toArray($traversable);

                uksort($array, $comparator);

                return $array;
            }, ['deprecated' => true]),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'ruvents_twig_extensions.usort';
    }

    /**
     * @param array|\Traversable $traversable
     *
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
