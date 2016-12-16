<?php

namespace Ruvents\TwigExtensions;

/**
 * @deprecated since 2.0.2 (to be removed in 3.0)
 */
abstract class ComparatorsAbstractContainer
{
    /**
     * @return \Closure[]
     */
    abstract public function all();

    /**
     * @param string $name
     *
     * @return bool
     */
    public function has($name)
    {
        return array_key_exists($name, $this->all());
    }

    /**
     * @param string $name
     *
     * @return \Closure
     *
     * @throws \OutOfBoundsException
     */
    public function get($name)
    {
        if (!$this->has($name)) {
            throw new \OutOfBoundsException(sprintf(
                'Usort "%s" was not found.', $name
            ));
        }

        return $this->all()[$name];
    }
}
