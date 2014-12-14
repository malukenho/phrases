<?php

namespace Phrases\Controller;

use Zend\Http\Request;

interface ExecutionInterface
{
    /**
     * @return Zend\Http\Response
     */
    public function execute(Request $request);
}
