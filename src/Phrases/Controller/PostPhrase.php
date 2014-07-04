<?php
namespace Phrases\Controller;

use Zend\Http\Response;
use Zend\Http\Request;

class PostPhrase implements ExecutionInterface
{
    private $data;

    public function __construct(array $postData)
    {
        $this->data = $postData;
    }

    protected function isValidPostData()
    {
        $mandatoryKeys = [
            'title',
            'text'
        ];

        return !array_diff($mandatoryKeys, array_keys($this->data));
    }

    public function execute(Request $request)
    {
        $response = new Response();

        if ($this->isValidPostData()) {
            return $response->setStatusCode(Response::STATUS_CODE_201);
        }

        return $response->setStatusCode(Response::STATUS_CODE_400);
    }
}
