<?php

class FormatRib {

    public static function Show($rib) {

        $html = '<table class="rib_compte">
                    <tr><td class="td_before_rib" colspan="' . strlen(trim($rib)) . '"></td></tr>
                    <tr>';

        for ($j = 0; $j < strlen(trim($rib)); $j++):
            if ($rib[$j] != ' ')
                $html.='<td class="td_rib">' . $rib[$j] . '</td>';
        endfor;

        $html.='</tr></table>';

        return $html;
    }

    public static function ShowZone($rib) {
        $rib = trim($rib);

        $part_1 = substr($rib, 0, 2);
        $part_2 = substr($rib, 2, 3);
        $part_3 = substr($rib, 5, 13);
        $part_4 = substr($rib, 18, 2);

        $html = '<table class="rib_compte" style="margin-bottom:0px;">
                    <tr>';

        $html.='<td style="width: 15%;">' . $part_1 . '</td>';
        $html.='<td style="width: 15%;">' . $part_2 . '</td>';
        $html.='<td style="width: 55%;">' . $part_3 . '</td>';
        $html.='<td style="width: 15%;">' . $part_4 . '</td>';

        $html.='</tr></table>';

        return $html;
    }

}

?>