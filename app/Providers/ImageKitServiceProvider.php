<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ImageKitServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register()
    {
        $this->app->singleton('imagekit', function ($app) {
            $config = $app['config']['imagekit'];

            return new \ImageKit\ImageKit(
                $config['public_key'],
                $config['private_key'],
                $config['url_endpoint']
            );
        });
    }


    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }

    public function uploadMultiple(array $files)
    {
        $imagekit = app('imagekit');

        $uploadedFiles = [];
        foreach ($files as $file) {
            $uploadedFiles[] = $imagekit->upload($file);
        }

        return $uploadedFiles;
    }
}
