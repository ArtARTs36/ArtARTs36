<?php

namespace ArtARTs36\ArtARTs36\Console;

use ArtARTs36\ArtARTs36\Model\Lang;
use ArtARTs36\ArtARTs36\Model\Project;
use ArtARTs36\ArtARTs36\Repository\ReadmeRepository;
use Illuminate\Console\Command;
use Packagist\Api\Client;
use Packagist\Api\Result\Result;

class UpdateReadmeCommand extends Command
{
    protected $signature = 'artarts36:readme:update';

    public function handle(ReadmeRepository $repository, Client $client)
    {
        $readme = $repository->get();

        /** @var Result $result */
        foreach ($client->search('artarts36', [
            'vendor' => 'artarts36',
        ]) as $result) {
            $readme->addProject(new Project(
                $result->getName(),
                $result->getDescription(),
                Lang::PHP,
                $result->getRepository(),
                $result->getDownloads(),
            ));
        }

        $repository->save($readme);
    }
}
