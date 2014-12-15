<?php

namespace Phrases\Controller;

use Zend\Http\Request;

class Factory
{
    private $constructorArgs = null;

    public function __construct(array $useConstructorArgs=[])
    {
        $this->constructorArgs = $useConstructorArgs;
    }

    public function forHttpMethod(Request $request)
    {
        if ($request->isGet()) {
            return new GetPhrase($this->constructorArgs);
        }

        return new Error(405, 'Method not allowed');
    }
}
