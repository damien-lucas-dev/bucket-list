<?php


namespace App\Util;


class Censurator
{
    protected $BAD_WORDS = [
        'merde',
        'chier',
        'chiant',
        'putain',
        'couille',
        'chatte',
        'bite',
        'sexe',
        'sex',
        'cunt',
        'shit',
        'fuck',
        'bitch',
        'biatch'
    ];

    public function purify(string $incomingText)
    {
        echo 'Texte à purifier : "' . $incomingText .'"<br/>';
        // str_ireplace ( array|string $search , array|string $replace , string|array $subject , int &$count = null ) : string|array
        $count = 0;
        $purifiedText = str_ireplace ($this->BAD_WORDS, '****', $incomingText, $count);
        //DEBUG: echo 'Texte purifié : "' . $purifiedText .'". Il y avait '. $count .' gros mots !';
        return $purifiedText;
    }
}