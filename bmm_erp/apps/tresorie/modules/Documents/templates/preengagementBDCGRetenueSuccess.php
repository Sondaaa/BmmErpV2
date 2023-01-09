<?php
$doc_achat = new Documentachat();
$doc_achat = $documentachat;
$caisses = CaissesbanquesTable::getInstance()->getAllCaisse();
?>

<div id="sf_admin_container" ng-controller="CtrlCaisse">
    <input type="hidden" id="id_user" value="<?php echo $sf_user->getAttribute('userB2m')->getId() ?>">

    <h1 id="replacediv"> 
        Engagement  du <?php echo $doc_achat->getTypedoc() ?>:<br><?php echo $documentachat->getNumerodocachat() ?>
    </h1>
    <div class="panel-body">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs">
            <li class="<?php if ($active == "home") echo "active" ?>"><a href="#home" data-toggle="tab" aria-expanded="true">Détail </a>
            </li>

            <li class="<?php if ($active == "detail") echo "active" ?>" ng-click="InialiserQuittance()" ><a href="#engagement" data-toggle="tab" aria-expanded="false">Fiche quittance <?php echo $categorie ?></a>
            </li>
            <li class=""  ><a href="#listeengagement" data-toggle="tab" aria-expanded="false">Liste des fiches quittances Provisoires & Définitifs & Retenues</a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane <?php if ($active == "home") echo "fade active in" ?> " id="home">
                <h4><?php echo strtoupper($doc_achat->getTypedoc()) ?> N°:<?php echo $documentachat->getNumerodocachat() ?></h4> 
                <div style="margin-top: 10px;">
                    <object style="width: 100%;height: 900px;" data="<?php echo url_for('Documents/Imprimerbondeponse?iddoc=' . $documentachat->getId()) ?>" type="application/pdf">
                        <embed src="<?php echo url_for('Documents/Imprimerbondeponse?iddoc=' . $documentachat->getId()) ?>" type="application/pdf" />
                    </object>
                </div>
                <div style="margin-top: 10px;">
                    <object style="width: 100%;height: 900px;" data="<?php echo url_for('Documents/ImprimerAnnexebondeponse?iddoc=' . $documentachat->getId()) ?>" type="application/pdf">
                        <embed src="<?php echo url_for('Documents/ImprimerAnnexebondeponse?iddoc=' . $documentachat->getId()) ?>" type="application/pdf" />
                    </object>
                </div>
            </div>
            <div class="tab-pane <?php if ($active == "detail") echo "fade active in" ?>" id="engagement" >
                <fieldset>
                    <legend>Fiche de quittance <?php echo $categorie; ?></legend>
                    <table>
                        <tbody>
                            <tr style="display: none">
                                <td>
                                    <input id="id_caisse" type="hidden" value="<?php
                                    if ($documentachat->getIdFils() != '') {
                                        if ($ligneOperationCaisseFils)
                                            echo $ligneOperationCaisseFils->getIdCaisse();
                                    }
                                    ?>"
                                </td>
                                <td>
                                    <input id="id_demarcheur" type="hidden" value="<?php
                                    if ($documentachat->getIdFils() != '') {
                                        if ($ligneOperationCaisseFils && $ligneOperationCaisseFils->getIdDemarcheur())
                                            echo $ligneOperationCaisseFils->getIdDemarcheur();
                                    }
                                    ?>"
                                </td>
                            </tr>
                            <tr class="disabledbutton">
                                <td><label>Numéro</label></td>
                                <td>
                                    <input type="hidden" value="<?php if (!$form->getObject()->isNew()) echo $form->getObject()->getId() ?>" id="idcaisse">
                                    <?php echo $form['numeroo']->renderError() ?>
                                    <?php
                                    if ($form->getObject()->isNew())
                                        echo $form['numeroo']->render(array('value' => $form->getObject()->NumeroSeqDocumentAchatProvisoire(1)));
                                    else
                                        echo $form['numeroo']->render(array('value' => $form->getObject()->getNumerodocachatQuitance()));
                                    ?>
                                </td>
                                <td ><label>Date Création</label></td>
                                <td >
                                    <?php echo $form['dateoperation']->renderError() ?>
                                    <?php echo $form['dateoperation']->render(array('value' => date('Y-m-d'))) ?>
                                </td>
                            </tr>
                            <tr>
                                <td><label>Utilisateur</label></td>
                                <td class="disabledbutton">
                                    <?php echo $form['id_user']->renderError() ?>
                                    <?php echo $form['id_user'] ?>
                                </td>
                                <td><label>Démarcheur</label></td>
                                <td colspan="2">
                                    <?php echo $form['id_demarcheur']->renderError() ?>
                                    <?php echo $form['id_demarcheur'] ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <table >
                        <tbody>
                            <tr>
                                <td><label>Objet</label></td>
                                <td>
                                    <?php
                                    $valueObject = "";
                                    if ($documentachat->getIdFils() != '') {
                                        if ($ligneOperationCaisseFils) {
                                            $valueObject = $ligneOperationCaisseFils->getObjet();
                                        }
                                    }
                                    ?>
                                    <?php echo $form['objet']->renderError() ?>
                                    <?php echo $form['objet']->render(array("value" => $valueObject)) ?>
                                </td>
                                <td colspan="2">
                                    <p style="color: red"><?php echo $rubrique; ?></p>   
                                </td>
                            </tr>
                            <tr>

                                <td><label>Caisse</label></td>
                                <td colspan="2">
                                    <?php // echo $form['id_caisse']->renderError()   ?>
                                    <?php // echo $form['id_caisse']  ?>

                                    <select name="ligneoperationcaisse[id_caisse]" id="ligneoperationcaisse_id_caisse" >
                                        <option value="0"></option>
                                        <?php foreach ($caisses as $caisse): ?>
                                            <option
                                                value="<?php echo $caisse->getId() ?>">
                                                <?php echo $caisse->getLibelle() ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </td>
<!--                                <td><label>Chèque N°</label></td>
                                <td>
                                <?php
//                                    $valueCheque = "";
//                                    if ($documentachat->getIdFils() != '') {
//                                        if ($ligneOperationCaisseFils)
//                                            $valueCheque = $ligneOperationCaisseFils->getChequen();
//                                    }
                                ?>
                                <?php // echo $form['chequen']->renderError() ?>
                                <?php // echo $form['chequen']->render(array("value" => $valueCheque)) ?>
                                </td>-->
                            </tr>
                            <tr>
                                <td ><label>Total</label></td>
                                <td colspan="3" style="background-color: red">
                                    <?php
                                    $mnt = $doc_achat->getMntttc();
                                    if (!$form->getObject()->isNew())
                                        $mnt = $form->getObject()->getMntoperation();
                                    ?>

                                    <input type="hidden" value="<?php if (!$form->getObject()->isNew())
                                        echo $form->getObject()->getMntoperation();
                                    ?>" id="mnt_operation">
                                           <?php echo $form['mntoperation']->renderError() ?>
<?php echo $form['mntoperation']->render(array('value' => $mnt)) ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </fieldset>
                <fieldset>
                    <legend>Liste des articles</legend>
                    <table>
                        <thead>
                            <tr>
                                <th>  <input id="selecte_all_artcile" class="disabledbutton" type="checkbox" onchange="setCheckAll()"/></th>
                                <th>N° Ordre</th>
                                <th>Qte.</th>
                                <th>Code</th>
                                <th>Designation</th>
                                <th>P.U</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $array_id_ligne = '';
                            $ligne = new Lignedocachat();
                            foreach ($liste_demande_de_prix as $l) {
                                $ligne = $l;
                                $qte = 0;
                                $qteligne = Doctrine_Core::getTable('qtelignedoc')->findOneByIdLignedocachat($ligne->getId());
                                if ($qteligne)
                                    $qte = $qteligne->getQtelivrefrs();
                                if ($form->getObject()->isNew())
                                    $ligne_article_caisse = Doctrine_Core::getTable('lignearticlecaisse')->findOneByIdLignearticle($ligne->getId());
                                else
                                    $ligne_article_caisse = Doctrine_Core::getTable('lignearticlecaisse')->findOneByIdLignearticleAndIdLigneoperationcaisse($ligne->getId(), $form->getObject()->getId());

                                $array_id_ligne.= $ligne_article_caisse . ',';
                                ?>
                                <tr><?php // if ($ligne_article_caisse) { checked="checked"   ?>  <?php // }    ?> 
                                    <td><input id="check_<?php echo $ligne->getId() ?>"
                                               type="checkbox" class="list_checbox_article" 
                                               ng-click="AjouterArticleListeSelectionner(<?php echo $ligne->getId() ?>)"></td>
                                    <td><?php echo $ligne->getNordre() ?></td>
                                    <td><?php echo $qte ?></td>
                                    <td><?php echo $ligne->getCodearticle() ?></td>
                                    <td><?php echo $ligne->getDesignationarticle() ?></td>
                                    <td><?php echo $ligne->getMntht() ?></td>
                                    <td><?php echo number_format($ligne->getMntttc() * $qte, 3, ',', '.') ?></td>
                                </tr>
<?php } ?>
                        </tbody>
                    </table>
                </fieldset>
                <fieldset >
                    <legend>Action</legend>
                    <input  type="button" value="Mettre à ajour" ng-click="AjouterQuittanceBDCRetenue(<?php echo $documentachat->getId() ?>, <?php echo $idcategorie ?>)">
                    <?php if (!$form->getObject()->isNew()) { ?>
                        <a class="btn btn-white btn-default" target="__blanc" href="<?php echo url_for('Documents/Imprimerprovisoirecaiise') . '?idfiche=' . $form->getObject()->getId() . '&iddoc=' . $documentachat->getId() ?>" >Exporter Pdf & Impression Fiche Provisoire</a>
<?php } ?>
                </fieldset>
            </div>

            <div class="tab-pane" id="listeengagement">
                <fieldset>
                    <legend>Liste des Quittances provisoires & Définitifs</legend>
                    <table>
                        <thead>
                            <tr>
                                <th>Type</th>
                                <th>Numéro</th>
                                <th>Caise N°</th>
                                <th>BDCP N°</th>
                                <th>Mnt.</th>
                                <th>Démarcheur</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $operation = new Ligneoperationcaisse();
                            foreach ($pieces_operations as $op) {
                                $operation = $op;
                                ?>
                                <tr>
                                    <td><?php echo $operation->getCategorieoperation(); ?></td>
                                    <td><?php echo $operation->getNumerodocachat(); ?></td>
                                    <td><?php echo $operation->getCaissesbanques() ?></td>
                                    <td><?php echo $operation->getDocumentachat() ?></td>
                                    <td><?php echo $operation->getMntoperation(); ?></td>
                                    <td><?php echo $operation->getDemarcheur(); ?></td>                                
                                    <td>
                                        <a href="<?php echo url_for('Documents/preengagementBDCG') . '?id=' . $operation->getIdDocachat() . '&idoperation=' . $operation->getId(); ?>">Détail</a>
                                    </td>
                                </tr>
<?php } ?>
                        <input type="hidden" id="liste_ligne" value="<?php echo $array_id_ligne; ?>">
                        </tbody>
                    </table>
                </fieldset>
            </div>
        </div>
    </div>
</div>

<script>
            function printDiv()
            {

            var divToPrint = document.getElementById('engagement');
                    var newWin = window.open('', 'Print-Window');
                    newWin.document.open();
                    newWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</body></html>');
                    newWin.document.close();
                    setTimeout(function(){newWin.close(); }, 10);
            }
//    function setCheckAll() {
//    var id = '';
//            if ($("#check_input").is(":checked")) {
//    $('.list_checbox_article[type=checkbox]').each(function () {
//    $(this).prop("checked", "checked");
//    });
//    } else {
//    $('.list_checbox_article[type=checkbox]').each(function () {
//    $(this).removeProp("checked");
//            $(this).removeAttr("checked");
//    }); }
//    if ($('#selecte_all_artcile').is(':checked')) {
//
//    $('.list_checbox_article[type=checkbox]').prop('checked', true);
//            $('.list_checbox_article[type=checkbox]:checked').each(function () {
//
//    id = $(this).attr('idientifiant');
////            AjouterArticleListeSelectionner(id);
//    });
//    }
//    }
</script>