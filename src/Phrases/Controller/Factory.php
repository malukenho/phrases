<?php

namespace Phrases\Controller;

use Zend\Http\Request;
use Phrases\Persistence;

class Factory
{
    private $repository = null;
    private $params;

    public function __construct(Persistence\RepositoryInterface $phrases, ...$additionalParam)
    {
        $this->repository = $phrases;
        $this->params     = $additionalParam;
    }

    public function forHttpMethod(Request $request)
    {
        if ($request->isGet()) {
            return call_user_func_array(
                GetPhrase::class,
                array_merge([$this->repository], $this->params)
            );
        }

        if ($request->isPost()) {
            return call_user_func_array(
                PostPhrase::class,
                array_merge(
                    [$this->repository],
                    $this->params,
                    [$request->getPost()->toArray()]
                )
            );
        }

        return new Error(405, 'Method not allowed');
    }
}
