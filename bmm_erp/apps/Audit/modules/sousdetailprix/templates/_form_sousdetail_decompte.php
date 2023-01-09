<fieldset <?php if ($details->getEtat() == "2") { ?> class="disabledbutton" <?php } ?>>
    <div class="col-lg-9">
        <table>
            <thead>
                <tr>
                    <th style="width: 80px">N° du prix</th>
                    <th>DESIGNATION DES TRAVAUX</th>
                    <th>UNITE</th>
                    <th>Q.</th>
                    <th>
            <table style="text-align: center">
                <tr>
                    <td colspan="3">Quantité</td>
                </tr>
                <tr>
                    <td>Antérieur</td>
                    <td>Du Mois</td>
                    <td>Cumulé</td>
                </tr>
            </table>
            </th>
            <th>Prix unitaire<br>HTVA</th>
            <th>Prix Total<br>HTVA</th>
            </tr>
            </thead>
            <tbody>
                <?php
                $sdetails = new Sousdetailprix();
                foreach ($SousDetails as $dd) {
                    $sdetails = $dd;
                    ?>
                    <tr>
                        <td><?php echo $sdetails->getNordre() ?></td>
                        <td><?php echo $sdetails->getDesignation() ?></td>
                        <td><?php echo $sdetails->getUnitemarche() ?></td>
                        <td><?php echo $sdetails->getQuetiteant() ?></td>
                        <td>
                            <?php if ($sdetails->getQuetiteant() > 0) { ?>
                                <table style="text-align: center">
                                    <tr>
                                        <td><input class="disabledbutton" type="text" id="qteant<?php echo $sdetails->getId() ?>" value="<?php echo $details->getMntAntirieur($details->getIdLots(), $sdetails->getNordre()); ?>"></td>
                                        <td><input ng-model="qtedumois<?php echo $sdetails->getId() ?>" ng-value="<?php echo $sdetails->getQteDuMois(); ?>" value="<?php $sdetails->getQteDuMois(); ?>" type="text" id="qtedumois<?php echo $sdetails->getId() ?>" ng-change="CalculerCumule(<?php echo $sdetails->getId() ?>, '<?php echo $sdetails->getQuetiteant() ?>', '<?php echo $sdetails->getPrixunitaire(); ?>', '<?php echo $details->getId() ?>')"></td>
                                        <td><input value="<?php echo $sdetails->getAncienQteDuMois($sdetails->getNordre()) ?>"  class="disabledbutton" type="text" id="qtecumule<?php echo $sdetails->getId() ?>"></td>
                                    </tr>
                                </table>
                            <?php } ?>
                        </td>
                        <td><?php echo $sdetails->getPrixunitaire(); ?></td>
                        <td>
                            <?php if ($sdetails->getQuetiteant() > 0) { ?>
                                <input type="text" value="<?php echo $sdetails->getAncienQteDuMois($sdetails->getNordre()) * $sdetails->getPrixunitaire() ?>" class="disabledbutton" id="total<?php echo $sdetails->getId() ?>" ></td>
                        <?php } ?>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <div class="col-lg-3">
        <table class="disabledbutton">
            <?php
            $det = new Detailprix();
            $det = $details;
            ?>
            <tr>
                <td colspan="2">
            <lable>TOTAL GENERAL</lable>
            <input type="text" id="detail_totalhtva<?php echo $details->getId() ?>" value="<?php echo $det->getTotalgeneral() ?>">
            </td>
            </tr>
            <tr>
                <td  colspan="2">
                    <input type="hidden" id="rrrtxt<?php echo $details->getId() ?>" value="<?php echo $formlot->getObject()->getRrr() ?>">
            <lable>Rabais, Remises ou Ristournes: <?php echo $formlot->getObject()->getRrr() ?></lable>
            <input type="text" id="detail_rrr<?php echo $details->getId() ?>" value="<?php echo $det->getRrr() ?>" >
            </td>
            </tr>
            <tr>
                <td>
                    <label>TOTAL GENERAL HTVA APRES RABAIS</label>
                    <input type="text" id="detail_totalaprrr<?php echo $details->getId() ?>" value="<?php echo $det->getTotalapresremise() ?>">
                </td>
                <td >
                    <label>T.V.A</label>
                    <input type="hidden" id="detail_id_tva<?php echo $details->getId() ?>" value="<?php echo $formlot->getObject()->getIdTva() ?>">
                    <input type="text" id="detail_tva<?php echo $details->getId() ?>" value="<?php echo $formlot->getObject()->getTva() ?>">
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <label>TOTAL T.T.C</label>
                    <input type="text" id="detail_ttcnet<?php echo $details->getId() ?>" value="<?php echo $det->getTotal() ?>">
                </td>

            </tr>
            <tr>
                <td colspan="2">
                    <input type="hidden" id="avtxt<?php echo $details->getId() ?>" value="<?php echo number_format($formlot->getObject()->getMarches()->getAvance()) ?>">
                    <label>Avance <?php echo number_format($formlot->getObject()->getMarches()->getAvance()) ?>% sur le montant des travaux</label>
                    <input type="text" id="mntavnace<?php echo $details->getId() ?>" value="<?php echo $det->getMntavance() ?>">
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <input type="hidden" id="retenuetxt<?php echo $details->getId() ?>" value="<?php echo number_format($formlot->getObject()->getMarches()->getRetenuegaraentie()) ?>">
                    <label>RETENU DE GARANTIE  <?php echo number_format($formlot->getObject()->getMarches()->getRetenuegaraentie()) ?>%</label>
                    <input type="text" id="mntretenue<?php echo $details->getId() ?>" value="<?php echo $det->getMntretenue() ?>">
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <label>TOTAL</label>
                    <input type="text" id="txttotal<?php echo $details->getId() ?>" value="<?php echo $det->getNetapayer() ?>">
                </td>
            </tr>
            <tr>
                <td colspan="2">

                    <label>DEPENSES ANTERIEURES</label>
                    <input type="text" id="deponseantiriers<?php echo $details->getId() ?>" value="<?php echo $details->getDeponse_Antirieur($details->getIdLots()) ?>">
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <label>Net à payer TTC</label>
                    <input type="text" id="netapyerttc<?php echo $details->getId() ?>" value="<?php echo $det->getNetapayer() ?>">
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <label>HTVA</label>
                    <input type="text" id="Htva<?php echo $details->getId() ?>" value="<?php echo $det->getHtva() ?>">
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <label>TVA <?php echo $formlot->getObject()->getTva() ?></label>
                    <input type="text" id="tvapayer<?php echo $details->getId() ?>" value="<?php echo $det->getNetapayer() - $det->getHtva(); ?>">
                </td>
            </tr>
        </table>
    </div>

</fieldset>
<?php
if ($det->getEtat() != '2') {
    $numero = $details->getNumero();
    ?>
    <?php if (!$det->getEtat() && $det->getEtat() != '2') { ?>
        <input type="button" value="Valider Décompte <?php echo $numero ?>" ng-click="ValiderDecompte(<?php echo $details->getId() ?>)">
        <?php
    }
} else {

    $countdecompte = Doctrine_Core::getTable('detailprix')
                    ->createQuery('a')->where('id!=' . $det->getId())
                    ->andWhere("id_typedetailprix =4 ")
                    ->andWhere('numero>' . $det->getNumero())->execute();
    if (count($countdecompte) <= 0) {
        $numero = $details->getNumeroDcompte($formlot->getObject()->getId(), $formlot->getObject()->getIdFrs());
        ?>
        <a class="btn btn-white  btn-danger" href="<?php echo url_for('lots/rempliravanace?btn=creedecompte&id=' . $details->getIdLots()) ?>">Crée  Décompte <?php echo $numero; ?></a>
        <?php
    }
}
?>