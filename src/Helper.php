<?php

namespace Ruvents\TwigExtensions;

final class Helper
{
    /**
     * @param iterable $iterable
     *
     * @return array
     * @throws \InvalidArgumentException
     */
    public static function iterableToArray($iterable): array
    {
        if (is_array($iterable)) {
            return $iterable;
        }

        if ($iterable instanceof \Traversable) {
            return iterator_to_array($iterable);
        }

        throw new \InvalidArgumentException('Iterable is expected.');
    }
}
