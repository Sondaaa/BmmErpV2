<div id="sf_admin_container">
    <h1 id="replacediv">Recherche par date, fournisseur ou document d'achat</h1>
</div>
<div id="sf_admin_bar" ng-controller="myCtrldoc" ng-init="AfficheBCE()">
    <div class="sf_admin_filter col-xs-8">
        <form action="" method="post">
            <table cellspacing="0" style="margin-bottom: 0px;">
                <tfoot>
                    <tr>
                        <td colspan="2">
                            <a href="<?php echo url_for('Documents/indexfrs') ?>">Effacer</a>
                            <input type="submit" value="Filtrer" />
                        </td>
                    </tr>
                </tfoot>
                <tbody>
                <input type="hidden" name="idtype" value="<?php echo $idtype ?>">
                <tr>
                    <td><label>Date</label></td>
                    <td>
                        De <input type="date" value="<?php echo $datedebut ?>" name="debut"> à <input type="date" name="fin" value="<?php echo $datefin ?>">
                    </td>
                </tr>
                <tr>
                    <td><label>Fournisseur</label></td>
                    <td><input type="hidden" value="<?php echo $idfrs ?>" id="idfrsselcet">
                        <?php echo $formfiletr['id_frs']->render(array('name' => 'idfrs')); ?>
                    </td>
                </tr>
                <tr>
                    <td><label>Bon Commande Interne<br>(documents sources)</label></td>
                    <td>
                        <?php echo $formfiletr['id_docparent']->render(array('name' => 'id_bci')); ?>
                    </td>
                </tr>
                <tr>
                    <td><label>Demandeur</label></td>
                    <td>
                        <?php echo $formfiletr['id_demandeur']->render(array('name' => 'id_dem')); ?>
                    </td>
                </tr>
                </tbody>
            </table>
        </form>
    </div>
    <div class="row">
        <div class="col-xs-10">
            <h3 class="header smaller lighter blue"></h3>

            <div class="clearfix">
                <div class="pull-right tableTools-container"></div>
            </div>
            <div class="table-header">
                Résultat de recherche
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <table id="dynamic-table">
                        <thead>
                            <tr>
                                <th>&emsp13;</th>
                                <th>Date création</th>
                                <th class="center">Numéro&Type</th>                           
                                <th>Numéro BCIS</th>
                                <th>Rubrique B.</th>
                               
                                <th>Mnt.TTC</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $boncomm = new Documentachat();
                            foreach ($boncommandeexterne as $bcex) {
                                $boncomm = $bcex;
//                                die(sizeof($boncomm->getDocumentparent()->getLigavisdoc()).'mp');
                                $ligprotitrub = $boncomm->getDocumentparent()->getLigavisdoc()->getFirst()->getLigprotitrub();
                                ?>
                                <tr>
                                    <td style="text-align: center;">
                                        <input type="checkbox" id="check_<?php echo $boncomm->getId() ?>" ng-click="ValiderChoisir(<?php echo $boncomm->getId() ?>, '<?php echo $boncomm->getMntttc() ?>', '<?php echo $ligprotitrub->getId() ?>', '<?php echo $ligprotitrub->getIdTitre() ?>')">  
                                    </td>
                                    <td style="text-align: center;"><?php echo date('d/m/Y', strtotime($boncomm->getDatecreation())) ?></td> 
                                    <td style="text-align: center;">
                                        <a href="#my-modal<?php echo $boncomm->getId() ?>" role="button"  data-toggle="modal">
                                            <?php echo $boncomm->getNumerodocachat() ?>
                                        </a>
                                        <div id="my-modal<?php echo $boncomm->getId() ?>" class="modal fade" tabindex="-1">
                                            <div class="modal-dialog" style="width: 84%;">
                                                <div class="modal-content">
                                                    <?php
                                                    $numero = strtoupper($boncomm->getTypedoc());
                                                    $numero = str_replace(array('à', 'á', 'â', 'ã', 'ä', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ñ', 'ò', 'ó', 'ô', 'õ', 'ö', 'ù', 'ú', 'û', 'ü', 'ý', 'ÿ'), array('À', 'Á', 'Â', 'Ã', 'Ä', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ñ', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'Ù', 'Ú', 'Û', 'Ü', 'Ý'), $numero);
                                                    ?>
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                        <h3 class="smaller lighter blue no-margin" style="text-align: left;">Détail <?php echo $numero . ' N° : ' . $boncomm ?></h3>
                                                    </div>
                                                    <div class="modal-body">
                                                        <?php echo html_entity_decode($boncomm->ReadHtmlBondeponseForm()); ?>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button class="btn btn-sm btn-danger pull-right" data-dismiss="modal">
                                                            <i class="ace-icon fa fa-times"></i>
                                                            Fermer
                                                        </button>
                                                    </div>
                                                </div><!-- /.modal-content -->
                                            </div><!-- /.modal-dialog -->
                                        </div>
                                    </td>
                                    <?php
                                    $numero = strtoupper($boncomm->getDocumentparent()->getTypedoc());
                                    $numero = str_replace(array('à', 'á', 'â', 'ã', 'ä', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ñ', 'ò', 'ó', 'ô', 'õ', 'ö', 'ù', 'ú', 'û', 'ü', 'ý', 'ÿ'), array('À', 'Á', 'Â', 'Ã', 'Ä', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ñ', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'Ù', 'Ú', 'Û', 'Ü', 'Ý'), $numero);
                                    ?>
                                    <td style="text-align: center;">
                                        <a href="#bci_model<?php echo $boncomm->getId() ?>" role="button" data-toggle="modal">
                                            <?php echo $boncomm->getDocumentparent()->getNumerodocachat() ?>
                                        </a>
                                        <div id="bci_model<?php echo $boncomm->getId() ?>" class="modal fade" tabindex="-1">
                                            <div class="modal-dialog" style="width: 84%;">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                        <h3 class="smaller lighter blue no-margin" style="text-align: left;">Détail <?php echo $numero ?> N° : <?php echo $boncomm->getDocumentparent()->getNumerodocachat(); ?> </h3>
                                                    </div>
                                                    <div class="modal-body">
                                                        <?php echo html_entity_decode($boncomm->getDocumentparent()->getBonCommandeInterneForm()); ?>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button class="btn btn-sm btn-danger pull-right" data-dismiss="modal">
                                                            <i class="ace-icon fa fa-times"></i>
                                                            Fermer
                                                        </button>
                                                    </div>
                                                </div><!-- /.modal-content -->
                                            </div><!-- /.modal-dialog -->
                                        </div>
                                    </td>
                                    <td style="text-align: center;">
                                        <a href="#my-modal_<?php echo $ligprotitrub->getId(); ?>" role="button"  data-toggle="modal">
                                            <?php echo $ligprotitrub->getCode(); ?>
                                        </a>
                                        <div id="my-modal_<?php echo $ligprotitrub->getId(); ?>" class="modal fade" tabindex="-1">
                                            <div class="modal-dialog" style="width: 84%;">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                        <h3 class="smaller lighter blue no-margin" style="text-align: left;">Détail Rubrique Budgétaire => <?php echo $ligprotitrub->getCode(); ?> : <?php echo $ligprotitrub->getRubrique()->getLibelle(); ?> </h3>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div>
                                                            <table style="margin-bottom: 0px; margin-top: 6px;">
                                                                <thead>
                                                                    <tr>
                                                                        <th colspan="5">Rubrique budgétaire</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr>
                                                                        <td style="width:20%; text-align: left; background-color: #F0F0F0;"><span>Exercice :</span></td>
                                                                        <td style="text-align: left;" colspan="4"><?php echo date('Y', strtotime($ligprotitrub->getTitrebudjet()->getDatecreation())); ?></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td style="text-align: left; background-color: #F0F0F0;"><span>Budget :</span></td>
                                                                        <td style="text-align: left;" colspan="4"><?php echo $ligprotitrub->getTitrebudjet(); ?></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td style="text-align: left; background-color: #F0F0F0;"><span>Rubrique budgétaire :</span></td>
                                                                        <td style="text-align: left;" colspan="4"><?php echo $ligprotitrub->getCode() . ' : ' . $ligprotitrub->getRubrique()->getLibelle(); ?></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td style="text-align: left; background-color: #F0F0F0;"><span>Crédit Réservé :</span></td>
                                                                        <td style="text-align: left; width:15%; background-color: #F0F0F0;">Alloué :</td>
                                                                        <td style="text-align: right; width:25%;"><?php echo number_format($ligprotitrub->getMnt(), 3, '.', ' '); ?></td>
                                                                        <td style="text-align: left; width:15%; background-color: #F0F0F0;">Débloqué :</td>
                                                                        <td style="text-align: right; width:25%;"><?php echo number_format($ligprotitrub->getMntencaisse(), 3, '.', ' '); ?></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td style="text-align: left; background-color: #F0F0F0;"><span>Crédit Engagé :</span></td>
                                                                        <td style="text-align: left; background-color: #F0F0F0;">Définitive :</td>
                                                                        <td style="text-align: right;"><?php echo number_format($ligprotitrub->getMntengage(), 3, '.', ' '); ?></td>
                                                                        <td style="text-align: left; background-color: #F0F0F0;">Provisoire :</td>
                                                                        <td style="text-align: right;"><?php echo number_format($ligprotitrub->getMntprovisoire(), 3, '.', ' '); ?></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td style="text-align: left; background-color: #F0F0F0;"><span>Reliquat :</span></td>
                                                                        <td style="text-align: left; background-color: #F0F0F0;">Définitive :</td>
                                                                        <td style="text-align: right;"><?php echo number_format($ligprotitrub->getMntencaisse() - $ligprotitrub->getMntengage(), 3, '.', ' '); ?></td>
                                                                        <td style="text-align: left; background-color: #F0F0F0;">Provisoire :</td>
                                                                        <td style="text-align: right;"><?php echo number_format($ligprotitrub->getMntencaisse() - $ligprotitrub->getMntprovisoire(), 3, '.', ' '); ?></td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button class="btn btn-sm btn-danger pull-right" data-dismiss="modal">
                                                            <i class="ace-icon fa fa-times"></i>
                                                            Fermer
                                                        </button>
                                                    </div>
                                                </div><!-- /.modal-content -->
                                            </div><!-- /.modal-dialog -->
                                        </div>
                                    </td>
                                    <td style="width: 9%; text-align: right;"><?php echo number_format($boncomm->getMntttc(), 3, '.', ' '); ?></td> 
                                </tr>
                                <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-xs-2" ng-controller="CtrlFormEngagement" ng-click="InialiserPreengagment()">
            <h3 class="header smaller lighter blue"></h3>
            <div class="table-header" >
                Total Doc. Sélectionnés
            </div>
            <div class="tab-content">
                &emsp13;<label>Total:</label>
                <input type="text" id="total" class="form-control disabledbutton align_right">
            </div>
            <a href="#fiche" role="button" id="idvalid" data-toggle="modal" style="margin-top: 1%; padding: 1%; width: 180px; font-weight: bold; height: 50px;" class="btn btn-white btn-success disabledbutton">
                <span>Affectation du rubrique<br>budgétaire</span>
            </a>
            <div id="fiche" class="modal fade" tabindex="-1">
                <div class="modal-dialog" style="width: 84%">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h3 class="smaller lighter blue no-margin">Détail <?php echo $boncomm ?></h3>
                        </div>
                        <div class="modal-body">
                            <fieldset>
                                <legend>Fiche d'engagement provisoire</legend>
                                <table style="margin-bottom: 10px;">
                                    <tbody>
                                        <tr>
                                            <td>Type</td>
                                            <td class="disabledbutton">
                                                <input type="hidden" id="typeenga" value="<?php
                                                if ($form->getObject()->isNew())
                                                    echo '3';
                                                else
                                                    echo $form->getObject()->getIdType()
                                                    ?>">  
                                                       <?php echo $form['id_type']->renderError() ?>
                                                       <?php echo $form['id_type'] ?>
                                            </td>
                                            <td>Numéro</td>
                                            <td class="disabledbutton">
                                                <?php echo $form['numero']->renderError() ?>
                                                <?php
                                                if ($form->getObject()->isNew())
                                                    echo $form['numero']->render(array('value' => $form->getObject()->NumeroSeqDocumentAchat(3)));
                                                else
                                                    echo $form['numero']->render(array('value' => $form->getObject()->getNumerodocachat()));
                                                ?>
                                            </td>
                                            <td>Date Création</td>
                                            <td>
                                                <?php echo $form['datecreation']->renderError() ?>
                                                <?php echo $form['datecreation'] ?>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </fieldset>
                            <fieldset>
                                <legend>Informations sur le Budget</legend>
                                <table style="margin-bottom: 0px;">
                                    <tbody>
                                        <tr>
                                            <td colspan="2">
                                                <table style="margin-bottom: 0px;">
                                                    <thead>
                                                        <tr>
                                                            <th style="width: 10%;">Exercice</th>
                                                            <th style="width: 35%;">Budget</th>
                                                            <th style="width: 55%;">Rubrique & Sous Rubrique</th>
                                                        </tr>
                                                    </thead>
                                                    <tr>
                                                        <td>
                                                            <?php
                                                            $date = date('Y');
                                                            if (!$form->getObject()->isNew() && $form->getObject()->getDatecreation()) {
                                                                $date = date('Y', strtotime($form->getObject()->getDatecreation()));
                                                            }
                                                            echo $date;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                            $ligne = new Ligprotitrub();
                                                            $annees = date('Y');
//                                                            $annees = $params['exercice'];
                                                            $budgets = Doctrine_Query::create()
                                                                            ->select("*")
                                                                            ->from('titrebudjet')
                                                                            ->where("Etatbudget=2")
                                                                            ->andwhere("trim(typebudget) not like trim('Prototype') ")
                                                                            ->andwhere("(trim(typebudget) like trim('Exercice:" . $annees . "') OR trim(typebudget) like trim('Exercice:" . $_SESSION['exercice_budget'] . "'))")
                                                                            ->orderBy('id asc')->execute();
                                                            //Doctrine_Core::getTable('titrebudjet')->findByEtatbudget(2);
                                                            if (!$form->getObject()->isNew() && $form->getObject()->getIdBudget()) {
                                                                $l = Doctrine_Core::getTable('ligprotitrub')->findOneById($form->getObject()->getIdBudget());
                                                                if ($l)
                                                                    $ligne = $l;
                                                            }
                                                            ?>

                                                            <select id="budget">
                                                                <option value="0">Sélectionnez</option>
                                                                <?php foreach ($budgets as $budget) { ?>
                                                                    <option value="<?php echo $budget->getId() ?>" <?php if ($ligne && $ligne->getIdTitre() == $budget->getId()) echo 'selected="selected"' ?>>
                                                                        <?php echo $budget->getLibelle() ?>
                                                                    </option>
                                                                <?php } ?>
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <input type="hidden" id="id_budget" value="<?php if (!$form->getObject()->isNew() && $form->getObject()->getIdBudget()) echo $form->getObject()->getIdBudget(); ?>">
                                                            <select id="numeroengaement" name="numeroengaement">

                                                            </select>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                        <tr class="disabledbutton">
                                            <td style="width: 80%;">
                                                Rubrique
                                                <input type="text" class="form-control" id="rubrique" value="<?php if ($ligne && $ligne->getIdTitre()) echo $ligne->getRubrique() ?>">
                                            </td>
                                            <td>
                                                Montant Global
                                                <input type="text" class="form-control align_right" id="mntttc" value="">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <table style="margin-bottom: 0px;">
                                                    <thead>
                                                        <tr>
                                                            <th>Crédit Réservé</th>
                                                            <th>Crédit Engagé</th>
                                                            <th>Reliquat</th>
                                                        </tr>
                                                    </thead>
                                                    <tr class="disabledbutton">
                                                        <td>
                                                            <ul>
                                                                <li>Alloué: <input type="text" class="form-control align_right" value="<?php if ($ligne && $ligne->getIdTitre()) echo number_format($ligne->getMnt(), 3, ',', '.'); ?>" id="mnt" ></li>
                                                                <li>Débloqué: <input type="text" class="form-control align_right" value="<?php if ($ligne && $ligne->getIdTitre()) echo number_format($ligne->getMntencaisse(), 3, ',', '.'); ?>" id="mntencaisser" ></li>
                                                            </ul>
                                                        </td>
                                                        <td>
                                                            <ul>
                                                                <li>Définitive: <input type="text" class="form-control align_right" value="<?php if ($ligne && $ligne->getIdTitre() && $ligne->getMntengage()) echo number_format($ligne->getMntengage(), 3, ',', '.'); ?>" id="credit"></li>
                                                                <li>Provisoire: <input type="text" class="form-control align_right" value="<?php if ($ligne && $ligne->getIdTitre()) echo number_format($ligne->getMntprovisoire(), 3, ',', '.'); ?>" id="creaditporv" ></li>
                                                            </ul>
                                                        </td>
                                                        <td>
                                                            <?php
                                                            $mntengager = 0;
                                                            $relicat = 0;
                                                            $mntprovisoire = 0;
                                                            $relicatprovisoire = 0;
                                                            if ($ligne->getMntengage())
                                                                $mntengager = $ligne->getMntengage();
                                                            if ($ligne->getMntprovisoire())
                                                                $mntprovisoire = $ligne->getMntprovisoire();
                                                            $relicatprovisoire = number_format($ligne->getMntencaisse() - $mntprovisoire, 3, ',', '.');
                                                            $relicat = $ligne->getMntencaisse() - $mntengager;
                                                            if ($ligne && $ligne->getIdTitre())
                                                                $relicat = number_format($relicat, 3, ',', '.');
                                                            ?>
                                                            <ul>
                                                                <li>Définitive: <input type="text" class="form-control align_right" value="<?php echo $relicat ?>" id="reliq"></li>
                                                                <li>Provisoire: <input type="text" class="form-control align_right" value="<?php echo $relicatprovisoire ?>" id="reliqprovisoire"></li>
                                                            </ul>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="3">
                                                            Objet
                                                            <textarea id="txt_object"><?php if (!$form->getObject()->isNew()) echo $piece->getDescription(); ?></textarea>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </fieldset>
                        </div>
                        <div class="modal-footer">
                            <button ng-click="AjouterParDocPreengagement()" class="btn btn-sm btn-success pull-right"  style="margin-left: 1%">
                                <i class="ace-icon fa fa-save"></i>
                                Valider Engagement
                            </button>
                            <button class="btn btn-sm btn-danger pull-right" data-dismiss="modal">
                                <i class="ace-icon fa fa-times"></i>
                                Fermer
                            </button>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div>
        </div>
    </div>
</div>