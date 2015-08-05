<?php

namespace App\Providers;

use Illuminate\Foundation\Providers\ConsoleSupportServiceProvider as IlluminateConsoleServiceProvider;

class ConsoleSupportServiceProvider extends IlluminateConsoleServiceProvider
{

    /**
     * The provider class names.
     *
     * @var array
     */
    protected $providers = [
        'Illuminate\Auth\GeneratorServiceProvider',
        'Illuminate\Foundation\Providers\ComposerServiceProvider',
        'Illuminate\Queue\ConsoleServiceProvider',
        'Illuminate\Routing\GeneratorServiceProvider',
        'Illuminate\Session\CommandsServiceProvider',
    ];
}