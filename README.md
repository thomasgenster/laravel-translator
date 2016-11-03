# laravel-translator
Custom translator for Laravel that prevents the need to use traditional placeholders for getting a translation inside a translation

#### Usage:
Use [[ ]] as placeholders to have it be replaced by the corresponding translation key.

#### Example:

lang/en/default.php
[

    'hello world' => 'Please contact us at [[default.phone]]',
    'phone' => '+49 12345678'
    
]