<?php

namespace ArtARTs36\ArtARTs36\Model;

use Illuminate\Support\Collection;

class Readme
{
    private readonly string $originalHash;

    public function __construct(
        public readonly string $path,
        protected array $projects = [],
    ) {
        $this->originalHash = md5_file($this->path);
    }

    public function addProject(Project $project): self
    {
        $this->projects[$project->lang->value][] = $project;

        return $this;
    }

    public function getProjects(Lang $lang): Collection
    {
        return new Collection($this->projects[$lang->value] ?? []);
    }

    public function hasChanges(): bool
    {
        return $this->originalHash !== md5_file($this->path);
    }
}
