<?php

namespace PhrasesTestAsset;

use Phrases\Entity\Phrase;

class PhrasesRepository
{
    protected $phrases;

    protected static function fromArray(array $dataCollection)
    {
        $repository = new Repository();

        array_map(function ($phraseData) use ($repository) {
            $repository->attach(
                new Phrase(
                    $phraseData['title'],
                    $phraseData['text']
                )
            );
        }, $dataCollection);

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
