<?php
$array_code = array();
$i = 0;
foreach ($plan_importe as $j_i) {
    $array_code[$i] = $j_i->getNumerocompte();
    $i++;
}
?>


<b style="font-size: 16px;">Plan Comptables :</b>
<select id="pickList_journal" multiple="multiple" size="8">
    <?php foreach ($plancomptables as $plan) : ?>
        <?php if (in_array($plan->getNumerocompte(), $array_code)): ?>
            <option name="list_plan" value="<?php echo $plan->getId() ?>"><?php echo $plan->getNumerocompte() . ' ' . $plan->getLibelle() ?></option>
        <?php endif; ?>
    <?php endforeach; ?>
</select>

<?php if ($plan_importe->count() != 0): ?>
    <div class="row" style="margin-top: 15px;">
        <div class="col-xs-12">
            <div class="table-header" style="margin-bottom: 0px;">
                Liste des comptes comptables du dossier : <?php echo $dossier->getCode() . ' - ' . $dossier->getRaisonsociale(); ?> / Exercice : <?php echo $exercice->getLibelle(); ?>
            </div>
            <div class="col-xs-12" style="border: 1px solid #307ECC; padding-top: 10px;">
                <div style="height: 202px; overflow: auto;">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th style="text-align: center; width: 10%;">Numéro</th>
                                <th style="width: 65%;">Intitulé du Compte</th>
                                <th style="text-align: center; width: 25%;">Classe </th>
                                <!--<th style="text-align: center; width: 25%;">Standard </th>-->

                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($plan_importe as $j_i): ?>
                                <tr>
                                    <td style="text-align: center;"><?php echo $j_i->getNumerocompte(); ?></td>
                                    <td><?php echo $j_i->getLibelle(); ?></td>
                                    <td style="text-align: center;"><?php echo $j_i->getClassecompte()->getLibelle(); ?></td>
                                    <!--<td style="text-align: center;"><?php echo $j_i->getStandard(); ?></td>-->
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>