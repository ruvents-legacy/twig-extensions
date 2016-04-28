<?php

namespace Ruvents\TwigExtensions;

/**
 * Class SortExtension
 */
class SortExtension extends \Twig_Extension
{
    /**
     * @var UsortContainerInterface
     */
    protected $usortContainer;

    /**
     * @param UsortContainerInterface|null $usortContainer
     */
    public function __construct(UsortContainerInterface $usortContainer = null)
    {
        $this->usortContainer = $usortContainer;
    }

    /**
     * @inheritdoc
     */
    public function getFilters()
    {
        return [
            new \Twig_SimpleFilter('sort', function ($array, $preserveKeys = true, $flags = null) {
                $this->prepareArray($array);

                if ($preserveKeys) {
                    asort($array, $flags);
                } else {
                    sort($array, $flags);
                }

                return $array;
            }),
            new \Twig_SimpleFilter('rsort', function ($array, $preserveKeys = true, $flags = null) {
                $this->prepareArray($array);

                if ($preserveKeys) {
                    arsort($array, $flags);
                } else {
                    rsort($array, $flags);
                }

                return $array;
            }),
            new \Twig_SimpleFilter('ksort', function ($array, $flags = null) {
                $this->prepareArray($array);

                ksort($array, $flags);

                return $array;
            }),
            new \Twig_SimpleFilter('krsort', function ($array, $flags = null) {
                $this->prepareArray($array);

                krsort($array, $flags);

                return $array;
            }),
            new \Twig_SimpleFilter('natsort', function ($array) {
                $this->prepareArray($array);

                natsort($array);

                return $array;
            }),
            new \Twig_SimpleFilter('usort', function ($array, $name, $preserveKeys = true) {
                $this->prepareArray($array);
                $callable = $this->getUsort($name);

                if ($preserveKeys) {
                    uasort($array, $callable);
                } else {
                    usort($array, $callable);
                }

                return $array;
            }),
            new \Twig_SimpleFilter('uksort', function ($array, $name) {
                $this->prepareArray($array);
                $callable = $this->getUsort($name);

                uksort($array, $callable);

                return $array;
            }),
        ];
    }

    /**
     * @inheritdoc
     */
    public function getName()
    {
        return 'ruvents_twig_sort_extension';
    }

    /**
     * @param array|\Traversable $array
     * @throws \Twig_Error_Runtime
     */
    protected function prepareArray(array &$array)
    {
        if ($array instanceof \Traversable) {
            $array = iterator_to_array($array);
        } elseif (!is_array($array)) {
            throw new \Twig_Error_Runtime(sprintf('The ksort filter only works with arrays or "Traversable", got "%s".',
                gettype($array)));
        }
    }

    /**
     * @param string $name
     * @return \Closure
     * @throws \Twig_Error_Runtime
     */
    protected function getUsort($name)
    {
        if (!isset($this->usortContainer->getUsorts()[$name])) {
            throw new \Twig_Error_Runtime(sprintf(
                'Usort "%s" does not exist.',
                $name
            ));
        }

        return $this->usortContainer->getUsorts()[$name];
    }
}
