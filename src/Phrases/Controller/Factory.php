<?php

namespace Phrases\Controller;

use Zend\Http\Request;
use Phrases\Persistence;

class Factory
{
    private $constructorArgs = null;

    public function __construct(Persistence\RepositoryInterface $phrases)
    {
        $this->constructorArgs = $phrases;
    }

    public function forHttpMethod(Request $request)
    {
        if ($request->isGet()) {
            return new GetPhrase($this->constructorArgs);
        }

        if ($request->isPost()) {
            return new PostPhrase(
                $this->constructorArgs,
                $request->getPost()->toArray()
            );
        }

        return new Error(405, 'Method not allowed');
    }
}
