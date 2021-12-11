<?php

namespace ArtARTs36\ArtARTs36\View;

use ArtARTs36\ArtARTs36\Model\Readme;
use Illuminate\Contracts\View\Factory;

class ReadmeRenderer
{
    public function __construct(private Factory $view)
    {
        //
    }

    public function render(Readme $readme): string
    {
        return $this->view->make('readme', [
            'readme' => $readme,
        ])->render();
    }
}
