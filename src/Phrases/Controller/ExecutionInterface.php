<?php

namespace Phrases\Controller;

use Zend\Http\Request;

interface ExecutionInterface
{
    /**
     * @param Request $request
     *
     * @return Zend\Http\Response
     */
    public function execute(Request $request);
}
