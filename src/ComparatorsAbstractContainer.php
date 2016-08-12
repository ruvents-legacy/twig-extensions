<?php

namespace Ruvents\TwigExtensions;

/**
 * Class UsortAbstractContainer
 */
abstract class ComparatorsAbstractContainer
{
    /**
     * @return \Closure[]
     */
    abstract public function all();

    /**
     * @param string $name
     * @return bool
     */
    public function has($name)
    {
        return array_key_exists($name, $this->all());
    }

    /**
     * @param string $name
     * @return \Closure
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
