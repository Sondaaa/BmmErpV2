<?php

class chiffreToLettre {

    public static function cvnbst($montant, $devise1 = '', $devise2 = '') {

        if (empty($devise1))
            $devise_1 = 'Dinars';
        else
            $devise_1 = $devise1;
        if (empty($devise2))
            $devise_2 = 'Millimes';
        else
            $devise_2 = $devise2;
        $valeur_entiere = intval($montant);
        $valeur_decimal = ($montant - $valeur_entiere) * 1000;
        $dix_c = intval(round(round($valeur_decimal % 100) / 10));
        $decimal_unite_c = intval(round(round($valeur_decimal % 10)));
        $cent_c = intval(($valeur_decimal % 1000 ) / 100);

        $unite[1] = $valeur_entiere % 10;
        $dix[1] = intval($valeur_entiere % 100 / 10);
        $cent[1] = intval($valeur_entiere % 1000 / 100);
        $unite[2] = intval($valeur_entiere % 10000 / 1000);
        $dix[2] = intval($valeur_entiere % 100000 / 10000);
        $cent[2] = intval($valeur_entiere % 1000000 / 100000);
        $unite[3] = intval($valeur_entiere % 10000000 / 1000000);
        $dix[3] = intval($valeur_entiere % 100000000 / 10000000);
        $cent[3] = intval($valeur_entiere % 1000000000 / 100000000);
        $chif = array('', 'un', 'deux', 'trois', 'quatre', 'cinq', 'six', 'sept', 'huit', 'neuf', 'dix', 'onze', 'douze', 'treize', 'quatorze', 'quinze', 'seize', 'dix sept', 'dix huit', 'dix neuf');
        $secon_c = '';
        $trio_c = '';
        $prim_c = '';
        for ($i = 1; $i <= 3; $i++) {
            $prim[$i] = '';
            $secon[$i] = '';
            $trio[$i] = '';
            if ($dix[$i] == 0) {
                $secon[$i] = '';
                $prim[$i] = $chif[$unite[$i]];
            } else if ($dix[$i] == 1) {
                $secon[$i] = '';
                $prim[$i] = $chif[($unite[$i] + 10)];
            } else if ($dix[$i] == 2) {
                if ($unite[$i] == 1) {
                    $secon[$i] = 'vingt et ';
                    $prim[$i] = $chif[$unite[$i]];
                } else {
                    $secon[$i] = 'vingt';
                    $prim[$i] = $chif[$unite[$i]];
                }
            } else if ($dix[$i] == 3) {
                if ($unite[$i] == 1) {
                    $secon[$i] = 'trente et ';
                    $prim[$i] = $chif[$unite[$i]];
                } else {
                    $secon[$i] = 'trente';
                    $prim[$i] = $chif[$unite[$i]];
                }
            } else if ($dix[$i] == 4) {
                if ($unite[$i] == 1) {
                    $secon[$i] = 'quarante et ';
                    $prim[$i] = $chif[$unite[$i]];
                } else {
                    $secon[$i] = 'quarante';
                    $prim[$i] = $chif[$unite[$i]];
                }
            } else if ($dix[$i] == 5) {
                if ($unite[$i] == 1) {
                    $secon[$i] = 'cinquante et ';
                    $prim[$i] = $chif[$unite[$i]];
                } else {
                    $secon[$i] = 'cinquante';
                    $prim[$i] = $chif[$unite[$i]];
                }
            } else if ($dix[$i] == 6) {
                if ($unite[$i] == 1) {
                    $secon[$i] = 'soixante et ';
                    $prim[$i] = $chif[$unite[$i]];
                } else {
                    $secon[$i] = 'soixante';
                    $prim[$i] = $chif[$unite[$i]];
                }
            } else if ($dix[$i] == 7) {
                if ($unite[$i] == 1) {
                    $secon[$i] = 'soixante et ';
                    $prim[$i] = $chif[$unite[$i] + 10];
                } else {
                    $secon[$i] = 'soixante';
                    $prim[$i] = $chif[$unite[$i] + 10];
                }
            } else if ($dix[$i] == 8) {
                if ($unite[$i] == 1) {
                    $secon[$i] = 'quatre-vingts et ';
                    $prim[$i] = $chif[$unite[$i]];
                } else {
                    $secon[$i] = 'quatre-vingt';
                    $prim[$i] = $chif[$unite[$i]];
                }
            } else if ($dix[$i] == 9) {
                if ($unite[$i] == 1) {
                    $secon[$i] = 'quatre-vingts et ';
                    $prim[$i] = $chif[$unite[$i] + 10];
                } else {
                    $secon[$i] = 'quatre-vingts';
                    $prim[$i] = $chif[$unite[$i] + 10];
                }
            }
            if ($cent[$i] == 1)
                $trio[$i] = 'cent';
            else if ($cent[$i] != 0 || $cent[$i] != '')
                $trio[$i] = $chif[$cent[$i]] . ' cents';
        }

        $chif2 = array('', 'dix', 'vingt', 'trente', 'quarante', 'cinquante', 'soixante', 'soixante-dix', 'quatre-vingts', 'quatre-vingts dix');

        //Chiffre aprés virgule = 2  (.... teste sur 1 )
//        $secon_c = $chif2[$dix_c];
        //Chiffre aprés virgule = 3
        if ($dix_c == 0) {
            $secon_c = '';
            $prim_c = $chif[$decimal_unite_c];
        } else if ($dix_c == 1) {
            $secon_c = '';
            $prim_c = $chif[($decimal_unite_c + 10)];
        } else if ($dix_c == 2) {
            if ($decimal_unite_c == 1) {
                $secon_c = 'vingt et ';
                $prim_c = $chif[$decimal_unite_c];
            } else {
                $secon_c = 'vingt';
                $prim_c = $chif[$decimal_unite_c];
            }
        } else if ($dix_c == 3) {
            if ($decimal_unite_c == 1) {
                $secon_c = 'trente et ';
                $prim_c = $chif[$decimal_unite_c];
            } else {
                $secon_c = 'trente';
                $prim_c = $chif[$decimal_unite_c];
            }
        } else if ($dix_c == 4) {
            if ($decimal_unite_c == 1) {
                $secon_c = 'quarante et ';
                $prim_c = $chif[$decimal_unite_c];
            } else {
                $secon_c = 'quarante';
                $prim_c = $chif[$decimal_unite_c];
            }
        } else if ($dix_c == 5) {
            if ($decimal_unite_c == 1) {
                $secon_c = 'cinquante et ';
                $prim_c = $chif[$decimal_unite_c];
            } else {
                $secon_c = 'cinquante';
                $prim_c = $chif[$decimal_unite_c];
            }
        } else if ($dix_c == 6) {
            if ($decimal_unite_c == 1) {
                $secon_c = 'soixante et ';
                $prim_c = $chif[$decimal_unite_c];
            } else {
                $secon_c = 'soixante';
                $prim_c = $chif[$decimal_unite_c];
            }
        } else if ($dix_c == 7) {
            if ($decimal_unite_c == 1) {
                $secon_c = 'soixante et ';
                $prim_c = $chif[$decimal_unite_c + 10];
            } else {
                $secon_c = 'soixante';
                $prim_c = $chif[$decimal_unite_c + 10];
            }
        } else if ($dix_c == 8) {
            if ($decimal_unite_c == 1) {
                $secon_c = 'quatre-vingts et ';
                $prim_c = $chif[$decimal_unite_c];
            } else {
                $secon_c = 'quatre-vingt';
                $prim_c = $chif[$decimal_unite_c];
            }
        } else if ($dix_c == 9) {
            if ($decimal_unite_c == 1) {
                $secon_c = 'quatre-vingts et ';
                $prim_c = $chif[$decimal_unite_c + 10];
            } else {
                $secon_c = 'quatre-vingts';
                $prim_c = $chif[$decimal_unite_c + 10];
            }
        }

        $secon_c = $secon_c . ' ' . $prim_c;













        if ($cent_c == 1)
            $trio_c = 'cent';
        else if ($cent_c != 0 || $cent_c != '')
            $trio_c = $chif[$cent_c] . ' cents';
        $fin = '';
        if (($cent[3] == 0 || $cent[3] == '') && ($dix[3] == 0 || $dix[3] == '') && ($unite[3] == 1))
            $fin = $trio[3] . '  ' . $secon[3] . ' ' . $prim[3] . ' million ';
        else if (($cent[3] != 0 && $cent[3] != '') || ($dix[3] != 0 && $dix[3] != '') || ($unite[3] != 0 && $unite[3] != ''))
            $fin = $trio[3] . ' ' . $secon[3] . ' ' . $prim[3] . ' millions ';
        if (($cent[2] == 0 || $cent[2] == '') && ($dix[2] == 0 || $dix[2] == '') && ($unite[2] == 1))
            if ($fin != '')
                $fin = $fin . ' et Milles ';
            else
                $fin = 'Milles';
        else if (($cent[2] != 0 && $cent[2] != '') || ($dix[2] != 0 && $dix[2] != '') || ($unite[2] != 0 && $unite[2] != ''))
            if ($fin != '')
                $fin = $fin . ' et ' . $trio[2] . ' ' . $secon[2] . ' ' . $prim[2] . ' Milles ';
            else
                $fin = $trio[2] . ' ' . $secon[2] . ' ' . $prim[2] . ' Milles ';
        if (($cent[1] == 0 || $cent[1] == '') && ($dix[1] == 0 || $dix[1] == '') && ($unite[1] == 1))
            if ($fin != '')
                $fin = $fin . ' et Dinars ';
            else
                $fin = 'Dinars';
        else if (($cent[1] != 0 && $cent[1] != '') || ($dix[1] != 0 && $dix[1] != '') || ($unite[1] != 0 && $unite[1] != ''))
            if ($fin != '')
                $fin = $fin . ' et ' . $trio[1] . ' ' . $secon[1] . ' ' . $prim[1];
            else
                $fin = $trio[1] . ' ' . $secon[1] . ' ' . $prim[1];

        $fin = $fin . ' ' . $devise_1 . ' ';

        if (($cent_c == '0' || $cent_c == '') && ($dix_c == '0' || $dix_c == '')) {
            if ($fin == '')
                $fin = $fin . 'zero ' . $devise_2;
            else
                $fin = $fin . ' et zero ' . $devise_2;
        }
        else
        if ($fin == '')
            $fin = $fin . $trio_c . ' ' . $secon_c . ' ' . $devise_2;
        else
            $fin = $fin . ' et ' . $trio_c . ' ' . $secon_c . ' ' . $devise_2;

        return $fin;
    }

    public static function convertToLetter($number) {
        $convert = explode('.', $number);
        $num[17] = array('zero', 'un', 'deux', 'trois', 'quatre', 'cinq', 'six', 'sept', 'huit',
            'neuf', 'dix', 'onze', 'douze', 'treize', 'quatorze', 'quinze', 'seize');

        $num[100] = array(20 => 'vingt', 30 => 'trente', 40 => 'quarante', 50 => 'cinquante',
            60 => 'soixante', 70 => 'soixante-dix', 80 => 'quatre-vingt', 90 => 'quatre-vingt-dix');

        if (isset($convert[1]) && $convert[1] != '') {

            if ($convert[1][0] == 0 || strlen($convert[1]) > 1) {
                $convert[1] = (int) $convert[1];
            } else {
                $convert[1] = (int) ($convert[1] . '0');
            }

            return self::convertToLetter($convert[0]) . '$$$' . self::convertToLetter($convert[1]);
        }
        if ($number < 0)
            return 'moins ' . self::convertToLetter(-$number);
        if ($number < 17) {
            return $num[17][$number];
        } elseif ($number < 20) {
            return 'dix-' . self::convertToLetter($number - 10);
        } elseif ($number < 100) {
            if ($number % 10 == 0) {
                return $num[100][$number];
            } elseif (substr($number, -1) == 1) {
                if (((int) ($number / 10) * 10) < 70) {
                    return self::convertToLetter((int) ($number / 10) * 10) . '-et-un';
                } elseif ($number == 71) {
                    return 'soixante-et-onze';
                } elseif ($number == 81) {
                    return 'quatre-vingt-un';
                } elseif ($number == 91) {
                    return 'quatre-vingt-onze';
                }
            } elseif ($number < 70) {
                return self::convertToLetter($number - $number % 10) . '-' . self::convertToLetter($number % 10);
            } elseif ($number < 80) {
                return self::convertToLetter(60) . '-' . self::convertToLetter($number % 20);
            } else {
                return self::convertToLetter(80) . '-' . self::convertToLetter($number % 20);
            }
        } elseif ($number == 100) {
            return 'cent';
        } elseif ($number < 200) {
            return self::convertToLetter(100) . ' ' . self::convertToLetter($number % 100);
        } elseif ($number < 1000) {
            return self::convertToLetter((int) ($number / 100)) . ' ' . self::convertToLetter(100) . ($number % 100 > 0 ? ' ' . self::convertToLetter($number % 100) : '');
        } elseif ($number == 1000) {
            return 'mille';
        } elseif ($number < 2000) {
            return self::convertToLetter(1000) . ' ' . self::convertToLetter($number % 1000) . ' ';
        } elseif ($number < 1000000) {
            return self::convertToLetter((int) ($number / 1000)) . ' ' . self::convertToLetter(1000) . ($number % 1000 > 0 ? ' ' . self::convertToLetter($number % 1000) : '');
        } elseif ($number == 1000000) {
            return 'millions';
        } elseif ($number < 2000000) {
            return self::convertToLetter(1000000) . ' ' . self::convertToLetter($number % 1000000);
        } elseif ($number < 1000000000) {
            return self::convertToLetter((int) ($number / 1000000)) . ' ' . self::convertToLetter(1000000) . ($number % 1000000 > 0 ? ' ' . self::convertToLetter($number % 1000000) : '');
        }
    }

    public static function cvnbst1($nombre) {
        $nb1 = Array('un', 'deux', 'trois', 'quatre', 'cinq', 'six', 'sept', 'huit', 'neuf', 'dix', 'onze', 'douze', 'treize', 'quatorze', 'quinze', 'seize', 'dix-sept', 'dix-huit', 'dix-neuf');

        $nb2 = Array('vingt', 'trente', 'quarante', 'cinquante', 'soixante', 'soixante', 'quatre-vingt', 'quatre-vingt');

        # Décomposition du chiffre
        # Séparation du nombre entier et des décimales
        if (preg_match("/\b,\b/i", $nombre)) {
            $nombre = explode(',', $nombre);
        } else {
            $nombre = explode('.', $nombre);
        }
        $nmb = $nombre[0];

        # Décomposition du nombre entier par tranche de 3 nombre (centaine, dizaine, unitaire)
        $i = 0;
        die($nmb);
        while (strlen($nmb) > 0) {
            $nbtmp[$i] = substr($nmb, -3);
            if (strlen($nmb) > 3) {
                $nmb = substr($nmb, 0, strlen($nmb) - 3);
            } else {
                $nmb = '';
            }
            $i++;
        }
        $nblet = '';
        ## Taitement du côté entier
        for ($i = 1; $i >= 0; $i--) {
            if (strlen(trim($nbtmp[$i])) == 3) {
                $ntmp = substr($nbtmp[$i], 1);

                if (substr($nbtmp[$i], 0, 1) <> 1 && substr($nbtmp[$i], 0, 1) <> 0) {
                    $nblet.=$nb1[substr($nbtmp[$i], 0, 1) - 1];
                    if ($ntmp <> 0) {
                        $nblet.=' cent ';
                    } else {
                        $nblet.=' cents ';
                    }
                } elseif (substr($nbtmp[$i], 0, 1) <> 0) {
                    $nblet.='cent ';
                }
            } else {
                $ntmp = $nbtmp[$i];
            }

            if ($ntmp > 0 && $ntmp < 20) {
                if (!($i == 1 && $nbtmp[$i] == 1)) {
                    $nblet.=$nb1[$ntmp - 1] . ' ';
                }
            }

            if ($ntmp >= 20 && $ntmp < 60) {
                switch (substr($ntmp, 1, 1)) {
                    case 1 : $sep = ' et ';
                        break;
                    case 0 : $sep = '';
                        break;
                    default: $sep = '-';
                }
                $nblet.=$nb2[substr($ntmp, 0, 1) - 2] . $sep . $nb1[substr($ntmp, 1, 1) - 1] . ' ';
            }

            if ($ntmp >= 60 && $ntmp < 80) {
                $nblet.=$nb2[4];
                switch (substr($ntmp, 1, 1)) {
                    case 1 : $sep = ' et ';
                        break;
                    case 0 : $sep = '';
                        break;
                    default: $sep = '-';
                }

                if (substr($ntmp, 0, 1) <> 7) {
                    $nblet.=$sep . $nb1[substr($ntmp, 1, 1) - 1] . ' ';
                } else {
                    if (substr($ntmp, 1, 1) + 9 == 9)
                        $sep = '-';
                    $nblet.=$sep . $nb1[substr($ntmp, 1, 1) + 9] . ' ';
                }
            }

            if ($ntmp >= 80 && $ntmp < 100) {
                $nblet.=$nb2[6];
                switch (substr($ntmp, 1, 1)) {
                    case 1 : $sep = ' et ';
                        break;
                    case 0 : $sep = '';
                        break;
                    default: $sep = '-';
                }

                //if(substr($ntmp,1,1)<>0){
                if (substr($ntmp, 0, 1) <> 9) {
                    $nblet.=$sep . $nb1[substr($ntmp, 1, 1) - 1];
                    if (substr($ntmp, 1, 1) == 0)
                        $nblet.='s';
                }else {
                    if (substr($ntmp, 1, 1) == 0)
                        $sep = '-';
                    $nblet.=$sep . $nb1[substr($ntmp, 1, 1) + 9];
                }
                $nblet.=' ';
                //}elseif(substr($ntmp,0,1)<>9){
                //    $nblet.='s ';
                //}else{
                //    $nblet.=' ';
                //}
            }

            if ($i == 1 && $nbtmp[$i] <> 0) {
                if ($nbtmp[$i] > 1) {
                    $nblet.='milles ';
                } else {
                    $nblet.='mille ';
                }
            }
        }

        if ($nombre[0] > 1)
            $nblet.='euros ';
        if ($nombre[0] == 1)
            $nblet.='euro ';

        ## Traitement du côté décimale
        if ($nombre[0] > 0 && $nombre[1] > 0)
            $nblet.=' et ';
        $ntmp = substr($nombre[1], 0, 2);
        if (!empty($ntmp)) {
            if ($ntmp > 0 && $ntmp < 20) {
                $nblet.=$nb1[$ntmp - 1] . ' ';
            }

            if ($ntmp >= 20 && $ntmp < 60) {
                switch (substr($ntmp, 1, 1)) {
                    case 1 : $sep = ' et ';
                        break;
                    case 0 : $sep = '';
                        break;
                    default: $sep = '-';
                }
                $nblet.=$nb2[substr($ntmp, 0, 1) - 2] . $sep . $nb1[substr($ntmp, 1, 1) - 1] . ' ';
            }

            if ($ntmp >= 60 && $ntmp < 80) {
                $nblet.=$nb2[4];
                switch (substr($ntmp, 1, 1)) {
                    case 1 : $sep = ' et ';
                        break;
                    case 0 : $sep = '';
                        break;
                    default: $sep = '-';
                }

                if (substr($ntmp, 0, 1) <> 7) {
                    $nblet.=$sep . $nb1[substr($ntmp, 1, 1) - 1] . ' ';
                } else {
                    if (substr($ntmp, 1, 1) + 9 == 9)
                        $sep = '-';
                    $nblet.=$sep . $nb1[substr($ntmp, 1, 1) + 9] . ' ';
                }
            }

            if ($ntmp >= 80 && $ntmp < 100) {
                $nblet.=$nb2[6];
                switch (substr($ntmp, 1, 1)) {
                    case 0 : $sep = '';
                        break;
                    default: $sep = '-';
                }

                if (substr($ntmp, 0, 1) <> 9) {
                    $nblet.=$sep . $nb1[substr($ntmp, 1, 1) - 1];
                    if (substr($ntmp, 1, 1) == 0)
                        $nblet.='s';
                }else {
                    if (substr($ntmp, 1, 1) == 0)
                        $sep = '-';
                    $nblet.=$sep . $nb1[substr($ntmp, 1, 1) + 9];
                }
                $nblet.=' ';
            }

            if ($ntmp <> 0 && !empty($ntmp)) {
                if ($ntmp > 1) {
                    $nblet.='cents ';
                } else {
                    $nblet.='cent ';
                }
            }
        }

        return $nblet;
    }

}

?>
