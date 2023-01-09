
<?php if ($lienFacture != 0) { ?>
    <div class="tab-pane fade active in" id="facture">
        <div class="row">
            <div class="col-lg-12">
                <?php echo html_entity_decode($facture->ReadHtmlFactureImression($documentachat->getId())); ?>
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