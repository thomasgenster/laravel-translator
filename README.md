# laravel-translator
Custom translator for Laravel that prevents the need to use traditional placeholders for getting a translation inside a translation

Add the following to you Providers array (app/config/app.php): 

`Genster\CustomLaravelTranslator\TranslatorProvider`

Remove/uncomment the default provider: 

`Illuminate\Translation\TranslationServiceProvider`

#### Usage:
Use [[ ]] as placeholders to have it be replaced by the corresponding translation key.

#### Example:

lang/en/default.php
```php
array(
    'hello world' => 'Please contact us at [[contact.phone]]',
)
```

lang/en/contact.php
```php
array(
    'phone' => '+49 12345678'
)
```
