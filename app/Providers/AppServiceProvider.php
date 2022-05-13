<?php

namespace App\Providers;

use App\Channels\KavehNegarChannel;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\ServiceProvider;
use GuzzleHttp\Client as HttpClient;
use Illuminate\Notifications\ChannelManager;
use \Kavenegar\KavenegarApi as KavenegarApi;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Notification::resolved(function (ChannelManager $service) {
            $service->extend('kaveh_sms', function ($app) {
                return new KavehNegarChannel(
                    new KavenegarApi(config()->get('kavenegar.apikey')),
                    config()->get('kavenegar.from')
                );
            });
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
