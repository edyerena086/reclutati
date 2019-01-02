<?php

namespace ReclutaTI\Console\Commands;

use Spatie\Sitemap\Tags\Url;
use Illuminate\Console\Command;
use Spatie\Sitemap\SitemapGenerator;

class GenerateSitemap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sitemap:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate sitemap for ReclutaTI front';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        SitemapGenerator::create(config('app.url'))
            ->hasCrawled(function (Url $url) {
               if ($url->segment(1) === 'candidate' || $url->segment(1) === 'recruiter' || $url->segment(1) === 'perfil') {
                   return;
               }

               return $url;
            })
            ->writeToFile(public_path('sitemap.xml'));

            /*->hasCrawled(function (Url $url) {
                if ($url->segment(1) === 'candidate') {
                    return;
                }

                return $url;
            })
            ->writeToFile(public_path('sitemap.xml'));*/
    }
}
