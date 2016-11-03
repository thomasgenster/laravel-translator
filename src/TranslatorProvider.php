<?php
namespace CustomLaravelTranslator;

use Illuminate\Translation\TranslationServiceProvider;

class TranslatorProvider extends TranslationServiceProvider
{
    public function boot()
    {
        $this->app->bindShared('translator', function($app)
        {
            $loader = $app['translation.loader'];
            $locale = $app['config']['app.locale'];

            $trans = new CustomTranslator($loader, $locale);

            $trans->setFallback($app['config']['app.fallback_locale']);

            return $trans;
        });

        parent::boot();
    }
}