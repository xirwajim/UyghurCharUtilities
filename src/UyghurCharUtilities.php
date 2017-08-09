<?php
namespace UyghurCharUtilities;
/* Author: xirwajim
 * Version: 2.0 (2017-04-04)
 * https://www.arnale.com/
 * 新疆阿尔纳乐电子科技有限公司
 */

class UyghurCharUtilities
{
    private $BPAD = 1536;
    private $BMAX = 1791;
    private $EPAD = 64256;
    private $EMAX = 65279;
    private $CPAD = 1024;
    private $CMAX = 1279;
    private $CHEE = 1670;
    private $GHEE = 1594;
    private $NGEE = 1709;
    private $SHEE = 1588;
    private $SZEE = 1688;

    private $LA = 'ﻻ';
    private $_LA = 'ﻼ';
    private $HAMZA = 1574;

    private $cyrmap = array();
    private $cyrmapinv = array();
    private $pform = array();

    private $WDBEG = 0;
    private $INBEG = 1;
    private $NOBEG = 2;

    private $lsyn;

    public function __construct()
    {

        $this->cmap['A'] = 1575;
        $this->cmap['a'] = 1575;
        $this->cmap['B'] = 1576;
        $this->cmap['b'] = 1576;
        $this->cmap['C'] = 1603;
        $this->cmap['c'] = 1603;
        $this->cmap['D'] = 1583;
        $this->cmap['d'] = 1583;
        $this->cmap['E'] = 1749;
        $this->cmap['e'] = 1749;
        $this->cmap['F'] = 1601;
        $this->cmap['f'] = 1601;
        $this->cmap['G'] = 1711;
        $this->cmap['g'] = 1711;
        $this->cmap['H'] = 1726;
        $this->cmap['h'] = 1726;
        $this->cmap['I'] = 1609;
        $this->cmap['i'] = 1609;
        $this->cmap['J'] = 1580;
        $this->cmap['j'] = 1580;
        $this->cmap['K'] = 1603;
        $this->cmap['k'] = 1603;
        $this->cmap['L'] = 1604;
        $this->cmap['l'] = 1604;
        $this->cmap['M'] = 1605;
        $this->cmap['m'] = 1605;
        $this->cmap['N'] = 1606;
        $this->cmap['n'] = 1606;
        $this->cmap['O'] = 1608;
        $this->cmap['o'] = 1608;
        $this->cmap['P'] = 1662;
        $this->cmap['p'] = 1662;
        $this->cmap['Q'] = 1602;
        $this->cmap['q'] = 1602;
        $this->cmap['R'] = 1585;
        $this->cmap['r'] = 1585;
        $this->cmap['S'] = 1587;
        $this->cmap['s'] = 1587;
        $this->cmap['T'] = 1578;
        $this->cmap['t'] = 1578;
        $this->cmap['U'] = 1735;
        $this->cmap['u'] = 1735;
        $this->cmap['V'] = 1739;
        $this->cmap['v'] = 1739;
        $this->cmap['W'] = 1739;
        $this->cmap['w'] = 1739;
        $this->cmap['X'] = 1582;
        $this->cmap['x'] = 1582;
        $this->cmap['Y'] = 1610;
        $this->cmap['y'] = 1610;
        $this->cmap['Z'] = 1586;
        $this->cmap['z'] = 1586;
        $this->cmap['É'] = 1744;
        $this->cmap['é'] = 1744;
        $this->cmap['Ö'] = 1734;
        $this->cmap['ö'] = 1734;
        $this->cmap['Ü'] = 1736;
        $this->cmap['ü'] = 1736;
        $this->cmap[';'] = 1563;
        $this->cmap['?'] = 1567;
        $this->cmap[','] = 1548;

        $this->pform[$this->cmap['a'] - $this->BPAD] = array(
            'ﺍ',
            'ﺍ',
            'ﺍ',
            'ﺎ',
            $this->WDBEG
        );
        $this->pform[$this->cmap['e'] - $this->BPAD] = array(
            'ﻩ',
            'ﻩ',
            'ﻩ',
            'ﻪ',
            $this->WDBEG
        );
        $this->pform[$this->cmap['b'] - $this->BPAD] = array(
            'ﺏ',
            'ﺑ',
            'ﺒ',
            'ﺐ',
            $this->NOBEG
        );
        $this->pform[$this->cmap['p'] - $this->BPAD] = array(
            'ﭖ',
            'ﭘ',
            'ﭙ',
            'ﭗ',
            $this->NOBEG
        );
        $this->pform[$this->cmap['t'] - $this->BPAD] = array(
            'ﺕ',
            'ﺗ',
            'ﺘ',
            'ﺖ',
            $this->NOBEG
        );
        $this->pform[$this->cmap['j'] - $this->BPAD] = array(
            'ﺝ',
            'ﺟ',
            'ﺠ',
            'ﺞ',
            $this->NOBEG
        );
        $this->pform[$this->CHEE - $this->BPAD] = array(
            'ﭺ',
            'ﭼ',
            'ﭽ',
            'ﭻ',
            $this->NOBEG
        );
        $this->pform[$this->cmap['x'] - $this->BPAD] = array(
            'ﺥ',
            'ﺧ',
            'ﺨ',
            'ﺦ',
            $this->NOBEG
        );
        $this->pform[$this->cmap['d'] - $this->BPAD] = array(
            'ﺩ',
            'ﺩ',
            'ﺪ',
            'ﺪ',
            $this->INBEG
        );
        $this->pform[$this->cmap['r'] - $this->BPAD] = array(
            'ﺭ',
            'ﺭ',
            'ﺮ',
            'ﺮ',
            $this->INBEG
        );
        $this->pform[$this->cmap['z'] - $this->BPAD] = array(
            'ﺯ',
            'ﺯ',
            'ﺰ',
            'ﺰ',
            $this->INBEG
        );
        $this->pform[$this->SZEE - $this->BPAD] = array(
            'ﮊ',
            'ﮊ',
            'ﮋ',
            'ﮋ',
            $this->INBEG
        );
        $this->pform[$this->cmap['s'] - $this->BPAD] = array(
            'ﺱ',
            'ﺳ',
            'ﺴ',
            'ﺲ',
            $this->NOBEG
        );
        $this->pform[$this->SHEE - $this->BPAD] = array(
            'ﺵ',
            'ﺷ',
            'ﺸ',
            'ﺶ',
            $this->NOBEG
        );
        $this->pform[$this->GHEE - $this->BPAD] = array(
            'ﻍ',
            'ﻏ',
            'ﻐ',
            'ﻎ',
            $this->NOBEG
        );
        $this->pform[$this->cmap['f'] - $this->BPAD] = array(
            'ﻑ',
            'ﻓ',
            'ﻔ',
            'ﻒ',
            $this->NOBEG
        );
        $this->pform[$this->cmap['q'] - $this->BPAD] = array(
            'ﻕ',
            'ﻗ',
            'ﻘ',
            'ﻖ',
            $this->NOBEG
        );
        $this->pform[$this->cmap['k'] - $this->BPAD] = array(
            'ﻙ',
            'ﻛ',
            'ﻜ',
            'ﻚ',
            $this->NOBEG
        );
        $this->pform[$this->cmap['g'] - $this->BPAD] = array(
            'ﮒ',
            'ﮔ',
            'ﮕ',
            'ﮓ',
            $this->NOBEG
        );
        $this->pform[$this->NGEE - $this->BPAD] = array(
            'ﯓ',
            'ﯕ',
            'ﯖ',
            'ﯔ',
            $this->NOBEG
        );
        $this->pform[$this->cmap['l'] - $this->BPAD] = array(
            'ﻝ',
            'ﻟ',
            'ﻠ',
            'ﻞ',
            $this->NOBEG
        );
        $this->pform[$this->cmap['m'] - $this->BPAD] = array(
            'ﻡ',
            'ﻣ',
            'ﻤ',
            'ﻢ',
            $this->NOBEG
        );
        $this->pform[$this->cmap['n'] - $this->BPAD] = array(
            'ﻥ',
            'ﻧ',
            'ﻨ',
            'ﻦ',
            $this->NOBEG
        );
        $this->pform[$this->cmap['h'] - $this->BPAD] = array(
            'ﻫ',
            'ﻫ',
            'ﻬ',
            'ﻬ',
            $this->NOBEG
        );

        $this->pform[$this->cmap['o'] - $this->BPAD] = array(
            'ﻭ',
            'ﻭ',
            'ﻮ',
            'ﻮ',
            $this->INBEG
        );
        $this->pform[$this->cmap['u'] - $this->BPAD] = array(
            'ﯗ',
            'ﯗ',
            'ﯘ',
            'ﯘ',
            $this->INBEG
        );
        $this->pform[$this->cmap['ö'] - $this->BPAD] = array(
            'ﯙ',
            'ﯙ',
            'ﯚ',
            'ﯚ',
            $this->INBEG
        );
        $this->pform[$this->cmap['ü'] - $this->BPAD] = array(
            'ﯛ',
            'ﯛ',
            'ﯜ',
            'ﯜ',
            $this->INBEG
        );
        $this->pform[$this->cmap['w'] - $this->BPAD] = array(
            'ﯞ',
            'ﯞ',
            'ﯟ',
            'ﯟ',
            $this->INBEG
        );
        $this->pform[$this->cmap['é'] - $this->BPAD] = array(
            'ﯤ',
            'ﯦ',
            'ﯧ',
            'ﯥ',
            $this->NOBEG
        );
        $this->pform[$this->cmap['i'] - $this->BPAD] = array(
            'ﻯ',
            'ﯨ',
            'ﯩ',
            'ﻰ',
            $this->NOBEG
        );
        $this->pform[$this->cmap['y'] - $this->BPAD] = array(
            'ﻱ',
            'ﻳ',
            'ﻴ',
            'ﻲ',
            $this->NOBEG
        );
        $this->pform[$this->HAMZA - $this->BPAD] = array(
            'ﺋ',
            'ﺋ',
            'ﺌ',
            'ﮌ',
            $this->NOBEG
        );
        $this->lsyn = $this->pform[$this->cmap['l'] - $this->BPAD];

    }

    public function getUyPFStr($str)
    {


        if (!$str) {
            return $str;
        }
        $syn = array();
        $tsyn = array();
        $bt = $this->WDBEG;
        $strArray = preg_split("//u", $str, -1, PREG_SPLIT_NO_EMPTY);
        $pfstr = "";
        $n = count($strArray);
        $i = 0;
        $j = 0;

        $pfwc = '\0'; // presentation form char
        $prevwc = '\0'; // previous char
        $ppfwc = '\0'; // previous presenation form char

        $pfwp = array();

        for ($i = 0; $i < $n; $i++) {
            $wc = hexdec(json_encode($strArray[$i]));

            if (($this->BPAD) <= $wc && $wc < ($this->BMAX)) {

                if (array_key_exists($wc - $this->BPAD, $this->pform)) {
                    $syn = $this->pform[$wc - $this->BPAD];
                } else {
                    $syn = array();
                }
                if ($syn) {

                    if ($bt == $this->WDBEG || $bt == $this->INBEG) {
                        $pfwc = $syn[0];

                    } else {
                        $pfwc = $syn[3];

                    }

                    // this means the previous letter was a joinable Uyghur
                    // letter
                    if ($bt != $this->WDBEG) {
                        $tsyn = $this->pform[$prevwc - $this->BPAD];

                        // special cases for LA and _LA
                        if ($ppfwc == $this->lsyn[0] && $wc == $this->cmap['a']) {
                            $pfwp[$j - 1] = $this->LA;
                            $bt = $this->WDBEG;
                            continue;
                        } elseif ($ppfwc == $this->lsyn[3] && $wc == $this->cmap['a']) {
                            $pfwp[$j - 1] = $this->_LA;
                            $bt = $this->WDBEG;
                            continue;
                        }

                        // update previous character
                        if ($ppfwc == $tsyn[0]) {
                            $pfwp[$j - 1] = $tsyn[1];
                        } elseif ($ppfwc == $tsyn[3]) {
                            $pfwp[$j - 1] = $tsyn[2];
                        }
                    }
                    $bt = $syn[4]; // we will need this in next round
                } else { // a non-Uyghur char in basic range

                    $pfwc = $strArray[$i];
                    $bt = $this->WDBEG;
                }
            } else { // not in basic Arabic range ( 0x0600-0x06FF )

                $pfwc = $strArray[$i];
                $bt = $this->WDBEG;
            }

            $pfwp[$j] = $pfwc;
            $ppfwc = $pfwc;
            $prevwc = $wc;
            $j++;
        }

        $pfstr = implode('', $pfwp);

        return $pfstr;
    }

    private function GetUy0600Char($aChar)
    {
        switch ($aChar) {
            case 'ﺏ' :
            case 'ﺑ' :
            case 'ﺒ' :
            case 'ﺐ' :
                return "ب";
            case 'ﭖ' :
            case 'ﭗ' :
            case 'ﭘ' :
            case 'ﭙ' :
                return "پ";
            case 'ﺕ' :
            case 'ﺖ' :
            case 'ﺗ' :
            case 'ﺘ' :
                return "ت";
            case 'ﺝ' :
            case 'ﺞ' :
            case 'ﺟ' :
            case 'ﺠ' :
                return "ج";
            case 'ﭺ' :
            case 'ﭻ' :
            case 'ﭼ' :
            case 'ﭽ' :
                return "چ";
            case 'ﺩ' :
            case 'ﺪ' :
                return "د";
            case 'ﺭ' :
            case 'ﺮ' :
                return "ر";
            case 'ﺯ' :
            case 'ﺰ' :
                return "ز";
            case 'ﺱ' :
            case 'ﺲ' :
            case 'ﺳ' :
            case 'ﺴ' :
                return "س";
            case 'ﺵ' :
            case 'ﺶ' :
            case 'ﺷ' :
            case 'ﺸ' :
                return "ش";
            case 'ﻑ' :
            case 'ﻒ' :
            case 'ﻓ' :
            case 'ﻔ' :
                return "ف";
            case 'ﻕ' :
            case 'ﻖ' :
            case 'ﻗ' :
            case 'ﻘ' :
                return "ق";
            case 'ﻙ' :
            case 'ﻚ' :
            case 'ﻛ' :
            case 'ﻜ' :
                return "ك";
            case 'ﮒ' :
            case 'ﮓ' :
            case 'ﮔ' :
            case 'ﮕ' :
                return "گ";
            case 'ﯓ' :
            case 'ﯔ' :
            case 'ﯕ' :
            case 'ﯖ' :
                return "ڭ";
            case 'ﻝ' :
            case 'ﻞ' :
            case 'ﻟ' :
            case 'ﻠ' :
                return "ل";
            case 'ﻡ' :
            case 'ﻢ' :
            case 'ﻣ' :
            case 'ﻤ' :
                return "م";
            case 'ﻥ' :
            case 'ﻦ' :
            case 'ﻧ' :
            case 'ﻨ' :
                return "ن";
            case 'ﯞ' :
            case 'ﯟ' :
                return "ۋ";
            case 'ﻱ' :
            case 'ﻲ' :
            case 'ﻳ' :
            case 'ﻴ' :
                return "ي";
            case 'ﮊ' :
            case 'ﮋ' :
                return "ژ";
            case 'ﺥ' :
            case 'ﺦ' :
            case 'ﺧ' :
            case 'ﺨ' :
                return "خ";
            case 'ﻍ' :
            case 'ﻎ' :
            case 'ﻏ' :
            case 'ﻐ' :
                return "غ";
            case 'ﯪ' :
            case 'ﯫ' :
                return "ئا";
            case 'ﺍ' :
            case 'ﺎ' :
                return "ا";
            case 'ﯬ' :
            case 'ﯭ' :
                return "ئە";
            case 'ﻩ' :
            case 'ﻪ' :
                return "ە";
            case 'ﯮ' :
            case 'ﯯ' :
                return "ئو";
            case 'ﻭ' :
            case 'ﻮ' :
                return "و";
            case 'ﯰ' :
            case 'ﯱ' :
                return "ئۇ";
            case 'ﯗ' :
            case 'ﯘ' :
                return "ۇ";
            case 'ﯲ' :
            case 'ﯳ' :
                return "ئۆ";

            case 'ﯙ' :
            case 'ﯚ' :

                return "ۆ";

            case 'ﯴ' :
            case 'ﯵ' :

                return "ئۈ";
            case 'ﯛ' :
            case 'ﯜ' :
                return "ۈ";
            case 'ﯶ' :
            case 'ﯷ' :
            case 'ﯸ' :
                return "ئې";
            case 'ﯤ' :
            case 'ﯥ' :
            case 'ﯦ' :
            case 'ﯧ' :
                return "ې";
            case 'ﯹ' :
            case 'ﯺ' :
            case 'ﯻ' :
                return "ئى";
            case 'ﻯ' :
            case 'ﯨ' :
            case 'ﯩ' :
            case 'ﻰ' :
                return "ى";
            case 'ﮪ' :
            case 'ﮫ' :
            case 'ﮬ' :
            case 'ﮭ' :
            case 'ﻫ' :
            case 'ﻬ' :
                return "ھ";
            case 'ﺋ' :
            case 'ﺌ' :
                return "ئ";
            case 'ﻻ' :
            case 'ﻼ' :
                return "لا";
            case '−' :
                return "-";

        }

        return $aChar;
    }

    public function getUyBRStr($text)
    {

        if ($text) {
            $strArray = preg_split("//u", $text, -1, PREG_SPLIT_NO_EMPTY);
            $n = count($strArray);
            $res = "";

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
        //$text = " ".$text;
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
            " "
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
            " "
        );
        $text = str_replace($uy, $uly, $text);
        return $text;
    }


}

?>
