<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\SuccessMailSend' => [
            'App\Listeners\UpdateNumberMailListener',
            'App\Listeners\ChangeStatusMailingListener'
        ],
        'SocialiteProviders\Manager\SocialiteWasCalled' => [
            'SocialiteProviders\Odnoklassniki\OdnoklassnikiExtendSocialite@handle',
            'SocialiteProviders\VKontakte\VKontakteExtendSocialite@handle',
            'SocialiteProviders\Yandex\YandexExtendSocialite@handle',
        ],
        'App\Events\RejectedWork' => [
          'App\Listeners\RejectWork',
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
