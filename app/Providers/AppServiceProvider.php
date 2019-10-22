<?php

namespace App\Providers;

use App\Observers\ValuesObserver;
use App\Support\CsvReader;
use App\Value;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use League\Csv\Statement;
use RecursiveIteratorIterator;
use Illuminate\Database\Eloquent\Builder;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        Value::observe(ValuesObserver::class);

        Builder::macro('addSubSelect', function ($column, $query) {

            if (is_null($this->getQuery()->columns)) {
                $this->select($this->getQuery()->from.'.*');
            }

            return $this->selectSub($query->limit(1)->getQuery(), $column);
        });

        if ('production' === env('APP_ENV')) {
            $this->app['request']->server->set('HTTPS', true);
        }
    }

    /**
     * Register any application services.
     */
    public function register()
    {
        $this->app->bind(CsvReader::class, function() {
           return new CsvReader(new \RecursiveDirectoryIterator(public_path('home')), new Statement());
        });
    }
}
