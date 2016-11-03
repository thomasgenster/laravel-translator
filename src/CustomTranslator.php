<?php

namespace CustomLaravelTranslator;

use Illuminate\Translation\Translator as LaravelTranslator;

class CustomTranslator extends LaravelTranslator
{

    protected $current_key;

    /**
     * Get the translation for the given key.
     *
     * @param  string  $key
     * @param  array   $replace
     * @param  string  $locale
     * @return string
     */
    public function get($key, array $replace = array(), $locale = null){
        $this->current_key = $key;
        return parent::get($key, $replace, $locale);
    }

    /**
     * Replace original method with custom method that can include translations inside translations
     *
     * @param  string  $line
     * @param  array   $replace
     * @return string
     */
    protected function makeReplacements($line, array $replace)
    {
        $res = parent::makeReplacements($line, $replace);
        $res = $this->makeTranslationReplacements($res);
        return $res;
    }

    protected function makeTranslationReplacements($line){
        preg_match_all('/\[\[(.*?)\]\]/i', $line, $matches);
        if (isset($matches[0])){
            foreach($matches[0] as $index => $field){
                if ($matches[1][$index] !== $this->current_key){
                    $line = str_replace($field, $this->get($matches[1][$index]), $line);
                }else{
                    $line = str_replace($field, '[[WARNING: key is the same as current key, cant replace]]', $line);
                }
            }
        }
        return $line;
    }

}