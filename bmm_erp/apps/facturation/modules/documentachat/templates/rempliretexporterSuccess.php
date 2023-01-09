<div id="sf_admin_container"   >
    <h1>Fiche BCI N°:<?php echo $documentachat->getNumero() ?></h1>
    <?php
    $societe = Doctrine_Core::getTable('societe')->findOneById(1);
    $aviss = Doctrine_Core::getTable('avis')->findByIdPoste(5); //Liste des avis par unité budget
    $visas = Doctrine_Core::getTable('visaachat')->findAll();
    ?>
    <div id="sf_admin_content" ng-controller="myCtrldocvisa">  
        <div style=" position: absolute;float: right;margin-left: 80%;margin-top: 1%;" class="disabledbutton">
            <table>
                <tr>
                    <td colspan="2">Avis de l'unité budget</td>
                </tr>
                <?php
                foreach ($aviss as $avis) {
                    $lgavis = Doctrine_Core::getTable('ligavisdoc')->findOneByIdDocAndIdAvis($documentachat->getId(), $avis->getId());
                    ?>
                    <tr>
                        <td><?php echo $avis->getLibelle() ?></td>

                        <td><input type="checkbox" <?php if ($lgavis) echo 'checked="true"' ?>></td>
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
        <fieldset style="width: 80%">
            <legend>Données de Visa</legend>
            <table >
                <tbody>
                    <tr>
                        <td style="width: 30%"><label>Liste des Visa B.C.I.</label></td>
                        <td>
                            <select id="visaid">
                                <option value="0">Sélectionnez...</option>
                                <?php foreach ($visas as $visa) { ?>                        
                                    <option value="<?php echo $visa->getId(); ?>"><?php echo $visa; ?></option>
                                <?php } ?>
                            </select>
                        </td>
                        <td>Date:<input type="date" id="datevisa" ></td>
                        <td>
                            <a ng-click="AjouterVisa(<?php echo $documentachat->getId(); ?>)"  class="btn btn-outline btn-danger" >Ajouter Visa</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </fieldset>
        <fieldset ng-init="AjouterVisa(<?php echo $documentachat->getId() ?>)">
            <legend>Liste des articles</legend>
            <table>
                <thead>
                    <tr>
                        <th>N°ordre</th>
                        <th>Code Article</th>
                        <th>Désignation</th>
                        <th>Qte.Demandée</th>
                        <th>Projet</th>
                        <th>Motif pour Achat</th>
                        <th>
                            P.E.<br>Stock|Patrimoine<br>Unité Achat
                        </th>
                        <th>
                            P.A.<br>Stock|Patrimoine<br>Unité Achat
                        </th>
                        <th>
                            Action
                        </th>
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
                        $qteea=0;
                        $qteaa=0;
                        $qteligne = Doctrine_Core::getTable('qtelignedoc')->findOneByIdLignedocachat($lg->getId());
                        if ($qteligne) {
                            $qtedemander = $qteligne->getQtedemander();
                            $qteas = $qteligne->getQteas();
                            $qtees = $qteligne->getQtees();
                            $qteap = $qteligne->getQteap();
                            $qteep = $qteligne->getQteep();
                            if($qteligne->getQteaachat())
                            $qteaa = $qteligne->getQteaachat();
                            if($qteligne->getQteeachat())
                            $qteea = $qteligne->getQteeachat();
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
                                <?php echo $qtees ?>|<?php echo $qteep ?><br>
                                <input type="text" style="width: 50px" id="input_qte_pe<?php echo $lg->getId() ?>"  value="<?php echo $qteea ?>">
                            </td>
                            <td>
                                <?php echo $qteas ?>|<?php echo $qteap ?> <br>
                                 <input type="text" style="width: 50px" id="input_qte_pa<?php echo $lg->getId() ?>"  value="<?php echo $qteaa ?>">
                            </td>
                            <td>
                                <input type="button" ng-click="ValiderChoix(<?php echo $lignedoc->getId() ?>,<?php echo $qtedemander ?>)" value="Valider">
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            
            <table  style="border: none !important;background: none !important">
                <tr style="border: none !important;background: none !important">
                    <td ng-repeat="visa in visadonnees" style="width: 123px;border: none !important;background: none !important">
                        <table style="width: 123px !important">
                            <tr>
                                <td>
                                    <img src="<?php echo sfconfig::get('sf_appdir') . "uploads/images/" ?>{{visa.chemin}}" style="width: 100px;" >
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    {{visa.ag}}
                                </td>
                            </tr>
                            <tr>
                                <td>{{visa.datevisa}}</td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </fieldset>
        <fieldset style="margin-left: 50%;">
            <legend>Action Fiche BCI</legend>
            <div>
                <a class="btn btn-outline btn-danger" href="<?php echo url_for('documentachat/validervisa?iddoc=') . $documentachat->getId() . '&btn=valider' ?>">Valider le processus de visa </a>
            </div>
        </fieldset>
    </div>
</div>