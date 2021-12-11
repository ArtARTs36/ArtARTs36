<?php

namespace ArtARTs36\ArtARTs36\Model;

use Illuminate\Support\Collection;

class Readme
{
    public function __construct(
        public readonly string $path,
        protected array $projects = [],
    ) {
        //
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
}
