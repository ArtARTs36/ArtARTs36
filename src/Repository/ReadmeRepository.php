<?php

namespace ArtARTs36\ArtARTs36\Repository;

use ArtARTs36\ArtARTs36\Model\Readme;
use ArtARTs36\ArtARTs36\View\ReadmeRenderer;
use ArtARTs36\FileSystem\Contracts\FileSystem;

class ReadmeRepository
{
    protected static string $path = __DIR__ . '/../../README.md';

    public function __construct(protected FileSystem $files, protected ReadmeRenderer $renderer)
    {
        //
    }

    public function get(): Readme
    {
        return new Readme($this->files->getFileContent(self::$path));
    }

    public function save(Readme $readme): void
    {
        $this->files->createFile(self::$path, $this->renderer->render($readme));
    }
}
