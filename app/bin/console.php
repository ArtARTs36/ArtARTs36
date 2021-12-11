<?php

use ArtARTs36\ArtARTs36\Console\UpdateReadmeCommand;
use ArtARTs36\FileSystem\Contracts\FileSystem;
use ArtARTs36\GitHandler\Support\LocalFileSystem;
use Illuminate\Console\Application;
use Illuminate\Container\Container;
use Illuminate\Contracts\View\Factory;
use Illuminate\Events\Dispatcher;
use Illuminate\View\Compilers\BladeCompiler;
use Illuminate\View\Engines\CompilerEngine;
use Illuminate\View\Engines\EngineResolver;
use Illuminate\View\FileViewFinder;
use Illuminate\View\ViewFinderInterface;

require_once __DIR__ . '/../vendor/autoload.php';

$app = new Application($container = Container::getInstance(), $events = new Dispatcher(), '0.1.0');

$container->instance(\Illuminate\Contracts\Events\Dispatcher::class, $events);
$container->afterResolving(EngineResolver::class, static function (EngineResolver $resolver) {
    $resolver->register('blade', static function () {
        return new CompilerEngine(new BladeCompiler(new \Illuminate\Filesystem\Filesystem(), __DIR__ . '/../cache/'));
    });
});

$container->bind(\ArtARTs36\ArtARTs36\Repository\ReadmeRepository::class, static function (Container $container) {
    return new \ArtARTs36\ArtARTs36\Repository\ReadmeRepository(
        __DIR__ . '/../../README.md',
        $container->make(FileSystem::class),
        $container->make(\ArtARTs36\ArtARTs36\View\ReadmeRenderer::class),
    );
});

$container->bind(FileSystem::class, LocalFileSystem::class);
$container->bind(Factory::class, \Illuminate\View\Factory::class);
$container->bind(ViewFinderInterface::class, static function () {
    return new FileViewFinder(
        new \Illuminate\Filesystem\Filesystem(),
        [
            __DIR__ . '/../src/resources/views',
        ]
    );
});

$app->resolveCommands([
    UpdateReadmeCommand::class,
]);

$app->run();
