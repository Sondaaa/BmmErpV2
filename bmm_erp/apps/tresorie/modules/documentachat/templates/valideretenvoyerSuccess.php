<div id="sf_admin_container"   >
    <h1>Fiche B.C.I N°:<?php echo $documentachat->getNumero() ?></h1>
    <?php
    $societe = Doctrine_Core::getTable('societe')->findOneById(1);
    $aviss = Doctrine_Core::getTable('avis')->findByIdPoste(5); //Liste des avis par unité budget
    ?>
    <div id="sf_admin_content">  
        <div style=" position: absolute;float: right;margin-left: 80%;margin-top: 1%;">
            <table ng-controller="myCtrlbudget">
                <tr>
                    <td colspan="2">Avis de l'unité budget</td>
                </tr>
                <?php
                foreach ($aviss as $avis) {
                    $lgavis = Doctrine_Core::getTable('ligavisdoc')->findOneByIdDocAndIdAvis($documentachat->getId(), $avis->getId());
                    ?>
                    <tr>
                        <td><?php echo $avis->getLibelle() ?></td>
                        <td><input type="checkbox" <?php if ($lgavis) echo 'checked="true"' ?>  id="check1_<?php echo $avis->getId() ?>" ng-click="ValiderChoix(<?php echo $avis->getId() ?>,<?php echo $documentachat->getId(); ?>)"></td>
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
                                <td colspan="2"><?php echo strtoupper($documentachat->getTypedoc()); ?></td>
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
            <legend>Liste des articles</legend>
            <table>
                <thead>
                    <tr>
                        <th>N° Ordre</th>
                        <?php if ($documentachat->getIdTypedoc() != 9) { ?>
                            <th>Code Article</th>
                        <?php } ?>
                        <th>Désignation</th>
                        <th>Quantité</th>
                        <th>Projet</th>
                        <th>Motif pour Achat</th>       
                        <?php if ($documentachat->getIdTypedoc() != 9) { ?>
                            <th><table><tr><td colspan="2">P.E.</td></tr><tr><td>Stock</td><td>Patrimoine</td></tr></table></th>
                    <th><table><tr><td colspan="2">P.A.</td></tr><tr><td>Stock</td><td>Patrimoine</td></tr></table></th>
                <?php } ?>
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
                        $qteligne = Doctrine_Core::getTable('qtelignedoc')->findOneByIdLignedocachat($lg->getId());
                        if ($qteligne) {
                            $qtedemander = $qteligne->getQtedemander();
                            $qteas = $qteligne->getQteas();
                            $qtees = $qteligne->getQtees();
                            $qteap = $qteligne->getQteap();
                            $qteep = $qteligne->getQteep();
                        }
                        ?>
                        <tr>
                            <td><?php echo sprintf('%02d', $lg->getNordre()); ?></td>
                            <?php if ($documentachat->getIdTypedoc() != 9) { ?> <td><?php echo $lg->getCodearticle() ?></td> <?php } ?>
                            <td><?php echo $lg->getDesignationarticle() ?></td>
                            <td><?php echo $qtedemander ?></td>
                            <td><?php echo $lg->getProjet() ?></td>
                            <td><?php echo $lg->getLigprotitrub() ?></td>
                            <?php if ($documentachat->getIdTypedoc() != 9) { ?>
                                <td>
                                    <table>
                                        <tr>
                                            <td><?php echo $qtees ?></td>
                                            <td><?php echo $qteep ?> </td>
                                        </tr>
                                    </table>
                                </td>
                                <td>
                                    <table>
                                        <tr>
                                            <td><?php echo $qteas ?></td>
                                            <td><?php echo $qteap ?> </td>
                                        </tr>
                                    </table>
                                </td>
                            <?php } ?>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </fieldset>
        <fieldset style="margin-left: 50%;">
            <legend>Action Fiche B.C.I</legend>
            <div>
                <a style="font-size: 18px" class="btn btn-outline btn-primary1" href="<?php echo url_for('documentachat/showdocument') . '?iddoc=' . $documentachat->getId() . '&btn=valider' ?>">Valider </a>
                <a style="font-size: 18px" class="btn btn-outline btn-primary1" href="<?php echo url_for('documentachat/valideretenvoyer') . '?iddoc=' . $documentachat->getId() . '&btn=envoyer' ?>">Envoie à l'unité <?php if ($documentachat->getIdTypedoc() != 9)
                        echo 'achat';
                    else
                        echo 'marches';
                    ?>
                </a>
            </div>
        </fieldset>
    </div>
</div>