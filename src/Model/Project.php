<?php

namespace ArtARTs36\ArtARTs36\Model;

class Project
{
    public function __construct(
        public readonly string $name,
        public readonly string $description,
        public readonly Lang $lang,
        public readonly string $url,
        public readonly int $downloads,
    ) {
        //
    }
}
