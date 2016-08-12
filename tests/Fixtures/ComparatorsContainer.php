<?php

namespace Ruvents\TwigExtensions\Fixtures;

use Ruvents\TwigExtensions\ComparatorsAbstractContainer;

class ComparatorsContainer extends ComparatorsAbstractContainer
{
    public function all()
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
