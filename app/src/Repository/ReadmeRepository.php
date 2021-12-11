<?php

namespace ArtARTs36\ArtARTs36\Repository;

use ArtARTs36\ArtARTs36\Model\Readme;
use ArtARTs36\ArtARTs36\View\ReadmeRenderer;
use ArtARTs36\FileSystem\Contracts\FileSystem;

class ReadmeRepository
{
    public function __construct(protected $path, protected FileSystem $files, protected ReadmeRenderer $renderer)
    {
        //
    }

    public function get(): Readme
    {
        return new Readme();
    }

    public function save(Readme $readme): void
    {
        $this->files->createFile($this->path, $this->renderer->render($readme));
    }
}
