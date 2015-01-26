<?php

namespace Phrases\Controller;

use Zend\Http\Request;

interface ExecutionInterface
{
    /**
     * Execute a action based on request post data.
     * Can save a phrase or refuse if request data is not valid.
     *
     * @param Request $request
     *
     * @return \Zend\Http\Response
     */
    public function execute(Request $request);
}
