<?php if ($lienBCEJ != 0) { ?>
    <div class="tab-pane" id="jeton">
        <div class="row">
            <div class="col-lg-12">
                <?php
                echo html_entity_decode($jeton->ReadBonCommandeExterne_ENTETEBDCR());
                $lignedoc = new Lignedocachat();
                $liste_demande_de_prix = Doctrine_Core::getTable('lignedocachat')
                                ->createQuery('a')
                                ->where('id_doc=' . $jeton->getId())->orderBy('nordre asc')->execute();
                ?>
                <table border="1" style="padding:1%" id="liste_article">
                    <thead>
                        <tr>
                            <th style="text-align:center;width: 5%">N°<br>Ordre</th>
                            <th style="text-align:center;width: 30%">
                                DESIGNATION<br>
                                (indiquer, s'il y a lieu, les références au catalogue du fournisseur)
                            </th>
                            <th style="text-align:center;width: 10%">Quantité<br> à livrer </th>
                            <th style="text-align:center;width: 10%">P.Unit.<br>H.T</th>
                            <th style="text-align:center;width: 10%">Taux<br>T.V.A</th>
                            <th style="text-align:center;width: 25%">Observations</th>
                            <th style="text-align:center;width: 10%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $tva = Doctrine_Core::getTable('tva')->findAll();
                        foreach ($liste_demande_de_prix as $lgnedoc) {
                            $lignedoc = $lgnedoc;
                            $qte = 0;
                            $qteligne = Doctrine_Core::getTable('qtelignedoc')->findOneByIdLignedocachat($lgnedoc->getId());
                            if ($qteligne)
                                $qte = $qteligne->getQtelivrefrs();
                            ?>
                            <tr>
                                <td style="text-align:center;">
                                    <p style="border-bottom: #000 dashed 1px !important">
                                        <?php echo $lignedoc->getNordre() ?>
                                    </p>
                                </td>
                                <td style="text-align:justify;">
                                    <p style="border-bottom: #000 dashed 1px !important">
                                        <?php echo $lignedoc->getDesignationarticle() ?>
                                    </p>
                                </td>
                                <td style="text-align:center;">
                                    <p style="border-bottom: #000 dashed 1px !important">
                                        <input type="text" id="qte<?php echo $lignedoc->getId() ?>" value="<?php echo $qte ?>" class="align_center">
                                    </p>
                                </td>
                                <td style="text-align:center;">
                                    <p style="border-bottom: #000 dashed 1px !important">
                                        <input type="text" id="mntht<?php echo $lignedoc->getId() ?>" value="<?php echo $lignedoc->getMntht() ?>" class="align_right"> 
                                    </p>
                                </td>
                                <td style="text-align:center;">
                                    <p style="border-bottom: #000 dashed 1px !important">
                                        <select id="tva<?php echo $lignedoc->getId() ?>" style="width: 100%">
                                            <?php foreach ($tva as $tv) {
                                                ?>
                                                <option value="<?php $tv->getId() ?>"  
                                                <?php
                                                if ($lignedoc->getIdTva() == $tv->getId()) {
                                                    echo ' selected="selected"';
                                                }
                                                ?>>
                                                    <?php echo $tv; ?></option>
                                            <?php } ?>
                                        </select>
                                    </p>
                                </td>
                                <td style="text-align:justify;">
                                    <p style="border-bottom: #000 dashed 1px !important">
                                        <?php echo $lignedoc->getObservation() ?>
                                    </p>
                                </td>
                                <td style="text-align: center;">
                                    <button class="btn btn-primary btn-xs" ng-click="MisAjour(<?php echo $lignedoc->getId() ?>,<?php echo $jeton->getId() ?>)">
                                        <i class="ace-icon fa fa-edit bigger-110 icon-only"></i>
                                    </button>
                                    <button class="btn btn-danger btn-xs" ng-click="Supprimer(<?php echo $lignedoc->getId() ?>,<?php echo $jeton->getId() ?>)">
                                        <i class="ace-icon fa fa-remove bigger-110 icon-only"></i>
                                    </button>
                                </td>
                            </tr>
                        <?php }
                        ?>
                        <tr>
                            <?php $ligne_mouvement = LignemouvementfacturationTable::getInstance()->findOneByIdDocumentachat($documentachat->getId()); ?>
                            <?php if ($ligne_mouvement): ?>
                                <?php $montant_facture_mouvement = $ligne_mouvement->getMontant(); ?>
                                <td colspan="3">
                                    <p style="text-align: center;font-size: 18px; color: #9f191f;">
                                        Montant facture TTC saisie dans le mouvement :
                                        <input type="text" id="ttcnet_facture_mouvement" value="<?php echo number_format($montant_facture_mouvement, 3, ',', '.') ?>" class="disabledbutton align_center">
                                    </p>
                                </td>
                                <td colspan="4">
                                    <p style="text-align: center;font-size: 18px">
                                        Total TTC:
                                        <input type="text" id="ttcnet_jeton" value="<?php echo number_format($jeton->getMntttc(), 3, ',', '.') ?>" class="disabledbutton align_center">
                                    </p>
                                </td>
                            <?php else: ?>
                                <td colspan="7">
                                    <p style="text-align: center;font-size: 18px">
                                        Total TTC:
                                        <input type="text" id="ttcnet_jeton" value="<?php echo number_format($jeton->getMntttc(), 3, ',', '.') ?>" class="disabledbutton align_center">
                                    </p>
                                </td>
                            <?php endif; ?>
                        </tr>
                    </tbody>
                </table>
                <?php echo html_entity_decode($jeton->ReadBonCommandeExterne_Footer()); ?>
            </div>
            <ul>
                <li id="export_to_facture_tab" style="margin-top: 1%; margin-right: 2%; float: right;" class="<?php echo $classBtn . ' ' . $classBtnF . ' ' . $disabled ?>">
                    <a href="<?php echo url_for('Documents/detail') . '?exporterfacture=' . $documentachat->getId() . '&id=' . $documentachat->getId() ?>" style="font-size: 18px;" class="btn btn-primary">Exporter en Facture</a>
                </li>
            </ul>
        </div>
    </div>
<?php } ?>

<?php if ($lienFacture != 0) { ?>
    <div class="tab-pane" id="facture">
        <div class="row">
            <div class="col-lg-12">
                <?php echo html_entity_decode($facture->ReadHtmlFactureImressionBDCR()); ?>
            </div>
        </div>
    </div>
<?php } ?>

<style>

    #liste_article > tbody > tr > td > p {margin: 0 0 0px;}
    h3{text-align: center;}

</style>

<?php
//$pvreception = Doctrine_Core::getTable('documentachat')->findByIdDocparentAndIdTypedoc($documentachat->getId(), 10);
//if (count($pvreception) > 0) {
?>
<!--    <div class="tab-pane" id="pvreception">
        <div class="row">
            <div class="col-lg-12">
                <table cellspacing="0" >
                    <thead>
                        <tr>
                            <th>
                                Type 
                            </th>
                            <th>numéro</th>
                            <th>Date Création</th>
                            <th>Total Qte</th>
                            <th>Mnt TTC</th>
                            <th>Détail</th>
                        </tr>

                    </thead>
                    <tbody>
<?php
//                        $pv = new Documentachat();
//                        $qte = 0;
//                        $qtelivrefrs = $documentachat->getQteBceoubdc();
//                        foreach ($pvreception as $p) {
//                            $pv = $p;
//                            $qte+=floatval($pv->getTotalQte());
?>
                            <tr>
                                <td><?php // echo $pv->getTypedoc();                        ?></td>
                                <td><?php // echo $pv->getNumerodocachat();                        ?></td>
                                <td><?php // echo $pv->getDatecreation();                        ?></td>
                                <td><?php // echo $pv->getTotalQte();                        ?></td>
                                <td><?php // echo $pv->getMntttc();                        ?> DT</td>
                                <td>
                                    <a href="#my-modal<?php // echo $pv->getId();                        ?>" role="button" class="bigger-125 bg-primary white" data-toggle="modal">
                                        Détail 
                                    </a>
                                    <div id="my-modal<?php // echo $pv->getId();                        ?>" class="modal fade" tabindex="-1">
                                        <div class="modal-dialog" style="width: 54%">
                                            <div class="modal-content">
                                                <div class="modal-header">

                                                    <h3 class="smaller lighter blue no-margin">Detail: <?php //$pv->getNumerodocachat()                       ?></h3>
                                                </div>

                                                <div class="modal-body">

<?php // echo html_entity_decode($pv->ReadHtmlBonEntree());       ?>
                                                </div>

                                                <div class="modal-footer">

                                                    <button class="btn btn-sm btn-danger pull-right" data-dismiss="modal">
                                                        <i class="ace-icon fa fa-times"></i>
                                                        fermer
                                                    </button>
                                                </div>
                                            </div> /.modal-content 
                                        </div> /.modal-dialog 
                                    </div>    
                                    <a target="_blanc"  class="btn btn-outline btn-danger" href="<?php // echo url_for('Documents/Imprimerdocentre?iddoc=' . $pv->getId())                        ?>">Impprimer & Exporter Pdf</a> 
                                </td>
                            </tr>

<?php // }       ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>-->

<!--    <div class="tab-pane" id="factures">
<?php
//        $idtype = "";
//        $fac = new Documentachat();
//        $fac->setIdTypedoc(15);
//        $fac->setIdDocparent($documentachat->getId());
//        $fac->setNumero($fac->NumeroSeqDocumentAchat(15));
//        $fac->setDatecreation(date("Y-m-d"));
//        $facture = $fac;
//
//        $formfacture = new DocumentachatForm($facture);
//        $idtype = 15;
//        include_partial('documentachat/form_facture', array('documentachat' => $documentachat, 'facture' => $facture))
?>

    </div>-->


<?php // }
?>