<div id="calculatrice_area" style="display: none;">
    <i class="ace-icon fa fa-calculator bigger-110" style="margin:5px; margin-left:20px;"></i>
    <span class="bigger-110" style="margin:5px;">Calculatrice</span>

    <input class="result_calculator" type="text" id="resultat_calcule" value="" readonly="true" /><br>
    <table style="margin-bottom: 0px; border: 1px solid #ddd;">
        <th>

            <input class="number_button_reset" type="reset" value="ON/C" onClick="setVide()" size="30">
            <input class="number_button" type="button" value="/" onClick="ajouter('/')" size="30"><br>

            <input class="number_button" type="button" value="7" onClick="ajouter('7')" size="30">
            <input class="number_button" type="button" value="8" onClick="ajouter('8')" size="30">
            <input class="number_button" type="button" value="9" onClick="ajouter('9')" size="30">
            <input class="number_button" type="button" value="x" onClick="ajouter('*')" size="30"><br>

            <input class="number_button" type="button" value="4" onClick="ajouter('4')" size="30">
            <input class="number_button" type="button" value="5" onClick="ajouter('5')" size="30">
            <input class="number_button" type="button" value="6" onClick="ajouter('6')" size="30">
            <input class="number_button" type="button" value="-" onClick="ajouter('-')" size="30"><br>

            <input class="number_button" type="button" value="1" onClick="ajouter('1')" size="30">
            <input class="number_button" type="button" value="2" onClick="ajouter('2')" size="30">
            <input class="number_button" type="button" value="3" onClick="ajouter('3')" size="30">
            <input class="number_button" type="button" value="+" onClick="ajouter('+')" size="30"><br>

            <input class="number_button_zero" type="button" value="0" onClick="ajouter('0')" size="30">
            <input class="number_button" type="button" value="." onClick="ajouter('.')" size="30">
            <input class="number_button" type="button" value="=" onClick="calcul()" size="30"><br>
        </th>
    </table>
</div>

<script  type="text/javascript">

    function verification(entree) {
        var car = "1234567890[]()+-.*,/";
        for (var i = 0; i < entree.length; i++) {
            if (car.indexOf(entree.charAt(i)) < 0)
                return false;
        }
        return true;
    }

    function setVide() {
        $('#resultat_calcule').val('');
    }

    function calcul() {
        var a = 0;
        if (verification($('#resultat_calcule').val()))
            a = eval($('#resultat_calcule').val().replace(/,/g, '.'));
        $('#resultat_calcule').val(a);

        //close bootbox and affect result on input
        $(".bootbox").modal("hide");
        afterClose();
    }

    function ajouter(caracteres) {
        var affiche = $('#resultat_calcule').val() + caracteres;
        $('#resultat_calcule').val(affiche);
    }

    function supprimer() {
        var affiche = $('#resultat_calcule').val();
        affiche = affiche.substring(0, affiche.length - 1);
        $('#resultat_calcule').val(affiche);
    }

</script>

<script  type="text/javascript">
    document.addEventListener('keydown', function (event) {
        applyChange(event);
    });

    function applyChange(e) {
        if (e.keyCode == true) {
            var key = e.keyCode;
        } else {
            var key = e.which;
        }

        switch (key) {
            // Enter
            case 13:
                calcul();
                break;
                // Delete
            case 46:
                supprimer();
                break;
                // numpad 0
            case 96:
                ajouter('0');
                break;
                // 0
            case 48:
                ajouter('0');
                break;
                // numpad 1
            case 97:
                ajouter('1');
                break;
                // 1
            case 49:
                ajouter('1');
                break;
                // numpad 2
            case 98:
                ajouter('2');
                break;
                // 2
            case 50:
                ajouter('2');
                break;
                // numpad 3
            case 99:
                ajouter('3');
                break;
                // 3
            case 51:
                ajouter('3');
                break;
                // numpad 4
            case 100:
                ajouter('4');
                break;
                // 4
            case 52:
                ajouter('4');
                break;
                // numpad 5
            case 101:
                ajouter('5');
                break;
                // 5
            case 53:
                ajouter('5');
                break;
                // numpad 6
            case 102:
                ajouter('6');
                break;
                // 6
            case 54:
                ajouter('6');
                break;
                // numpad 7
            case 103:
                ajouter('7');
                break;
                // 7
            case 55:
                ajouter('7');
                break;
                // numpad 8
            case 104:
                ajouter('8');
                break;
                // 8
            case 56:
                ajouter('8');
                break;
                // numpad 9
            case 105:
                ajouter('9');
                break;
                // 9
            case 57:
                ajouter('9');
                break;
                // multiply
            case 106:
                ajouter('*');
                break;
                // add
            case 107:
                ajouter('+');
                break;
                // subtract
            case 109:
                ajouter('-');
                break;
                // decimal point
            case 110:
                ajouter('.');
                break;
                // divide
            case 111:
                ajouter('/');
                break;
        }
    }

</script>


<style>

    .number_button{font-weight: bold; font-size: 22px; width: 60px; height: 60px}
    .number_button_zero{font-weight: bold; font-size: 22px; width: 123px; height: 60px}
    .result_calculator{width: 100%; height: 45px; font-size: 24px; text-align: right; margin-bottom: 5px;}
    .number_button_reset{font-weight: bold; font-size: 22px; width: 187px; height: 60px}

</style>