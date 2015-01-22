<?php

namespace Phrases\Controller;

use Phrases\Entity\Phrase;
use Phrases\Persistance\RepositoryInterface;
use Zend\Http\Response;
use Zend\Http\Request;

class PostPhrase implements ExecutionInterface
{
    /**
     * @var RepositoryInterface
     */
    protected $repository;

    /**
     * @var string[]
     */
    protected $data;

    /**
     * Constructor.
     *
     * @param RepositoryInterface $repository to save phrases when we want to storage a new.
     * @param array               $postData   with correct data do be stored.
     */
    public function __construct(RepositoryInterface $repository, array $postData)
    {
        $this->repository = $repository;
        $this->data       = $postData;
    }

    /**
     * Verify if a post data is valid.
     *
     * @return bool
     */
    protected function isValidPostData()
    {
        $mandatoryKeys = [
            'title',
            'text'
        ];

        return !array_diff($mandatoryKeys, array_keys($this->data));
    }

    /**
     * Execute a action based on request post data.
     * Can save a phrase or refuse if data is not valid.
     *
     * @param Request $request
     *
     * @return Zend\Http\Response|Response
     */
    public function execute(Request $request)
    {
        $response = new Response();

        if ($this->isValidPostData()) {
            $entity = new Phrase($this->data['title'], $this->data['text']);
            $this->repository->save($entity);
            $response->setContent($entity->getSlug());
            return $response->setStatusCode(Response::STATUS_CODE_201);
        }

        return $response->setStatusCode(Response::STATUS_CODE_400);
    }
}
