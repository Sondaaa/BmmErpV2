<div id="sf_admin_container">
    <h1 id="replacediv"> Régime Horaire
        <small>
            <i class="ace-icon fa fa-angle-double-right"></i>
            Modifier Régime Horarie -- <?php echo $regimehoraire->getLibelle(); ?>
        </small>
    </h1>
</div>
<div class="col-xs-12" ng-controller="CtrlRessourcehumaine" ng-init="initialiserRegime()">
    <table class="table table-bordered table-hover">
        <thead>
        <input id="nbrheue" type="hidden" value="<?php echo $regimehoraire->getNbheure(); ?>">
        <tr style="font-weight: bold; background-color: #ECECEC;">
            <td style="width: 15%;" ></td>
            <td style="width: 10%;">Lundi</td>
            <td style="width: 10%;">Mardi</td>
            <td style="width: 10%;">Mercredi</td>
            <td style="width: 10%;">Jeudi</td>
            <td style="width: 10%;">Vendredi</td>
            <td style="width: 10%;">Samedi</td>
            <td style="width: 10%;">Dimanche</td>
            <th style="width: 7%;">Total</th>
            <th style="width: 8%;">Nombre Heure Régime</th>
        </tr>
        </thead>
        <tbody>
            <tr>
                <td style="width: 30%;">Nbr Heures Par Jour </td>
                <?php for ($i = 1; $i <= 7; $i++): ?>
                    <td style="width: 10%;text-align: center">
                        <input class="grille_regime_input align-center" type="text" name="jour_heure" id="nbrheur_<?php echo $i; ?>" onchange="verifregime()">
                        <input type="hidden" value="<?php echo $i ?>" name="jour">
                    </td>
                <?php endfor; ?>
                <td style="width: 8%;text-align: center"><input type="text" id="total" class="align-center"></td>
                <td style="width: 8%;text-align: center"><?php echo $regimehoraire->getNbheure() . " Heures"; ?></td>
            </tr>
            <tr>
                <td style="width: 30%;">J.R</td>
                <?php for ($i = 1; $i <= 7; $i++): ?>
                    <td style="text-align: center;width: 10%;">
                        <input class="grille_regime_input" type="checkbox" name="jourr" id="jr_<?php echo $i; ?>" onchange="testerJourR('<?php echo $i; ?>')"/>
                    </td>
                <?php endfor; ?>
            </tr>

        </tbody>
    </table>

</div>
<script  type="text/javascript">
    function testerJourR(i) {
        if ($("#jr_" + i).is(':checked')) {
            $('#nbrheur_' + i).val('0');
            $('#nbrheur_' + i).addClass("disabledbutton");
        } else {
            $('#nbrheur_' + i).removeClass("disabledbutton");
            $('#nbrheur_' + i).val('');
        }
    }


    function verifregime() {
        var somme = 0;
        for (var i = 1; i <= 7; i++) {
            if ($('#nbrheur_' + i).val() != '') {
                var nbr = $('#nbrheur_' + i).val();
                var somme = parseFloat(parseFloat(somme) + parseFloat(nbr));
            }
        }
        $('#total').val(somme);
    }
</script>
<style>
    .grille_regime_input{max-width: 150px;}

</style>