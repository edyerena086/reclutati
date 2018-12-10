<?php

namespace ReclutaTI\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class BackViewComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer(
            'layouts.back.partials.sidebar', 'ReclutaTI\Http\View\Composers\Back\SystemModuleComposer'
        );
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
