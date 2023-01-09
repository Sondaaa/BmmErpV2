<div id="sf_admin_container">
    <h1><?php echo 'Réception Provisoire'; ?></h1>
    <div id="sf_admin_content">
        <div class="col-sm-12" ng-controller="myCtrlioscontrat">
            <div class="tabbable">
                <ul class="nav nav-tabs" id="myTab">
                    <li class="active">
                        <a data-toggle="tab" href="#home">
                            <i class="green ace-icon fa fa-user bigger-120"></i>
                            Fiche Contrat
                        </a>
                    </li>
                </ul>
                <input type="hidden" value="<?php echo $form->getObject()->getId()?>" id="id_contrat">
                <input type="hidden" value="<?php echo $form->getObject()->getMontantcontrat()?>" id="mnt_contrat">
                 <?php
                 $doc_factures = Doctrine_Core::getTable('documentachat')
                    ->createQuery('a')
                    ->where('id_docparent=' . $form->getObject()->getDocumentachat()->getFirst()->getId())
                    ->andWhere('id_contrat=' . $form->getObject()->getId())
                    ->andWhere('id_typedoc=15')
                    ->orderBy('id asc')->execute();
                        $resultat_fin = 0;
                        if (sizeof($doc_factures) >= 1):
                            foreach ($doc_factures as $fac):
                                ?>
                                <?php
                                $resultat_fin+=$fac->getMntttc();
                            endforeach;
                        endif;
                        ?>      
                       <?php $rest_contrat = $form->getObject()->getMontantcontrat() - $resultat_fin; ?>
                <input type="hidden" class="form-control align_right disabledbutton" 
                value="<?php   echo $rest_contrat ?>"  id="montant_contrat_restant" >
                       
                <div class="tab-content">
                    <div id="home" class="tab-pane fade in active">
                        <fieldset>
                            <div class="col-lg-6">
                                <fieldset >
                                    <legend>Information <?php echo "Bénéficiaire "; ?></legend>
                                    <table class="disabledbutton">
                                        <tbody>
                                            <tr>
                                                <td>Fournisseur</td>
                                                <td colspan="3"><?php echo $form->getObject()->getFournisseur() ?></td>

                                            </tr>
                                            <tr>
                                                <td>Contrat </td>
                                                <td>
                                                    <?php echo $form->getObject()->getReference() . '   N°: ' . $form->getObject()->getNumero() ?>
                                                </td>
                                                <td>Document achat </td>
                                                <td colspan="3">
                                                    <?php echo $form->getObject()->getDocumentachat()->getFirst()->getNumerodocumentachat() ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Date de création</td>
                                                <td style="text-align: cenetr"><?php echo date('d/m/Y', strtotime($form->getObject()->getDatecreation())); ?></td>

                                                <td>Date de Signature</td>
                                                <td style="text-align: cenetr">
                                                    <?php if ($form->getObject()->getDatesigntaure()): ?>
                                                        <?php
                                                        echo date('d/m/Y', strtotime($form->getObject()->getDatesigntaure()));
                                                    endif;
                                                    ?></td>
                                            </tr>
                                            <tr>
                                                <td>Type</td>
                                                <td >
                                                    <?php
                                                    if ($form->getObject()->getType() == 0)
                                                        echo 'Livraison Total ';
                                                    else
                                                        echo 'Livraison Partiel';
                                                    ?>
                                                </td>

                                                <td>Date Fin</td>
                                                <td><?php if ($form->getObject()->getDatefin()): ?>
                                                        <?php
                                                        echo date('d/m/Y', strtotime($form->getObject()->getDatefin()));
                                                    endif;
                                                    ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td > Montant Total TTC :</td>
                                                <td><input type="hidden" value=" <?php echo $contratachat->getMontantcontrat(); ?>" id="contratachat_mnttc">
                                                    <?php echo $contratachat->getMontantcontrat(); ?></td>

                                                <td>Cautionnement définitif%</td>
                                                <td><input class="align_right" type="text" id="contratachat_cautionement" value="<?php echo $contratachat->getCautionement(); ?>" /></td>
                                            </tr>
                                            <tr>
                                                <td>Retenue de garantie%</td>
                                                <td><input class="align_right" type="text" id="contratachat_retenuegaraentie" value="<?php echo $contratachat->getRetenuegaraentie(); ?>" /></td>
                                                <td>Avance%</td>                              
                                                <td><input class="align_right" type="text" id="contratachat_avance" value="<?php echo $contratachat->getAvance(); ?>" /></td>                               
                                            </tr>
                                            <tr>
                                                <td>Pénalité de RETARD%/Jour</td>
                                                <td>
                                                    <input class="align_right" type="text" id="contratachat_penalite"
                                                           value="<?php echo $contratachat->getPenalite(); ?>" />
                                                </td>

                                                <td>Max Pénalité de RETARD%</td>
                                                <td>
                                                    <input class="align_right" type="text" id="contratachat_maxpinalite"
                                                           value="<?php echo $contratachat->getMaxpinalite(); ?>" />
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </fieldset>
                            </div>
                            <div class="col-lg-6">
                                <fieldset>
                                    <legend>Délai & Période </legend>
                                    <table>
                                        <tbody>
                                            <tr>
                                                <td>Date ordre de service</td>
                                                <td class="disabledbutton">

                                                    <?php echo $form['dateoservice']->renderError() ?>
                                                    <?php echo $form['dateoservice'] ?>

                                                </td>
                                                <td>Date réception provisoire</td>
                                                <td>
                                                    <?php echo $form['datereceptionprevesoire']->renderError() ?>
                                                    <?php echo $form['datereceptionprevesoire'] ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Délai d'exécution</td>
                                                <td class="disabledbutton">
                                                    <?php echo $form['delaidexucution']->renderError() ?>
                                                    <?php echo $form['delaidexucution'] ?>
                                                </td>
                                                <td>Période d'arrêt justifié</td>
                                                <td>
                                                    <?php echo $form['periodejustifier']->renderError() ?>
                                                    <?php echo $form['periodejustifier'] ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Délai contractuel</td>
                                                <td class="disabledbutton">
                                                    <?php echo $form['delaicontratcuel']->renderError() ?>
                                                    <?php echo $form['delaicontratcuel'] ?>
                                                </td>
                                                <td>Période réelle d'exécution</td>
                                                <td>
                                                    <?php echo $form['pireodereelexecution']->renderError() ?>
                                                    <?php echo $form['pireodereelexecution'] ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Période de retard</td>
                                                <td>
                                                    <?php echo $form['pirioderetard']->renderError() ?>
                                                    <?php echo $form['pirioderetard'] ?>
                                                </td>
                                                <td>Pénalité de retard</td>
                                                <td>
                                                    <input type="hidden" id="mntp1" value="<?php echo $contratachat->getPenalite() ?>">
                                                    <input type="hidden" id="mntp2" value="<?php echo $contratachat->getMaxpinalite() ?>">
                                                    <input type="text" id="mnt_pinaliter" >
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Action</td>
                                                <td colspan="5">
                                                    <input type="button" value="Mettre à jour" ng-click="MisajourficheContrat(<?php echo $form->getObject()->getId() ?>)">
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </fieldset>
                            </div>
                        </fieldset>
                    </div>
                </div>
            </div>
        </div><!--/.col -->
    </div>

    <div id = "sf_admin_footer">

    </div>
</div>