<div id="sf_admin_container">
    <h1>Fiche <?php echo $documentachat ?></h1>
    <?php
    $societe = Doctrine_Core::getTable('societe')->findOneById(1);
    $aviss = Doctrine_Core::getTable('avis')
                    ->createQuery('a')->where('id_poste=5')
                    ->orderBy('id asc')->execute(); //Liste des avis par unité budget
    ?>
    <div id="sf_admin_content">
        <?php if ($documentachat->getIdTypedoc() != 17 && $documentachat->getIdTypedoc() != 18): ?>
            <div style=" position: absolute;float: right; margin-left: 80%;margin-top: 1%;" class="disabledbutton">
                <table>
                    <thead>
                        <tr>
                            <th colspan="2">Avis de l'unité budget</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($aviss as $avis) {
                            $lgavis = Doctrine_Core::getTable('ligavisdoc')->findOneByIdDocAndIdAvis($documentachat->getId(), $avis->getId());
                            ?>
                            <tr>
                                <td>
                                    <?php
                                    if (strpos($avis->getLibelle(), ":") == 0)
                                        echo $avis->getLibelle();
                                    else
                                        echo "<p style='color: red; margin-bottom:0px;'>" . $avis->getLibelle() . "</p>";
                                    ?>
                                </td>
                                <td>
                                    <?php if (strpos($avis->getLibelle(), ":") == 0) { ?>
                                        <input <?php if ($lgavis) echo 'checked="true"' ?> type="checkbox">
                                    <?php } ?>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
        <div style="padding: 1%;width: 80%;font-size: 16px; <?php if ($documentachat->getIdTypedoc() == 9): ?>margin-bottom: 15px;<?php endif; ?>">
            <table style="list-style: none; margin-bottom: 0px;" class="table table-striped table-bordered table-hover">
                <tr>
                    <td style="width: 200px; vertical-align: middle; text-align: center;">
                        <p style="border-top: 1px solid silver; border-bottom: 1px solid silver; padding-top: 10px; padding-bottom: 10px;">
                            <strong><?php echo strtoupper($societe); ?></strong>
                        </p>  
                    </td>
                    <td>
                        <?php
                        $numero = strtoupper($documentachat->getTypedoc());
                        $numero = str_replace(array('à', 'á', 'â', 'ã', 'ä', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ñ', 'ò', 'ó', 'ô', 'õ', 'ö', 'ù', 'ú', 'û', 'ü', 'ý', 'ÿ'), array('À', 'Á', 'Â', 'Ã', 'Ä', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ñ', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'Ù', 'Ú', 'Û', 'Ü', 'Ý'), $numero);
                        ?>
                        <table style="margin-bottom: 0px;">
                            <tr>
                                <td colspan="2"><?php echo $numero; ?></td>
                            </tr>
                            <?php if ($documentachat->getIdTypedoc() == 19): ?>
                                <tr>
                                    <td>Nom Contrat</td>
                                    <td><?php echo $documentachat->getContratachat()->getReference(); ?> </td>
                                </tr>
                                <tr>
                                    <td>Numèro Contrat</td>
                                    <td><?php echo $documentachat->getContratachat()->getNumero(); ?> </td>
                                </tr>
                            <?php endif; ?>
                            <tr>
                                <td>N° : <?php echo $documentachat->getNumerodocachat() ?></td>
                                <td>Date Création : <?php echo date('d/m/Y', strtotime($documentachat->getDatecreation())); ?></td>
                            </tr>
                            <?php if ($documentachat->getIdTypedoc() != 9): ?>
                                <tr>
                                    <td>Nature</td>
                                    <td><?php echo $documentachat->getObjectdocument(); ?></td>
                                </tr>
                            <?php endif; ?>
                            <?php if ($documentachat->getIdTypedoc() == 17 || $documentachat->getIdTypedoc() == 18 || $documentachat->getIdTypedoc() == 21): ?>    
                                <tr>
                                    <td>Montant TTC</td>
                                    <td><?php echo number_format($documentachat->getMntttc(), 3, '.', ' '); ?> TND</td>
                                </tr>
                                <?php if (sizeof($quitance) >= 1): ?>
                                    <tr>
                                        <td>Montant Quitance</td>
                                        <td><?php echo number_format($quitance->getMntoperation(), 3, '.', ' '); ?></td>
                                    </tr> 
                                <?php endif; ?>
                                <?php // if (sizeof($quitance) >= 1): ?>
    <!--                                    <tr>
                            <td>Montant Quitance</td>
                            <td><?php // echo number_format($quitance->getMntoperation(), 3, '.', ' ');   ?></td>
                        </tr> -->
                                <?php // endif; ?>
                            <?php else: ?>
                                <tr>
                                    <td>Montant Estimatif</td>
                                    <td><?php echo number_format($documentachat->getMontantestimatif(), 3, '.', ' '); ?> TND</td>
                                </tr>
                            <?php endif; ?>
                            <?php if ($documentachat->getIdTypedoc() == 19): ?>

                                <tr>
                                    <td>Montant Contrat</td>
                                    <td><?php echo number_format($documentachat->getContratachat()->getMontantcontrat(), 3, '.', ' '); ?> TND</td>
                                </tr>

                            <?php endif; ?>
                        </table>
                    </td>
                </tr>
            </table> 
        </div>
        <?php if ($documentachat->getIdTypedoc() != 17 && $documentachat->getIdTypedoc() != 18 && $documentachat->getIdTypedoc() != 21): ?>
            <fieldset style="width: 80%; <?php if ($documentachat->getIdTypedoc() == 9): ?>margin-bottom: 15px;<?php endif; ?>">
                <legend>Données de base</legend>
                <table>
                    <tbody>
                        <tr>
                            <td style="width: 25%;">Nom et Prénom du demandeur</td>
                            <td style="width: 50%;"><?php echo $documentachat->getAgents(); ?></td>
                            <td style="width: 10%;">Référence</td>
                            <td style="width: 15%;"><?php echo $documentachat->getReference(); ?></td>
                        </tr>
                    </tbody>
                </table>
            </fieldset>
        <?php endif; ?>
        <?php if ($documentachat->getIdTypedoc() != 9 && $documentachat->getIdTypedoc() != 17 && $documentachat->getIdTypedoc() != 18 && $documentachat->getIdTypedoc() != 21): ?>
            <fieldset id="zone_avis_budgetaire" style="margin-top: 10px;">
                <legend>Avis Bugétaire</legend>
                <?php $liste_avis = Doctrine_Core::getTable('ligavisdoc')->findByIdDoc($documentachat->getId()); ?>
                <div class="col-md-10">
                    <table>
                        <tbody>
                            <?php foreach ($liste_avis as $lgavis): ?>
                                <tr>
                                    <td style="width: 15%; background: repeat-x #F2F2F2;">Avis Bugétaire</td>
                                    <td style="width: 55%;"><?php echo $lgavis->getAvis(); ?></td>
                                    <td style="width: 15%; background: repeat-x #F2F2F2;">Date Création</td>
                                    <td style="width: 15%;"><?php echo date('d/m/Y', strtotime($lgavis->getDatecreation())); ?></td>
                                </tr>
                                <tr>
                                    <td style="background: repeat-x #F2F2F2;">Budget</td>
                                    <td colspan="3"><?php echo $lgavis->getLigprotitrub()->getTitrebudjet(); ?></td>
                                </tr>
                                <tr>
                                    <td style="background: repeat-x #F2F2F2;">Rubrique</td>
                                    <td colspan="3"><?php echo $lgavis->getLigprotitrub()->getRubrique(); ?></td>
                                </tr>
                                <tr>
                                    <td style="background: repeat-x #F2F2F2;">Reliquat</td>
                                    <td colspan="3"><?php echo number_format($lgavis->getMntdisponible(), 3, '.', ' '); ?> TND</td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <div class="col-md-2">
                    <?php
                    $visaas = Doctrine_Core::getTable('ligavissig')->findByIdDoc($documentachat->getId());
                    foreach ($visaas as $visa) {
                        $visaachat = new Visaachat();
                        $vi = Doctrine_Core::getTable('visaachat')->findOneById($visa->getIdVisa());
                        if ($vi) {
                            $visaachat = $vi;
                            ?>
                            <div style="text-align: center; margin-top: -12px;">
                                <div><img src="<?php echo sfconfig::get('sf_appdir') . 'uploads/images/' . $visaachat->getChemin() ?>" style="width: 150px;"></div>
                                <div><?php echo $visaachat ?></div>
                                <div style="font-size: 16px;<?php if ($visa->getEtatvalide() == 'true'): ?>color: green;<?php else: ?>color: red;<?php endif; ?>"><?php echo $visa->getDatevisa() ?></div>
                            </div>
                            <?php
                        }
                    }
                    ?>
                </div>
            </fieldset>
        <?php endif; ?>
        <?php if ($documentachat->getIdTypedoc() == 19 || $documentachat->getIdTypedoc() == 17 || $documentachat->getIdTypedoc() == 18 || $documentachat->getIdTypedoc() == 21): ?>
            <fieldset>
                <div class="col-md-9">
                    <legend>Engagement Bugétaire Provisoire</legend>
                    <?php $document_budget = $documentachat->getPiecejointbudget()->getFirst()->getDocumentbudget(); ?>
                    <table>
                        <tbody>
                            <tr>
                                <td style="width: 16%; background-color: #F2F2F2;">Engagement</td>
                                <td style="width: 52%;"><?php echo $document_budget; ?></td>
                                <td style="width: 17%; background-color: #F2F2F2;">Date Engagement</td>
                                <td style="width: 15%;"><?php echo date('d/m/Y', strtotime($document_budget->getDatecreation())); ?></td>
                            </tr>
                            <tr>
                                <td style="background-color: #F2F2F2;">Budget</td>
                                <td colspan="3"><?php echo $document_budget->getLigprotitrub()->getTitrebudjet(); ?></td>
                            </tr>
                            <tr>
                                <td style="background-color: #F2F2F2;">Rubrique</td>
                                <td colspan="3"><?php echo $document_budget->getLigprotitrub()->getRubrique(); ?></td>
                            </tr>
                            <tr>
                                <td style="background-color: #F2F2F2;">Montant Engagé</td>
                                <td><?php echo number_format($document_budget->getMnt(), 3, '.', ' '); ?> TND</td>
                                <td colspan="2" style="color: #439138; text-align: center;">
                                    <?php if ($documentachat->getDatevalidebudget() != null): ?>
                                        Validé Le : <?php echo date('d/m/Y H:i', strtotime($documentachat->getDatevalidebudget())); ?>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <?php // if ($document_budget->getPiecejointbudget()->count() > 1): ?>
                <?php // $existe_non_valide = 0; ?>
                <!--                    <div class="col-md-3">
                                        <legend>Autres D. Provisoires</legend>
                                        <table>
                                            <tbody>
                <?php // foreach ($document_budget->getPiecejointbudget() as $piece_jointe): ?>
                <?php // if ($piece_jointe->getDocumentachat()->getId() != $documentachat->getId()): ?>
                                                        <tr>
                                                            <td>
                                                                <a target="_blank" href="<?php // echo url_for('documentachat/showdocument?iddoc=') . $piece_jointe->getDocumentachat()->getId()                   ?>">
                <?php // echo $piece_jointe->getDocumentachat() . ' : ' . number_format($piece_jointe->getDocumentachat()->getMntttc(), 3, '.', ' '); ?> TND
                <?php // if ($piece_jointe->getDocumentachat()->getDatesignature() != null): ?>
                                                                        <i class="ace-icon fa fa-check pull-right bigger-120"></i>
                <?php // else: ?>
                <?php // $existe_non_valide++; ?>
                <?php // endif; ?>
                                                                </a>
                                                            </td>
                                                        </tr>
                <?php // endif; ?>
                <?php // endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>-->
                <?php // endif; ?>

                <?php if ($documentachat->getDatesignature() == null && $documentachat->getIdTypedoc() != 19): ?>                                        
                    <fieldset id="zone_visa" style="margin-top: 10px;" class="col-md-9">
                        <legend>Validation Budget</legend>
                        <table>
                            <tbody>
                                <tr>
                                    <td style="width: 5%; vertical-align: middle;">Etat :</td>
                                    <td style="width: 40%">
                                        <select id="etat_budget"> 

                                            <option value="1">Valide Imputatoin Budget</option>                                   
                                            <option value="2">Refuse Imputatoin Budget </option>
                                        </select>
                                    </td>
                                    <td style="width: 15%; background-color: #F2F2F2;">Date Valide Budget</td>
                                    <td><input type="date" id="datevalidebudget" value="<?php echo date('Y-m-d'); ?>" readonly="true"></td>
                                    <td>  <button class="btn btn-xs btn-primary pull-right" onclick="validerBDC('<?php echo $documentachat->getId() ?>')">
                                            <i class="ace-icon fa fa-check bigger-110"></i>
                                            Valider Engagement
                                        </button></td>



                                </tr>
                            </tbody>
                        </table>
                    </fieldset>
                <?php endif; ?>
                <?php if ($documentachat->getDatesignature() == null && $documentachat->getIdTypedoc() == 19): ?>
                    <fieldset id="zone_visa" style="margin-top: 10px;" class="col-md-9">
                        <legend>Validation Budget</legend>
                        <table>
                            <tbody>  

                            <td style="width: 5%; vertical-align: middle;">Etat :</td>
                            <td style="width: 40%">
                                <select id="etat_budget">

                                    <option value="1">Valide Imputatoin Budget</option>                                   
                                    <option value="2">Refuse Imputatoin Budget </option>
                                </select>
                            </td>
                            <td style="width: 15%; background-color: #F2F2F2;">Date Valide Budget</td>
                            <td>  <button class="btn btn-xs btn-primary pull-right" onclick="validerContrat('<?php echo $documentachat->getId() ?>')">
                                    <i class="ace-icon fa fa-check bigger-110"></i>
                                    Valider Engagement Contrat
                                </button>
                            </td>
                            </tbody>
                        </table>
                    </fieldset>
                <?php endif; ?>
                <?php // if ($document_budget->getPiecejointbudget()->count() > 1 && $existe_non_valide > 0): ?>
                <!--                        <div class="col-md-3" style="margin-top: 10px;">
                                            <button class="btn btn-xs btn-primary pull-right" onclick="validerTout('<?php // echo $document_budget->getId()                   ?>')">
                                                <i class="ace-icon fa fa-check bigger-110"></i>
                                                Valider Tout
                                            </button>
                                        </div>-->
                <?php // endif; ?>

            </fieldset>
        <?php endif; ?>
        <?php
        if ($documentachat->getIdTypedoc() == 21):
            $doc_parent = DocumentachatTable::getInstance()->find($documentachat->getIdDocparent());
            ?>
            <fieldset>
                <div class="col-md-9">
                    <legend>Liste des B.D.C.S.P</legend>
                    <table>
                        <thead>
                        <th>Numero BDC</th>
                        <th>Date Création</th>
                        <th >M.T.T.C</th>
                        <th >Fournisseur</th>
                        </thead>
                        <tbody>
                            <?php
                            $bdcprs = DocumentachatTable::getInstance()->findByIdDocparentAndIdTypedoc($documentachat->getIdDocparent(), 17);
                            foreach ($bdcprs as $pdcpr):
                                ?>
                                <tr>
                                    <td style="width: 20%; ">
                                        <?php echo $pdcpr->getNumerodocachat(); ?>
                                    </td>
                                    <td style="width: 20%;text-align: center"><?php echo date('d/m/Y', strtotime($pdcpr->getDatecreation())); ?></td>
                                    <td style="width: 30%; text-align: right"><?php echo $pdcpr->getMntttc(); ?></td>
                                    <td style="width: 30%;"><?php echo $pdcpr->getFournisseur(); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </fieldset>

            <?php if ($doc_parent->getPiecejointbudget()->count() != 0): ?>
                <?php $document_budget = $doc_parent->getPiecejointbudget()->getFirst()->getDocumentbudget(); ?>
                <?php if ($document_budget): ?>
                    <fieldset>
                        <div class="col-md-9">
                            <legend>Engagement Bugétaire Provisoire</legend>
                            <table>
                                <tbody>
                                    <tr>
                                        <td style="width: 16%; background-color: #F2F2F2;">Engagement</td>
                                        <td style="width: 52%;"><?php echo $document_budget; ?></td>
                                        <td style="width: 17%; background-color: #F2F2F2;">Date Engagement</td>
                                        <td style="width: 15%;"><?php echo date('d/m/Y', strtotime($document_budget->getDatecreation())); ?></td>
                                    </tr>
                                    <tr>
                                        <td style="background-color: #F2F2F2;">Budget</td>
                                        <td colspan="3"><?php echo $document_budget->getLigprotitrub()->getTitrebudjet(); ?></td>
                                    </tr>
                                    <tr>
                                        <td style="background-color: #F2F2F2;">Rubrique</td>
                                        <td colspan="3"><?php echo $document_budget->getLigprotitrub()->getRubrique(); ?></td>
                                    </tr>
                                    <tr>
                                        <td style="background-color: #F2F2F2;">Montant Engagé</td>
                                        <td><?php echo number_format($document_budget->getMnt(), 3, '.', ' '); ?> TND</td>
                                        <td colspan="2" style="color: #439138; text-align: center;">
                                            <?php if ($documentachat->getDatesignature() != null): ?>
                                                Validé Le : <?php echo date('d/m/Y', strtotime($documentachat->getDatesignature())); ?>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <?php if ($document_budget->getPiecejointbudget()->count() > 1): ?>
                            <?php $existe_non_valide = 0; ?>
                            <div class="col-md-3">
                                <legend>Autres D. Provisoires</legend>
                                <table>
                                    <tbody>
                                        <?php foreach ($document_budget->getPiecejointbudget() as $piece_jointe): ?>
                                            <?php if ($piece_jointe->getDocumentachat()->getId() != $documentachat->getId()): ?>
                                                <tr>
                                                    <td>
                                                        <a target="_blank" href="<?php echo url_for('documentachat/showdocument?iddoc=') . $piece_jointe->getDocumentachat()->getId() ?>">
                                                            <?php echo $piece_jointe->getDocumentachat() . ' : ' . number_format($piece_jointe->getDocumentachat()->getMntttc(), 3, '.', ' '); ?> TND
                                                            <?php if ($piece_jointe->getDocumentachat()->getDatesignature() != null): ?>
                                                                <i class="ace-icon fa fa-check pull-right bigger-120"></i>
                                                            <?php else: ?>
                                                                <?php $existe_non_valide++; ?>
                                                            <?php endif; ?>
                                                        </a>
                                                    </td>
                                                </tr>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php endif; ?>
                        <div>
                            <?php if ($documentachat->getDatesignature() == null): ?>
                                <div class="col-md-9" style="margin-top: 10px;">
                                    <button class="btn btn-xs btn-primary pull-right" onclick="valider('<?php echo $documentachat->getId() ?>')">
                                        <i class="ace-icon fa fa-check bigger-110"></i>
                                        Valider Engagement
                                    </button>
                                </div>
                            <?php endif; ?>
                            <?php if ($document_budget->getPiecejointbudget()->count() > 1 && $existe_non_valide > 0): ?>
                                <div class="col-md-3" style="margin-top: 10px;">
                                    <button class="btn btn-xs btn-primary pull-right" onclick="validerTout('<?php echo $document_budget->getId() ?>')">
                                        <i class="ace-icon fa fa-check bigger-110"></i>
                                        Valider Tout
                                    </button>
                                </div>
                            <?php endif; ?>
                        </div>
                    </fieldset>
                <?php endif; ?>
            <?php endif; ?>
        <?php endif; ?>
        <?php if ($documentachat->getIdTypedoc() != 19 && $documentachat->getIdTypedoc() != 21): ?>
            <fieldset>
                <div class="col-md-12" style="margin-top: 10px;">
                    <legend>Liste des articles</legend>
                    <table>
                        <thead>
                            <tr>
                                <th>N°ordre</th>
                                <?php if ($documentachat->getIdTypedoc() != 9): ?>
                                    <th>Code Article</th>
                                <?php endif; ?>
                                <th>Désignation</th>
                                <th>Quantité (Unité)</th>
                                <th>Projet</th>
                                <th>Observation</th>
                                <?php if ($documentachat->getIdTypedoc() != 9 && $documentachat->getIdTypedoc() != 18 && $documentachat->getIdTypedoc() != 17): ?>
                                    <th>P.E.<br>Stock|Patrimoine<br>Unité Achat</th>
                                    <th>P.A.<br>Stock|Patrimoine<br>Unité Achat</th>
                                <?php endif; ?>
                            </tr>             
                        </thead>
                        <tbody>
                            <?php
                            $lg = new Lignedocachat();
                            foreach ($listesdocuments as $lignedoc) {
                                $lg = $lignedoc;
                                $qtedemander = 0;
                                $qtees = 0;
                                $qteas = 0;
                                $qteep = 0;
                                $qteap = 0;
                                $qteea = 0;
                                $qteaa = 0;
                                $qteligne = Doctrine_Core::getTable('qtelignedoc')->findOneByIdLignedocachat($lg->getId());
                                if ($qteligne) {
                                    if ($documentachat->getIdTypedoc() == 18 || $documentachat->getIdTypedoc() == 17)
                                        $qtedemander = $qteligne->getQtelivrefrs();
                                    else
                                        $qtedemander = $qteligne->getQtedemander();
                                    $qteas = $qteligne->getQteas();
                                    $qtees = $qteligne->getQtees();
                                    $qteap = $qteligne->getQteap();
                                    $qteep = $qteligne->getQteep();
                                    if ($qteligne->getQteaachat())
                                        $qteaa = $qteligne->getQteaachat();
                                    if ($qteligne->getQteeachat())
                                        $qteea = $qteligne->getQteeachat();
                                }
                                ?>
                                <tr>
                                    <td><?php echo sprintf('%02d', $lg->getNordre()); ?></td>
                                    <?php if ($documentachat->getIdTypedoc() != 9): ?>
                                        <td><?php echo $lg->getCodearticle() ?></td>
                                    <?php endif; ?>
                                    <td><?php echo html_entity_decode($lg->getDesignationarticle()) ?></td>
                                    <td><?php echo $qtedemander . " (" . trim($lg->getUnitedemander()) . ")" ?></td>
                                    <td><?php echo $lg->getProjet() ?></td>
                                    <td><?php echo $lg->getObservation() ?></td>
                                    <?php if ($documentachat->getIdTypedoc() != 9 && $documentachat->getIdTypedoc() != 18 && $documentachat->getIdTypedoc() != 17): ?>
                                        <td>
                                            <?php echo $qtees ?>|<?php echo $qteep ?>
                                            <br>
                                            <p style="color: #740808"><?php echo $qteea ?></p> 
                                        </td>
                                        <td><?php echo $qteas ?>|<?php echo $qteap ?>
                                            <br>
                                            <p style="color: #740808"><?php echo $qteaa ?></p> 
                                        </td>
                                    <?php endif; ?>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </fieldset>
        <?php endif; ?>        
        <?php if ($documentachat->getIdTypedoc() == 19): ?>
            <fieldset>

                <legend>Liste des articles du Contrat</legend>
                <table>
                    <thead>
                        <tr>
                            <th style="width: 5%">N°ordre</th>
                            <?php if ($documentachat->getIdTypedoc() != 9): ?>
                                <th style="width: 5%">Code Article</th>
                            <?php endif; ?>
                            <th style="width: 15%">Désignation</th>
                            <th style="width: 8%">Quantité (Unité)</th>
                            <th style="width: 10%;font-size:10px;">P.U.H.T</th>
                            <th style="width: 12%;font-size:10px;">T.V.A</th>
                            <th style="width: 12%;font-size:10px;">Taux Fodec</th>
                            <th style="width: 12%;font-size:10px;">Fodec</th>
                            <th style="width: 12%;font-size:10px;">T.TTC</th>
                            <th style="width:205px;font-size:10px;">Observation</th>

                        </tr>             
                    </thead>
                    <tbody>
                        <?php
                        $lg = new Lignecontrat();
                        $listesdocumentscontrat = Doctrine_Core::getTable('lignecontrat')->findByIdContrat($documentachat->getContratachat()->getId());

                        foreach ($listesdocumentscontrat as $lignedoc) {
                            $lg = $lignedoc;
                            $qtedemander = 0;
                            $qtees = 0;
                            $qteas = 0;
                            $qteep = 0;
                            $qteap = 0;
                            $qteea = 0;
                            $qteaa = 0;
                            $qteligne = Doctrine_Core::getTable('qtelignedoc')->findOneByIdLignedocachat($lg->getId());
                            $liste_ligne_contrat = Doctrine_Core::getTable('lignecontrat')->findByIdDocparent($lg->getId());
                            if ($qteligne) {
                                if ($documentachat->getIdTypedoc() == 18)
                                    $qtedemander = $qteligne->getQtelivrefrs();
                                else
                                    $qtedemander = $qteligne->getQtedemander();
                                $qteas = $qteligne->getQteas();
                                $qtees = $qteligne->getQtees();
                                $qteap = $qteligne->getQteap();
                                $qteep = $qteligne->getQteep();
                                if ($qteligne->getQteaachat())
                                    $qteaa = $qteligne->getQteaachat();
                                if ($qteligne->getQteeachat())
                                    $qteea = $qteligne->getQteeachat();
                            }
                            ?>
                            <tr>
                                <td><?php echo sprintf('%02d', $lg->getNordre()); ?></td>
                                <?php if ($documentachat->getIdTypedoc() != 9): ?>
                                    <td><?php echo $lg->getCodearticle(); ?></td>
                                <?php endif; ?>
                                <td><?php echo html_entity_decode($lg->getDesignationartcile()); ?></td>
                                <td><?php
                                    if (intval($lg->getQte() == $lg->getQte()))
                                        $qte = intval($lg->getQte());
                                    else
                                        $qte = $lg->getQte();
                                    if ($lg->getUnitedemander()):
                                        echo $qte . " (" . trim($lg->getUnitedemander()) . ")";
                                    else:
                                        echo $qte;
                                    endif;
                                    //   echo $lg->getQte() . " (" . trim($lg->getUnitemarche()->getLibelle()) . ")"; 
                                    ?></td>
                                <td><?php echo number_format($lg->getMntht(), 3, ".", " ") ?></td>
                                <td><?php echo number_format($lg->getTva()->getValeurtva(), 2, ".", " ") . '%'; ?></td>
                                <td><?php
                                    if ($lg->getIdTauxfodec() != null)
                                        echo $lg->getTauxfodec()->getLibelle();
                                    ?>
                                </td>
                                <td><?php if ($lg->getIdTauxfodec() != null) echo number_format($lg->getFodec(), 3, ".", " "); ?></td>
                                <td><?php echo number_format($lg->getMntttc(), 3, ".", " "); ?></td>
                                <td><?php echo $lg->getObservation(); ?></td>
                            </tr>
                            <?php
                        }
                        ?>

                    </tbody>
                </table>
    <?php if (sizeof($liste_ligne_contrat) >= 1): ?>
                    <table>

                        <legend>Sous détail du Ligne de contrat</legend>
                        <thead>
                        <th>N°Ordre</th>
                        <th>Designatioon Article</th>
                        <th>Type Pièce </th>
                        <th>Taux de Pourcentage</th>
                        </thead>
                        <tbody>
                            <?php
                            // foreach ($listesdocumentscontrat as $lignedoc) {
                            foreach ($liste_ligne_contrat as $ligne_lg) {
                                ?>

                                <tr>

                                    <td><?php echo sprintf('%02d', $ligne_lg->getNordre()); ?></td>

                                    <td><?php echo $ligne_lg->getDesignationartcile(); ?></td>
                                    <td ><?php echo $ligne_lg->getTypepiececontrat()->getLibelle(); ?></td>
                                    <td><?php echo $ligne_lg->getTauxpourcentage() . ' %'; ?></td>
                                    <!--<td><?php // echo number_format($lg->getMntht(), 3, ".", " ")              ?></td>-->
                                    <!--<td><?php // echo number_format($lg->getTva()->getValeurtva(), 2, ".", " ") . '%';              ?></td>-->
            <!--                                    <td><?php
//                                        if ($lg->getIdTauxfodec() != null)
//                                            echo $lg->getTauxfodec();
                                    ?></td>-->
            <!--                                    <td><?php // if ($lg->getIdTauxfodec() != null) echo number_format($lg->getFodec(), 3, ".", " ");              ?></td>
                                    <td><?php // echo number_format($lg->getMntttc(), 3, ".", " ");              ?></td>
                                    <td><?php // echo $lg->getObservation();              ?></td>-->
                                </tr>       
                                <?php
                            }
//    } 
                            ?>
                        </tbody>
                    </table>
                    <?php endif; ?>
                <div>
                    <?php
                    $visaas = Doctrine_Core::getTable('ligavissig')->findByIdDoc($documentachat->getId());
                    foreach ($visaas as $visa) {
                        $visaachat = new Visaachat();
                        $vi = Doctrine_Core::getTable('visaachat')->findOneById($visa->getIdVisa());
                        if ($vi) {
                            $visaachat = $vi;
                            ?>
                            <div style="width: 20%;float: left;border-color: #00438a;margin: 1%">
                                <div style="padding: 13%;"><img src="<?php echo sfconfig::get('sf_appdir') . 'uploads/images/' . $visaachat->getChemin() ?>" style="width: 150px;" >
                                </div>
                                <div style="padding: 13%;"><?php echo $visaachat ?></div>
                                <div style="position: absolute;margin-top: -11%;margin-left: 2%;font-size: 26px;<?php if ($visa->getEtatvalide() == 'true'): ?>color: green;<?php else: ?>color: red;<?php endif; ?>"><?php echo $visa->getDatevisa() ?></div>
                            </div>
                            <?php
                        }
                    }
                    ?>
                </div>
            </fieldset>
<?php endif; ?>
        <br>
        <fieldset style="margin-left: 40%;">
            <?php if ($documentachat->getIdTypedoc() == 6): ?>
                <legend>Action Fiche B.C.I</legend>
            <?php elseif ($documentachat->getIdTypedoc() == 9): ?>
                <legend>Action Fiche B.C.I.M.P</legend>
            <?php elseif ($documentachat->getIdTypedoc() == 18): ?>
                <legend>Action B.C.E.S.P</legend>
            <?php elseif ($documentachat->getIdTypedoc() == 17): ?>
                <legend>Action B.D.C.S.P</legend>
            <?php elseif ($documentachat->getIdTypedoc() == 19): ?>
                <legend>Action Contrat.P</legend>
<?php endif; ?>
            <div>
                <a target="_blanc" class="btn btn-outline btn-success" href="<?php echo url_for('documentachat/Imprimerdocachat?iddoc=' . $documentachat->getId()) ?>">
                    <i class="ace-icon fa fa-print bigger-110"></i>
                    Imprimer & Exporter Pdf
                </a>
<?php if ($documentachat->getIdTypedoc() == 6): ?>
                    <a class="btn btn-outline btn-danger" href="<?php echo url_for('documentachat/index?idtype=6') ?>">
                        <i class="ace-icon fa fa-undo bigger-110"></i>
                        Liste B.C.I
                    </a>
<?php elseif ($documentachat->getIdTypedoc() == 9): ?>
                    <a class="btn btn-outline btn-danger" href="<?php echo url_for('documentachat/index?idtype=9') ?>">
                        <i class="ace-icon fa fa-undo bigger-110"></i>
                        Liste B.C.I.M.P
                    </a>
<?php elseif ($documentachat->getIdTypedoc() == 18 || $documentachat->getIdTypedoc() == 17): ?>
                    <a class="btn btn-outline btn-danger" href="<?php echo url_for('Documents/documentProvisoireFournisseur') ?>">
                        <i class="ace-icon fa fa-undo bigger-110"></i>
                        Liste B.C.E.S.P & B.D.C.S.P
                    </a>
<?php elseif ($documentachat->getIdTypedoc() == 19): ?>
                    <a class="btn btn-outline btn-danger" href="<?php echo url_for('Documents/documentProvisoireFournisseur') ?>">
                        <i class="ace-icon fa fa-undo bigger-110"></i>
                        Liste Contrats Provisoires
                    </a>
<?php endif; ?>
            </div>
        </fieldset>
    </div>
</div>

<script  type="text/javascript">

    function validerBDC(id) {
        $.ajax({
            url: '<?php echo url_for('documentachat/validerEngagementBDC') ?>',
            data: 'id=' + id + '&etat_budegt=' + $('#etat_budget').val()
                    + '&datevalidebudget=' + $('#datevalidebudget').val(),
            success: function (data) {
                if (data == 1)
                {
                    bootbox.dialog({
                        message: "Engagement provisoire validé !",
                        buttons:
                                {
                                    "button":
                                            {
                                                "label": "Ok",
                                                "className": "btn-sm"
                                            }
                                }
                    });
                }
                if (data == 2)
                {
                    bootbox.dialog({
                        message: " Imputation Budgétaire non validé !",
                        buttons:
                                {
                                    "button":
                                            {
                                                "label": "Ok",
                                                "className": "btn-sm"
                                            }
                                }
                    });
                }
                window.location.reload();
            }
        });
    }

    function validerContrat(id) {
        $.ajax({
            url: '<?php echo url_for('documentachat/validerEngagementContrat') ?>',
            data: 'id=' + id,
            success: function (data) {
                bootbox.dialog({
                    message: "Engagement provisoire validé !",
                    buttons:
                            {
                                "button":
                                        {
                                            "label": "Ok",
                                            "className": "btn-sm"
                                        }
                            }
                });
                window.location.reload();
            }
        });
    }
    function validerTout(id) {
        $.ajax({
            url: '<?php echo url_for('documentachat/validerToutEngagement') ?>',
            data: 'id=' + id,
            success: function (data) {
                bootbox.dialog({
                    message: "Engagement provisoire, de tout les documents, validé !",
                    buttons:
                            {
                                "button":
                                        {
                                            "label": "Ok",
                                            "className": "btn-sm"
                                        }
                            }
                });
                window.location.reload();
            }
        });
    }

</script>

<style>

    .etat_valide {background-color: #9f9;}
    .etat_non_valide {background-color: #ffa6a6;}

</style>