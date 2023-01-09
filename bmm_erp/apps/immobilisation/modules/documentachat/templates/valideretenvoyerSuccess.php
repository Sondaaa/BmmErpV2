<div id="sf_admin_container"   >
    <h1>Fiche BCI N°:<?php echo $documentachat->getNumero() ?></h1>
    <?php
    $societe = Doctrine_Core::getTable('societe')->findOneById(1);
    $aviss = Doctrine_Core::getTable('avis')->findByIdPoste(5); //Liste des avis par unité budget
    ?>
    <div id="sf_admin_content">  
        <div style=" position: absolute;float: right;margin-left: 80%;margin-top: 1%;" class="disabledbutton">
            <table>
                <tr>
                    <td colspan="2">Avis de l'unité budget</td>
                </tr>
                <?php foreach ($aviss as $avis) { ?>
                    <tr>
                        <td><?php echo $avis->getLibelle() ?></td>
                        <td><input type="checkbox"></td>
                    </tr>

                <?php } ?>
            </table>
        </div>
        <div style="padding: 1%;width: 80%;font-size: 16px">
            <table style="list-style: none">
                <tr>
                    <td style="width: 200px">
                        <p>
                            <strong><?php echo strtoupper($societe); ?></strong>
                        </p>  
                    </td>
                    <td>
                        <table>
                            <tr>

                                <td  colspan="2"><?php
                                    echo strtoupper($documentachat->getTypedoc());
                                    ?></td>
                            </tr>
                            <tr>
                                <td>
                                    N°:<?php echo $documentachat->getNumerodocachat() ?>
                                </td>
                                <td>
                                    Date création: <?php echo $documentachat->getDatecreation(); ?>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>

            </table> 
        </div>




        <fieldset style="width: 80%">
            <legend>Données de base</legend>
            <table >
                <tbody>
                    <tr>
                        <td style="width: 30%"><label>Nom et Prénom du demandeur</label></td>
                        <td>
                            <?php echo $documentachat->getAgents(); ?>

                        </td>
                        <td><label>Référence</label></td>
                        <td>
                            <?php echo $documentachat->getReference(); ?>

                        </td>

                    </tr>


                </tbody>
            </table>
        </fieldset>
        <fieldset>
            <legend>Listes des articles</legend>
            <table ng-app="myAppCtrlignedoc" ng-controller="myCtrllignedoc">
                <thead>
                    <tr>
                        <th>N°ordre</th>
                        <th>Code Article</th>
                        <th>Désignation</th>
                        <th>Quantité</th>
                        <th>Projet</th>
                        <th>Motif pour Achat</th>               
                        <th>P.E.P.</th>
                        <th>P.A.P.</th>

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
                        $qteligne = Doctrine_Core::getTable('qtelignedoc')->findOneByIdLignedocachat($lg->getId());
                        if ($qteligne) {
                            $qtedemander = $qteligne->getQtedemander();
                            if($qteligne->getQteap())
                            $qteas = $qteligne->getQteap();
                            if($qteligne->getQteep())
                            $qtees = $qteligne->getQteep();
                        }
                        ?>
                        <tr>
                            <td><?php echo sprintf('%02d', $lg->getNordre()); ?></td>
                            <td><?php echo $lg->getCodearticle() ?></td>
                            <td><?php echo $lg->getDesignationarticle() ?></td>
                            <td><?php echo $qtedemander ?></td>
                            <td><?php echo $lg->getProjet() ?></td>
                            <td><?php echo $lg->getLigprotitrub() ?></td>
                            <td>
                                <input type="text" style="width: 50px" id="input_qte_pe<?php echo $lg->getId() ?>"  value="<?php echo $qtees ?>">
                            </td>
                            <td><input type="text" style="width: 50px" id="input_qte_pa<?php echo $lg->getId() ?>"  value="<?php echo $qteas ?>">
                            </td>
                            <td>
                                <input type="button" ng-click="ValiderChoix(<?php echo $lignedoc->getId() ?>,<?php echo $qtedemander ?>)" value="Valider">
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </fieldset>
        <fieldset style="margin-left: 50%;">
            <legend >Action Fiche BCI</legend>
            <div >
                <a  style="font-size: 18px" class="btn btn-outline btn-primary1" href="<?php echo url_for('documentachat/showdocument') . '?iddoc=' . $documentachat->getId() . '&btn=valider' ?>">Valider </a>
                <a  style="font-size: 18px" class="btn btn-outline btn-primary1" href="<?php echo url_for('documentachat/valideretenvoyer') . '?iddoc=' . $documentachat->getId() . '&btn=envoyer' ?>">Envoi vers l'unité achat </a>

            </div>

        </fieldset>
    </div>
</div>

