<?php

namespace Ruvents\TwigExtensions;

final class Helper
{
    public static function iterableToArray(iterable $iterable): array
    {
        if ($iterable instanceof \Traversable) {
            return iterator_to_array($iterable);
        }

        return $iterable;
    }
}
