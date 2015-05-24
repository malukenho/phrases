<?php

namespace Phrases\Controller;

use Zend\Http\Request;
use Phrases\Persistence;
use Zend\Http\Response;

class Factory
{
    private $constructorArgs;

    /**
     * @param Persistence\RepositoryInterface $phrases
     */
    public function __construct(Persistence\RepositoryInterface $phrases)
    {
        $this->constructorArgs = $phrases;
    }

    /**
     * @param Request $request
     *
     * @return Error|GetPhrase|PostPhrase
     */
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

        return new Error(Response::STATUS_CODE_405, 'Method not allowed');
    }
}
