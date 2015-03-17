<?php

/* Author: ئۈرۈمچى ئالماس كومپيۇتېر چەكلىك شىركىتى
 * Version: 1.01 (2013-11-13)
 * http://www.almas.biz/		
 * 
 */

class UyHarp
{
    const BASH = 1;
    const OTTURA = 2;
    const AHIR = 3;
    const YALGHUZ = 4;
}

class UyghurCharUtilities2
{

    private $UChar600 = array("ت","پ","ب","ر","د","چ","ج",
       "ز","ف","ق","ك","ش","گ","س","ڭ","ن","م","ۋ","ل","خ",
       "غ","ژ","ي","ا","ە","و","ۈ","ۆ","ۇ","ې","ى","ھ","ئ");
    private $UCharExB = array(
       "ﺗ","ﭘ","ﺑ","ﺭ","ﺩ","ﭼ","ﺟ",
       "ﺯ","ﻓ","ﻗ","ﻛ","ﺷ","ﮔ","ﺳ","ﯕ","ﻧ","ﻣ","ﯞ","ﻟ","ﺧ",
       "ﻏ","ﮊ","ﻳ","ﺍ","ﻩ","ﻭ","ﯛ","ﯙ","ﯗ","ﯦ","ﯨ","ﮬ","ﺋ"
    );

    private $UCharExO = array(
       "ﺘ","ﭙ","ﺒ","ﺮ","ﺪ","ﭽ","ﺠ",
       "ﺰ","ﻔ","ﻘ","ﻜ","ﺸ","ﮕ","ﺴ","ﯖ","ﻨ","ﻤ","ﯟ","ﻠ","ﺨ",
       "ﻐ","ﮋ","ﻴ","ﺎ","ﻪ","ﻮ","ﯜ","ﯚ","ﯘ","ﯧ","ﯩ","ﮭ","ﺌ");
    private $UCharExA = array(
       "ﺖ","ﭗ","ﺐ","ﺮ","ﺪ","ﭻ","ﺞ",
       "ﺰ","ﻒ","ﻖ","ﻚ","ﺶ","ﮓ","ﺲ","ﯔ","ﻦ","ﻢ","ﯟ","ﻞ","ﺦ",
       "ﻎ","ﮋ","ﻲ","ﺎ","ﻪ","ﻮ","ﯜ","ﯚ","ﯘ","ﯥ","ﻰ","ﮫ","ﺌ");
    private  $UCharExY = array(
       "ﺕ","ﭖ","ﺏ","ﺭ","ﺩ","ﭺ","ﺝ",
       "ﺯ","ﻑ","ﻕ","ﻙ","ﺵ","ﮒ","ﺱ","ﯓ","ﻥ","ﻡ","ﯞ","ﻝ","ﺥ",
       "ﻍ","ﮊ","ﻱ","ﺍ","ﻩ","ﻭ","ﯛ","ﯙ","ﯗ","ﯤ","ﻯ","ﮪ","ﺋ");
    private  $SOL_KOL = array(
       "ت","ئ","خ","چ","ج","پ","ب","س",
       "ش","غ","ف","ق","ك","گ","ڭ","ل","م","ن","ھ","ې","ى",
       "ي");


    private  function Barmu($data, $itm)
    {
        foreach ($data as $k => $v) {
            if ($v == $itm) {
                return $k;
            }
        }
        return -1;

    }

    private  function getExChar($achar, $k)
    {
        // 获取一个基本去字符对应的扩展区字符
        $indx = $this->Barmu($this->UChar600, $achar);
        if ($indx > -1) {
            switch ($k) {
                case UyHarp::BASH:
                    return $this->UCharExB[$indx];
                case UyHarp::OTTURA:
                    return $this->UCharExO[$indx];
                case UyHarp::AHIR:
                    return $this->UCharExA[$indx];
                case UyHarp::YALGHUZ:
                    return $this->UCharExY[$indx];
            }
        }
        return $achar;
    }

    private  function ProLA_HAMZE($aWord)
    {
        $LA_HAMZE1 = array("ﻟﺎ","ﻠﺎ");
        $LA_HAMZE2 = array("ﻻ","ﻼ");

        $text = str_replace($LA_HAMZE1, $LA_HAMZE2, $aWord);

        return $text;
    }


    public  function getUyPFStr($str)
    {
        if (!$str) {
            return $str;
        }


        $strArray = preg_split("//u", $str, -1, PREG_SPLIT_NO_EMPTY);
        $n = count($strArray);

        if ($n == 1) {
            $indx = Barmu($this->UChar600, $strArray[0]);
            if ($indx != -1) {
                return $this->UCharExY[$indx];
            } else {
                return $str;
            }

        }

        if ($n == 2) {
            if ($this->Barmu($this->SOL_KOL, $strArray[0]) > -1) {
                $c1Ex = $this->getExChar($strArray[0], UyHarp ::BASH);
                $c2Ex = $this-> getExChar($strArray[1], UyHarp ::AHIR);
                return $c1Ex . $c2Ex;
            }
        }


        $exWord = $this->getExChar($strArray[0], UyHarp::BASH);


        for ($i = 1; $i < $n - 1; $i++) {

            $c1 = $strArray[$i- 1];
            $c2 = $strArray[$i];
            $c3 = $strArray[$i + 1];

            $indx2 = $this->Barmu($this->UChar600, $c2);
             $indx3 = $this->Barmu($this->UChar600, $c3);
            if ($indx2 > -1) {
                if ($this->Barmu($this->SOL_KOL, $c1) > -1) {
                    if ($indx3 > -1) {
                        $c2Ex = $this->getExChar($c2, UyHarp::OTTURA);
                    } else {
                        $c2Ex = $this->getExChar($c2, UyHarp::AHIR);
                    }
                } else {
                    if ($indx3 > -1) {
                        $c2Ex = $this->getExChar($c2, UyHarp::BASH);
                    } else {
                        $c2Ex = $this->getExChar($c2, UyHarp::YALGHUZ);
                    }
                }
            } else {
                $c2Ex = $c2;
            }
            $exWord .= $c2Ex;
        }

        if ($this->Barmu($this->SOL_KOL, $strArray[$n - 2] > -1)) {
            $c2Ex = $this->getExChar($strArray[$n - 1], UyHarp::AHIR);
        } else {
            $c2Ex = $this->getExChar($strArray[$n - 1], UyHarp::YALGHUZ);
        }
         $exWord .= $c2Ex;
        $exWord = $this->ProLA_HAMZE($exWord);

        return $exWord;

    }

    private
    function GetUy0600Char($aChar)
    {
        switch ($aChar) {
            case 'ﺏ' :
            case 'ﺑ' :
            case 'ﺒ' :
            case 'ﺐ' :
                return"ب";
            case 'ﭖ' :
            case 'ﭗ' :
            case 'ﭘ' :
            case 'ﭙ' :
                return"پ";
            case 'ﺕ' :
            case 'ﺖ' :
            case 'ﺗ' :
            case 'ﺘ' :
                return"ت";
            case 'ﺝ' :
            case 'ﺞ' :
            case 'ﺟ' :
            case 'ﺠ' :
                return"ج";
            case 'ﭺ' :
            case 'ﭻ' :
            case 'ﭼ' :
            case 'ﭽ' :
                return"چ";
            case 'ﺩ' :
            case 'ﺪ' :
                return"د";
            case 'ﺭ' :
            case 'ﺮ' :
                return"ر";
            case 'ﺯ' :
            case 'ﺰ' :
                return"ز";
            case 'ﺱ' :
            case 'ﺲ' :
            case 'ﺳ' :
            case 'ﺴ' :
                return"س";
            case 'ﺵ' :
            case 'ﺶ' :
            case 'ﺷ' :
            case 'ﺸ' :
                return"ش";
            case 'ﻑ' :
            case 'ﻒ' :
            case 'ﻓ' :
            case 'ﻔ' :
                return"ف";
            case 'ﻕ' :
            case 'ﻖ' :
            case 'ﻗ' :
            case 'ﻘ' :
                return"ق";
            case 'ﻙ' :
            case 'ﻚ' :
            case 'ﻛ' :
            case 'ﻜ' :
                return"ك";
            case 'ﮒ' :
            case 'ﮓ' :
            case 'ﮔ' :
            case 'ﮕ' :
                return"گ";
            case 'ﯓ' :
            case 'ﯔ' :
            case 'ﯕ' :
            case 'ﯖ' :
                return"ڭ";
            case 'ﻝ' :
            case 'ﻞ' :
            case 'ﻟ' :
            case 'ﻠ' :
                return"ل";
            case 'ﻡ' :
            case 'ﻢ' :
            case 'ﻣ' :
            case 'ﻤ' :
                return"م";
            case 'ﻥ' :
            case 'ﻦ' :
            case 'ﻧ' :
            case 'ﻨ' :
                return"ن";
            case 'ﯞ' :
            case 'ﯟ' :
                return"ۋ";
            case 'ﻱ' :
            case 'ﻲ' :
            case 'ﻳ' :
            case 'ﻴ' :
                return"ي";
            case 'ﮊ' :
            case 'ﮋ' :
                return"ژ";
            case 'ﺥ' :
            case 'ﺦ' :
            case 'ﺧ' :
            case 'ﺨ' :
                return"خ";
            case 'ﻍ' :
            case 'ﻎ' :
            case 'ﻏ' :
            case 'ﻐ' :
                return"غ";
            case 'ﯪ' :
            case 'ﯫ' :
                return"ئا";
            case 'ﺍ' :
            case 'ﺎ' :
                return"ا";
            case 'ﯬ' :
            case 'ﯭ' :
                return"ئە";
            case 'ﻩ' :
            case 'ﻪ' :
                return"ە";
            case 'ﯮ' :
            case 'ﯯ' :
                return"ئو";
            case 'ﻭ' :
            case 'ﻮ' :
                return"و";
            case 'ﯰ' :
            case 'ﯱ' :
                return"ئۇ";
            case 'ﯗ' :
            case 'ﯘ' :
                return"ۇ";
            case 'ﯲ' :
            case 'ﯳ' :
                return"ئۆ";

            case 'ﯙ' :
            case 'ﯚ' :

                return"ۆ";

            case 'ﯴ' :
            case 'ﯵ' :

                return"ئۈ";
            case 'ﯛ' :
            case 'ﯜ' :
                return"ۈ";
            case 'ﯶ' :
            case 'ﯷ' :
            case 'ﯸ' :
                return"ئې";
            case 'ﯤ' :
            case 'ﯥ' :
            case 'ﯦ' :
            case 'ﯧ' :
                return"ې";
            case 'ﯹ' :
            case 'ﯺ' :
            case 'ﯻ' :
                return"ئى";
            case 'ﻯ' :
            case 'ﯨ' :
            case 'ﯩ' :
            case 'ﻰ' :
                return"ى";
            case 'ﮪ' :
            case 'ﮫ' :
            case 'ﮬ' :
            case 'ﮭ' :
            case 'ﻫ' :
            case 'ﻬ' :

                return"ھ";
            case 'ﺋ' :
            case 'ﺌ' :
                return"ئ";
            case 'ﻻ' :
            case 'ﻼ' :
                return"لا";

            case '−' :

                return"-";

        }

        return $aChar;
    }

    public
    function getUyBRStr($text)
    {

        if ($text) {
            $strArray = preg_split("//u", $text, -1, PREG_SPLIT_NO_EMPTY);
            $n = count($strArray);
            $res ="";

            for ($i = 0; $i < $n; $i++) {
                $wc = hexdec(json_encode($strArray[$i]));
                if ($wc < 255) {
                    $res .= $strArray[$i];

                } else {
                    $res .= $this->GetUy0600Char($strArray[$i]);

                }
            }

            return $res;
        } else {
            return $text;
        }

    }


    function getUyULYStr($text)
    {
        if (!$text) {
            return $text;
        }
        //$text ="".$text;
        $uy = array(
           "ئ",
           "ا",
           "ە",
           "ې",
           "ى",
           "و",
           "ۇ",
           "ۆ",
           "ۈ",
           "ش",
           "ڭ",
           "غ",
           "چ",
           "ب",
           "د",
           "ف",
           "گ",
           "ھ",
           "ج",
           "ك",
           "ل",
           "م",
           "ن",
           "پ",
           "ق",
           "ر",
           "س",
           "ت",
           "ۋ",
           "ي",
           "ز",
           "خ",
           "ژ",
           "،",
           "؟",
           "!",
           "؛",
           "(",
           ")",
           ""
        );

        $uly = array(
           "",
           "a",
           "e",
           "e",
           "i",
           "o",
           "u",
           "o",
           "u",
           "sh",
           "ng",
           "gh",
           "ch",
           "b",
           "d",
           "f",
           "g",
           "h",
           "j",
           "k",
           "l",
           "m",
           "n",
           "p",
           "q",
           "r",
           "s",
           "t",
           "w",
           "y",
           "z",
           "x",
           "J",
           ",",
           "?",
           "!",
           ";",
           ")",
           "(",
           ""
        );

        $text = str_replace($uy, $uly, $text);

        return $text;//substr($text,1);
    }


}

