<?php

namespace Elaboratecode\ValidDataFaker\Generator;

abstract class Generator
{
    public function __construct()
    {
        $this->setUpTraits();
    }

    abstract public function __invoke();

    protected function setUpTraits()
    {
        $uses = array_flip(class_uses_recursive(static::class));

        foreach ($uses as $trait) {
            if (method_exists($this, $method = 'setUp'.class_basename($trait))) {
                $this->{$method}();
            }
        }

        return $uses;
    }
}
