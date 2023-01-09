<fieldset ng-init="InialiserCombo('sourcesbudget', '');
        ChargerFinancement()">
    <legend>Information sur le Financement</legend>
    <table>
        <tbody>
            <tr>
                <td><label>Sources</label></td>
                <td>
                    <select ng-model="sltsource" id="sltsource">
                        <!--<option ng-click="InialiserCombo('titrebudjet', source.id)" ng-repeat="source in sourcesbudgets" value="{{source.id}}">{{source.source}}</option>-->
                    </select>
                </td>
                <td colspan="2"><label>Titre</label></td>
                <td colspan="4">
                    <select  id="slttitre">
                        <!--<option ng-click="InialiserCombo('rubrique', titre.id)" ng-repeat="titre in titrebudget" value="{{titre.id}}">{{titre.libelle}}</option>-->
                    </select>
                </td>
            </tr>
            <tr>
                <td><label>Rubrique</label></td>
                <td colspan="2">
                    <select  id="sltrub">
                        <!--<option ng-click="InialiserCombo('sousrubrique', rub.id)" ng-repeat="rub in rubrique" value="{{rub.id}}">{{rub.libelle}}</option>-->
                    </select>
                </td> 
                <td><label>Sous-Rubrique</label></td>
                <td colspan="5">
                    <select  id="sltsrub">
                        <!--<option ng-repeat="srub in sousrubrique" value="{{srub.id}}">{{srub.libelle}}</option>-->
                    </select>
                </td> 
            </tr>
            <tr>
                <td><label>Taux Tva</label></td>
                <td>
                    <?php echo $form['id_tva']->renderError() ?>
                    <?php echo $form['id_tva']->render(array("ng-model" => "slttvatva", "ng-change" => "CalculerTTC(0)")) ?>
                </td>
            </tr>
            <tr>
                <td><label>Montant en HTVA</label></td>
                <td>
                    <?php echo $form['mntht']->renderError() ?>
                    <?php echo $form['mntht']->render(array('ng-model' => 'mntht', 'ng-change' => "CalculerTTC(1)")); ?>
                </td>
                <td><label>montant TTC</label></td>
                <td>
                    <?php echo $form['mntttc']->renderError() ?>
                    <?php echo $form['mntttc']->render(array('ng-model' => 'mntttc', 'ng-change' => "CalculerTTC(2)")); ?>
                </td>
                <td><label>Montant TVA</label></td>
                <td>
                    <?php echo $form['mnttva']->renderError() ?>
                    <?php echo $form['mnttva'] ?>
                </td>
            </tr>
            <tr>
                <td><label>Nature de Prix</label></td>
                <td colspan="2" >
                    <?php echo $form['natureprix']->renderError() ?>
                    <?php echo $form['natureprix'] ?>
                </td>
                <td><label>Carctère des Prix</label></td>
                <td colspan="2">
                    <?php echo $form['caracteristiqueprix']->renderError() ?>
                    <?php echo $form['caracteristiqueprix'] ?>
                </td>
                <td colspan="2">
                    <input type="button" value="Ajouter" ng-model="btnajouter" ng-click="AjouterFinacement()">
                </td>
            </tr>
        </tbody>
    </table>
    <table>
        <thead>
            <tr>
                <th>Budget</th>
                <th>Titre</th>
                <th>Rubrique</th>

                <th>Montant HTVA</th>
                <th>Taux TVA</th>
                <th>Montant Tva</th>
                <th>Montant TTC</th>
                <th>Nature des Prix</th>
                <th>Caractère de prix</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>

            <tr ng-repeat="fin in financements">
                <td  style="display: none"> <input type="text" id="idligpr" value="{{fin.idligpr}}"></td>
                <td>{{fin.budget}}</td>
                <td>{{fin.titre}}</td>
                <td>{{fin.rubrique}}   {{fin.sousrubrique}}</td>
                <td>{{fin.mntht}}</td>
                <td>{{fin.tva}}</td>
                <td>{{fin.mnttva}}</td>
                <td>{{fin.mntttc}}</td>
                <td>{{fin.nature}}</td>
                <td>{{fin.caractere}}</td>
                <td><input type="button" ng-click="DeleteLigne(fin.ordre, fin.idfinancement)" value="Supprimer"></td>
            </tr>
            <tr ng-repeat="fin in financement">
                <td style="display: none"> <input type="text" id="idligpr" value="{{fin.idligpr}}"></td>
                <td>{{fin.budget}}</td>
                <td>{{fin.titre}}</td>
                <td>{{fin.rubrique}}  {{fin.sousrubrique}}</td>
                <td>{{fin.mntht}}</td>
                <td>{{fin.tva}}</td>
                <td>{{fin.mnttva}}</td>
                <td>{{fin.mntttc}}</td>
                <td>{{fin.nature}}</td>
                <td>{{fin.caractere}}</td>

                <td><input type="button" ng-click="DeleteLigne(fin.ordre, fin.idfinancement, fin.idligpr)" value="Supprimer"></td>
            </tr>
        </tbody>
    </table>
    <?php
//    if (!$form->getObject()->isNew()) 
//        die($id_docachat);
////    $piecejointnudg = PiecejointbudgetTable::getInstance()->findOneByIdDocachat($id_docachat);
//   $piecejointnudg= Doctrine_Core::getTable('piecejointbudget')
//                    ->createQuery('a')
//                    ->andwhere('a.id_docachat='.$id_docachat)
//                    ->execute();
////    die(sizeof($piecejointnudg) . 'fr' . $id_docachat);
//    if (count($piecejointnudg) == 0):
    ?>

    <input type="button" id="BtnValide" class="disabledbutton" value="Valider && Affecter la source de financement & Engagement Budget" ng-click="ValiderAffectier()">
    <?php // endif;?>
    <?php
    if (!$form->getObject()->isNew())
        
//        $marche = MarchesTable::getInstance()->find($id);
     die($id_docachat.'pm'.$id_docachat.'fd'.$id_marche);
//        $id_docachat = $marche->getIdDocumentachat();

    if ($id_docachat) {
        $piecejointnudg = PiecejointbudgetTable::getInstance()->findOneByIdDocachat($id_docachat);
        $piecejointnudg = Doctrine_Core::getTable('piecejointbudget')
                ->createQuery('a')
                ->andwhere('a.id_docachat=' . $id_docachat)
                ->execute();
//    die(sizeof($piecejointnudg) . 'fr' . $id_docachat);
        if (count($piecejointnudg) >= 1):
            ?>
            <a class="btn btn-white btn-default" target="__blanc"
               href="<?php echo url_for('financement/ImprimerEngagement?id=' . $id_docachat . '&id_marche=' . $id_marche) ?>">
                Exporter Pdf & Impression Fiche</a>


        <?php
        endif;
    }
    ?>
</fieldset>