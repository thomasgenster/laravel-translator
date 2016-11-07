<?php
namespace Genster\CustomLaravelTranslator;

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
        $line = parent::get($key, $replace, $locale);
        $line = $this->recursivelyReplaceTranslations($line);
        return $line;
    }

    protected function recursivelyReplaceTranslations($line){
        if (is_array($line)){
            foreach($line as $i => $v){
                $line[$i] = $this->recursivelyReplaceTranslations($v);
            }
        }else{
            $line = $this->makeTranslationReplacements($line);
        }
        return $line;
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