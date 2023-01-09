<?php if ($lienBCEJ != 0) { ?>
    <div class="tab-pane active" id="jeton">
        <div class="row" ng-init="AfficheDocBCEP('<?php echo $jeton->getIdDocparent(); ?>')"> 
            <div class="col-lg-12">
                <?php
                echo html_entity_decode($jeton->ReadBonCommandeExterne_ENTETE());
                $lignedoc = new Lignedocachat();
                $liste_demande_de_prix = Doctrine_Core::getTable('lignedocachat')
                                ->createQuery('a')
                                ->where('id_doc=' . $jeton->getId())
                                ->orderBy('nordre asc')->execute();
                ?>
                <table border="1" style="padding:1%" >
                    <tr>  
                        <td> <label>Droit de Timbre: </label>
                            <input type="checkbox" id="droit_timbre" ng-click="ValiderDroitTimbre()" class="pull-right">
                            <input type="text" id="valeurdroit_societe" readonly="true">
                        </td>
                    </tr>
                </table>

                <table border="1" style="padding:1%" id="liste_article">
                    <thead>
                        <tr>
                            <th style="width: 50px">N°</th>
                            <th style="text-align:center">DESIGNATION<br>

                            </th>
                            <th style="width: 80px">Quantité</th>
                            <th style="width: 70px">P.Unit.<br>H.T</th>
                            <th style="width: 6%">T.H.T<br></th>
                            <th style="width: 70px">Remise en %</th>
                            <th style="width: 6%">T.H.T.Net<br></th>
                            <th style="width: 7%">Taux<br>Fodec</th>
                            <th style="width: 8%" class="disabledbutton">Fodec</th>
                            <th style="width: 8%" class="disabledbutton">T.H.TVA</th>
                            <th style="width: 8%">Taux<br>T.V.A</th>
                            <th style="width: 10%" class="disabledbutton">T.TTC</th>
                            <th>Observations</th>
                            <th style="width: 10%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $liste_tauxfodec = Doctrine_Query::create()
                                ->select("id,libelle")
                                ->from('tauxfodec')
                                ->orderBy('id')
                                ->execute();
                        $taux_tva = Doctrine_Query::create()
                                        ->select("id,libelle")
                                        ->from('tva')
                                        ->where('libelle is not null')
                                        ->orderBy('libelle')->execute();
                        $tva = Doctrine_Core::getTable('tva')->findAll();
                        foreach ($liste_demande_de_prix as $lgnedoc) {
                            $lignedoc = $lgnedoc;
                            $qte = 0;
                            $qteligne = Doctrine_Core::getTable('qtelignedoc')->findOneByIdLignedocachat($lgnedoc->getId());
                            if ($qteligne) {
                                $qte = $qteligne->getQtelivrefrs();
                            }
                        }
                        ?>
                        <tr>
                            <td class="disabledbutton"> <input type="text" id="nordre"></td>
                            <td>
                                <input type="text" ng-value="" ng-model="code.text" id="codearticle" autocomplete="off" placeholder="CODE" readonly="true">
                                <input type="text" value="" ng-model="designation.text" id="designation" class="form-control" placeholder="DESIGNATION" ng-change="RechercheArticleByCodeAndDesignationContrat()" ng-keydown="goToListContrat($event)">
                                <?php include_partial('symbole', array()) ?>
                            </td>

                            <td><input type="text" class="form-control" style="" id="qte"></td>
                            <td><input type="text" class="form-control" style="" id="puht"></td>
                            <td><input type="text" class="form-control" style="" id="totalhTax" readonly="true"></td>
                            <td> <input type="text" id="remise" ng-model="remise"></td>
                            <td><input type="text" class="form-control" style="" id="totalhax" readonly="true"></td>
                            <td>

                                <input type="hidden" id="idtaufodec" value='0'>

                                <select id="taufodec">

                                    <?php foreach ($liste_tauxfodec as $tau) : ?>
                                        <option value="<?php echo $tau->getId() ?>"><?php echo $tau->getLibelle() ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </td>

                            <td><input type="text" class="form-control" style="" id="fodec" readonly="true"></td>
                            <td><input type="text" class="form-control" style="" id="totalhtva" readonly="true"></td>

                            <td>
                                <input type="hidden" id="idtva" value='0'>
                                <select id="tva">
                                    <?php foreach ($taux_tva as $tva) : ?>
                                        <option value="<?php echo $tva->getId() ?>" ><?php echo $tva->getLibelle() ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </td>

                            <td><input type="text" class="form-control" style="" id="totalttc" readonly="true"></td>

                            <td>
                                <textarea id="observation" class="form-control"></textarea>
                            </td>
                            <td style="text-align: center;">
                                <a class="btn  btn-xs  btn-primary" ng-click="AddDetailBCEDef()" title="Add Ligne">
                                    <i class="fa fa-plus"></i>
                                </a>
                                <button type="button" class="btn   btn-xs  btn-danger" ng-click="ViderChampsBCEDef()" title="Vider les Chmaps"><i class="fa fa-minus"></i></button>

                            </td>
                        </tr>
                        <tr ng-repeat="lignedoc in lignedocsdeponsedef">
                            <td>
                                <p style="border-bottom: #000 dashed 1px !important">{{lignedoc.norgdre}}</p>
                            </td>
                            <td>
                                <p style="border-bottom: #000 dashed 1px !important">{{lignedoc.designation}}</p>
                            </td>
                            <td style="text-align: center;">
                                <p style="border-bottom: #000 dashed 1px !important">
                                    <input type="text" class="form-control align_center" style="" id="qte_p_{{lignedoc.norgdre}}" value="{{lignedoc.qte|integer}}" ordre="{{lignedoc.norgdre}}" provisoire="p_" onchange="miseAjour(this)">{{lignedoc.unitedemander}}
                                </p>
                            </td>
                            <td>{{lignedoc.puht}}</td>
                            <td>{{lignedoc.totalhTax}}</td>
                            <td>{{(lignedoc.tauxremise * 1).toFixed(2)}}%</td>
                    <input type="hidden" id="id_lignebce" value="{{lignedoc.id}}">

                    <td>{{lignedoc.totalhax}}</td>
                    <td><input type="hidden" id="idtaufodec">{{lignedoc.taufodec}}</td>
                    <td>{{lignedoc.fodec}}</td>
                    <td>{{lignedoc.totalhtva}}</td>
                    <td>{{lignedoc.tva}} </td>
                    <td style="display: none;">{{lignedoc.prixttc}}</td>
                    <td>{{lignedoc.totalttc}}</td>
                    <td>
                        <p style="border-bottom: #000 dashed 1px !important">
                            <textarea id="desc_p_{{lignedoc.norgdre}}" class="form-control" ordre="{{lignedoc.norgdre}}" provisoire="p_"> {{lignedoc.observation}}</textarea>
                        </p>
                    </td>
                    <td style="text-align: center;">
                        <a class="btn btn-xs btn-primary" ng-click="UpdateDetailBcEDef(lignedoc.norgdre, 'p_')">
                            <i class="fa fa-edit"></i>
                        </a>
                        <a class="btn btn-xs btn-danger" ng-click="DeleteLignebceDef(lignedoc.norgdre, 'p_')">
                            <i class="fa fa-remove"></i>
                        </a>
                        <?php ?>

                    </td>                      
                    </tr>

                    <?php ?>
                    <tr>
                        <?php $ligne_mouvement = LignemouvementfacturationTable::getInstance()->findOneByIdDocumentachat($documentachat->getId()); ?>
                        <?php if ($ligne_mouvement): ?>
                            <?php $montant_facture_mouvement = $ligne_mouvement->getMontant(); ?>
                            <td colspan="7">
                                <p style="text-align: center;font-size: 18px; color: #9f191f;">
                                    Montant facture TTC saisie dans le mouvement :
                                    <input type="text" id="ttcnet_facture_mouvement" value="<?php echo number_format($montant_facture_mouvement, 3, '.', ' ') ?>" class="disabledbutton align_center">
                                </p>
                            </td>
                            <td colspan="8">
                                <p style="text-align: center;font-size: 18px">
                                    Total TTC:
                                    <input type="text" id="ttcnet_jeton" value="<?php echo number_format($jeton->getMntttc(), 3, '.', ' ') ?>" class="disabledbutton align_center">
                                    <input class="align_right" type="hidden" id="total_ttc_provisoire_bcehidden" value="<?php echo number_format($jeton->getMntttc(), 3, '.', ' ') ?>" >

                                </p>
                            </td>
                        <?php else: ?>
                            <td colspan="7">
                                <p style="text-align: center;font-size: 18px">
                                    Total TTC:
                                    <input type="text" id="ttcnet_jeton" value="<?php echo number_format($jeton->getMntttc(), 3, '.', ' ') ?>" class="disabledbutton align_center">
                                    <input class="align_right" type="hidden" id="total_ttc_provisoire_bcehidden" value="<?php echo number_format($jeton->getMntttc(), 3, '.', ' ') ?>">
                                </p>
                            </td>
                        <?php endif; ?>
                    </tr>

                    </tbody>
                </table>
                <?php 
                if ($jeton->getMntttc() != $montant_facture_mouvement) { ?>
                    <div class="pull-right"> <input type="button" value="Enregistrer" ng-model="btnvalider" ng-disabled="disableBtn" class="btn btn-primary pull-right" ng-click="ValiderBondexterneJeton('<?php echo $jeton->getId(); ?>')">
                    </div>
                <?php } ?>
                <br>
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
    <div class="tab-pane active" id="facture">
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
                                <td><?php // echo $pv->getTypedoc();                                   ?></td>
                                <td><?php // echo $pv->getNumerodocachat();                                    ?></td>
                                <td><?php // echo $pv->getDatecreation();                                    ?></td>
                                <td><?php // echo $pv->getTotalQte();                                    ?></td>
                                <td><?php // echo $pv->getMntttc();                                    ?> DT</td>
                                <td>
                                    <a href="#my-modal<?php // echo $pv->getId();                                    ?>" role="button" class="bigger-125 bg-primary white" data-toggle="modal">
                                        Détail
                                    </a>
                                    <div id="my-modal<?php // echo $pv->getId();                                    ?>" class="modal fade" tabindex="-1">
                                        <div class="modal-dialog" style="width: 54%">
                                            <div class="modal-content">
                                                <div class="modal-header">

                                                    <h3 class="smaller lighter blue no-margin">Detail: <?php //$pv->getNumerodocachat()                                   ?></h3>
                                                </div>

                                                <div class="modal-body">

<?php // echo html_entity_decode($pv->ReadHtmlBonEntree());          ?>
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
                                    <a target="_blanc"  class="btn btn-outline btn-danger" href="<?php // echo url_for('Documents/Imprimerdocentre?iddoc=' . $pv->getId())                                    ?>">Impprimer & Exporter Pdf</a>
                                </td>
                            </tr>

<?php // }          ?>
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