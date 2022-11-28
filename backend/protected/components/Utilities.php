<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Utilities{
    static function rus2translit($string) {

        $converter = array(

            'а' => 'a',   'б' => 'b',   'в' => 'v',

            'г' => 'g',   'д' => 'd',   'е' => 'e',

            'ё' => 'e',   'ж' => 'zh',  'з' => 'z',

            'и' => 'i',   'й' => 'y',   'к' => 'k',

            'л' => 'l',   'м' => 'm',   'н' => 'n',

            'о' => 'o',   'п' => 'p',   'р' => 'r',

            'с' => 's',   'т' => 't',   'у' => 'u',

            'ф' => 'f',   'х' => 'h',   'ц' => 'c',

            'ч' => 'ch',  'ш' => 'sh',  'щ' => 'sch',

            'ь' => '\'',  'ы' => 'y',   'ъ' => '\'',

            'э' => 'e',   'ю' => 'yu',  'я' => 'ya',



            'А' => 'A',   'Б' => 'B',   'В' => 'V',

            'Г' => 'G',   'Д' => 'D',   'Е' => 'E',

            'Ё' => 'E',   'Ж' => 'Zh',  'З' => 'Z',

            'И' => 'I',   'Й' => 'Y',   'К' => 'K',

            'Л' => 'L',   'М' => 'M',   'Н' => 'N',

            'О' => 'O',   'П' => 'P',   'Р' => 'R',

            'С' => 'S',   'Т' => 'T',   'У' => 'U',

            'Ф' => 'F',   'Х' => 'H',   'Ц' => 'C',

            'Ч' => 'Ch',  'Ш' => 'Sh',  'Щ' => 'Sch',

            'Ь' => '\'',  'Ы' => 'Y',   'Ъ' => '\'',

            'Э' => 'E',   'Ю' => 'Yu',  'Я' => 'Ya',
            
            
            'ü'=>'u',       'Ü'=>'U',   'ö'=>'o',
            'Ö'=>'O',       'ə'=>'e',   'Ə'=>'E',
            'ı'=>'i',       'İ'=>'I',   'ç'=>'ch',
            'Ç'=>'Ch',      'ş'=>'sh',  'Ş'=>'Sh',
            'Ğ'=>'Gh',      'ğ'=>'gh'
        );

    return strtr($string, $converter);

    }

    static function uppercase($string) {
        $lang = Yii::app()->controller->Lang;
        $ru = array(

            'а' => 'А',   'б' => 'Б',   'в' => 'В',

            'г' => 'Г',   'д' => 'Д',   'е' => 'Е',

            'ё' => 'Ё',   'ж' => 'Ж',  'з' => 'З',

            'и' => 'И',   'й' => 'Й',   'к' => 'К',

            'л' => 'Л',   'м' => 'М',   'н' => 'Н',

            'о' => 'О',   'п' => 'П',   'р' => 'Р',

            'с' => 'С',   'т' => 'Т',   'у' => 'У',

            'ф' => 'Ф',   'х' => 'Х',   'ц' => 'Ц',

            'ч' => 'Ч',  'ш' => 'Ш',  'щ' => 'Щ',

            'ь' => 'Ь',  'ы' => 'Ы',   'ъ' => 'Ъ',

            'э' => 'Э',   'ю' => 'Ю',  'я' => 'Я',
        );
        $az = array(
            'ü'=>'Ü',   'ö'=>'Ö',   'ğ'=>'Ğ',
            'ı'=>'I',   'i'=>'İ',   'ə'=>'Ə',
            'ç'=>'Ç',   'ş'=>'Ş',
            
        );
        
    if (in_array($lang,array('ru','az')))
        return strtr($string, $$lang);
    else return $string;

    }
    static function str2url($str) {

        // переводим в транслит

        $str = Utilities::rus2translit($str);

        // в нижний регистр

        $str = strtolower($str);

        // заменям все ненужное нам на "-"

        $str = preg_replace('~[^a-z0-9_]+~u', '_', $str);

        // удаляем начальные и конечные '-'

        $str = trim($str, "-");

        return $str;

    }

    static function getRefererUrl($language){
        $url = Yii::app()->request->getUrlReferrer(true)?Yii::app()->request->getUrlReferrer(true): Yii::app()->controller->createUrl('site/index',array('language'=>$language));
        return $url;
    }
    static function t($str,$arr=null){
        return Yii::t('frontend.strings',$str,$arr);
    }
}