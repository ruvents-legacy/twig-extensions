<?php

namespace Ruvents\TwigExtensions;

use Symfony\Component\PropertyAccess\PropertyAccess;
use Symfony\Component\PropertyAccess\PropertyAccessorInterface;

/**
 * Class SortByExtension
 */
class SortByExtension extends \Twig_Extension
{
    /**
     * @var PropertyAccessorInterface
     */
    private $propertyAccessor;

    public function __construct()
    {
        $this->propertyAccessor = PropertyAccess::createPropertyAccessor();
    }

    /**
     * @inheritdoc
     */
    public function getFilters()
    {
        return [
            new \Twig_SimpleFilter('sortBy', function ($array, $path, $preserveKeys = true) {
                $function = $preserveKeys ? 'uasort' : 'usort';

                $function($array, function ($a, $b) use ($path) {
                    $aValue = $this->propertyAccessor->getValue($a, $path);
                    $bValue = $this->propertyAccessor->getValue($b, $path);

                    if ($aValue == $bValue) {
                        return 0;
                    }

                    return $aValue > $bValue ? 1 : -1;
                });

                return $array;
            }),
        ];
    }

    /**
     * @inheritdoc
     */
    public function getName()
    {
        return 'ruvents_twig_extensions.sort_by';
    }
}
