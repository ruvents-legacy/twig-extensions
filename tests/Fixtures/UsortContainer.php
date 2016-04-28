<?php

namespace Ruvents\TwigExtensions\Fixtures;

use Ruvents\TwigExtensions\UsortContainerInterface;

/**
 * Class UsortContainer
 */
class UsortContainer implements UsortContainerInterface
{
    /**
     * @return array
     */
    public function getUsorts()
    {
        return [
            'rsort' => function ($a, $b) {
                if ($a == $b) {
                    return 0;
                }

                return $a < $b ? 1 : -1;
            },
        ];
    }
}
