<?php

namespace App\Providers;

use App\Services\JsonRpcService\JsonRpcClient;
use App\Services\JsonRpcService\JsonRpcClientInterface;
use GuzzleHttp\Client;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(JsonRpcClientInterface::class, function () {
            $httpClient = new Client();
            $url = config('jsonrpc.url');
            return new JsonRpcClient($httpClient, $url);
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
