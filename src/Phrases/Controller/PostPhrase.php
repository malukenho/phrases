<?php

namespace Phrases\Controller;

use Phrases\Command\CommandBus;
use Phrases\Command\CreatePhraseCommand;
use Phrases\Persistence\RepositoryInterface;
use Zend\Http\Response;
use Zend\Http\Request;

class PostPhrase implements ExecutionInterface
{
    /**
     * @var RepositoryInterface
     */
    protected $repository;

    /**
     * @var CreatePhraseCommand
     */
    protected $command;

    /**
     * @var CommandBus
     */
    protected $commandBus;

    /**
     * Constructor.
     *
     * @param RepositoryInterface $repository to save phrases when we want to storage a new.
     * @param CommandBus          $commandBus responsible to handle commands
     * @param string[]            $data       with correct data do be stored.
     */
    public function __construct(RepositoryInterface $repository, CommandBus $commandBus, array $data)
    {
        $this->repository = $repository;
        $this->commandBus = $commandBus;
        $this->command    = new CreatePhraseCommand($data['title'], $data['text']);
    }

    /**
     * {@inheritDoc}
     */
    public function execute(Request $request)
    {
        return $this->commandBus->push($this->command, $this->repository);
    }
}
