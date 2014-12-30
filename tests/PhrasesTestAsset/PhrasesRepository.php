<?php

namespace PhrasesTestAsset;

use Phrases\Entity\Phrase;

class PhrasesRepository
{
    protected $phrases;

    protected static function fromArray(array $dataCollection)
    {
        $phrasePrototype = new Phrase();
        $repository = new Repository();

        foreach ($dataCollection as $singleData) {
            $phrase = clone $phrasePrototype;

            $phrase->setTitle($singleData['title'])
                ->setText($singleData['text']);

            $repository->attach($phrase);
        }

        return $repository;
    }

    public static function getRepository()
    {
        self::fromArray(ConsumedData::asRelationalArray());
    }

    public static function createRepositoryWithData(array $dataCollection)
    {
        return self::fromArray($dataCollection);
    }
}
