<?php

namespace App\Providers;

use App\Modules\Company\Repositories\CompanyRepository;
use App\Modules\Company\Repositories\Interfaces\CompanyRepositoryInterface;
use Illuminate\Support\ServiceProvider;
use App\Modules\Company\Services\CompanyService;
use App\Modules\Company\Services\Interfaces\CompanyServiceInterface;

class CompanyServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->bind(
           CompanyServiceInterface::class,
           CompanyService::class
        );
        $this->app->bind(
            CompanyRepositoryInterface::class,
            CompanyRepository::class
         );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
