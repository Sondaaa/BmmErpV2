<?php
$idpiece = 0;
if ($piece)
    $idpiece = $piece->getId();
$doc_achat = $documentachat;

if ($form->getObject()->getIdBudget()) {
    $ligne = LigprotitrubTable::getInstance()->findOneById($form->getObject()->getIdBudget());
}
?>
<div id="sf_admin_container" ng-controller="CtrlFormEngagement">

    <h1> Engagement du <?php echo $doc_achat->getTypedoc() ?> : <?php echo $documentachat->getNumerodocachat() ?></h1>


    <div id="sf_admin_content">

        <div class="col-sm-6">
            <div class=" tab-content">

                <fieldset <?php if ($idpiece != 0) echo 'class="disabledbutton"' ?>>
                    <legend> <?php
                        if (!$form->getObject()->isNew())
                            echo $form->getObject()->getTypedocbudget();
                        else
                            echo "Fiche d'engagemnt provisoire"
                            ?></legend>
                    <table>
                        <tbody>
                            <tr class="disabledbutton">
                                <td><label>Type</label></td>
                                <td colspan="4">
                                    <input type="hidden" id="typeenga" value="<?php
                                    if ($form->getObject()->isNew())
                                        echo '3';
                                    else
                                        echo $form->getObject()->getIdType()
                                        ?>">
                                           <?php echo $form['id_type']->renderError() ?>
                                           <?php echo $form['id_type'] ?>
                                </td>
                            </tr>
                            <tr class="disabledbutton">
                                <td><label>Numéro</label></td>
                                <td colspan="4">
                                    <?php echo $form['numero']->renderError() ?>
                                    <?php
                                    if ($form->getObject()->isNew())
                                        echo $form['numero']->render(array('value' => $form->getObject()->NumeroSeqDocumentAchat(3)));
                                    else
                                        echo $form['numero']->render(array('value' => $form->getObject()->getNumerodocachat()));
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td><label>Date Création</label></td>
                                <td>
                                    <?php echo $form['datecreation']->renderError() ?>
                                    <?php echo $form['datecreation']; ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </fieldset>
                <fieldset>
                    <legend>Informations sur le Budget <?php echo date('d/m/Y', strtotime($form->getObject()->getDatecreation())); ?></legend>
                    <?php if ($ligne) : ?>
                        <table>
                            <tbody>

                                <tr>
                                    <td>Exercice</td>
                                    <td colspan="5" class="disabledbutton">
                                        <input type="text" name="exercice" value="<?php echo $ligne->getTitrebudjet()->getTypebudget() ?>">
                                    </td>
                                </tr>
                                <tr>
                                    <td>Budget</td>
                                    <td colspan="5" class="disabledbutton">
                                        <input type="text" name="libellebudget" value="<?php echo $ligne->getTitrebudjet()->getLibelle() ?>">
                                    </td>

                                </tr>
                                <tr class="disabledbutton">
                                    <td>Rubrique</td>
                                    <td colspan="2">
                                        <input type="text" class="form-control" id="rubrique" value="<?php echo $ligne->getRubrique()->getRubriqueparent() ?>">
                                    </td>
                                    <td>Sous Rubrique</td>
                                    <td colspan="2">
                                        <input type="text" class="form-control" id="sousrubrique" value="<?php echo $ligne->getRubrique() ?>">
                                    </td>
                                </tr>
                                <tr class="disabledbutton">
                                    <td>Crédit Réservé</td>
                                    <td>
                                        <ul>
                                            <li>Alloué: <input type="text" class="form-control" value="<?php if ($ligne && $ligne->getIdTitre()) echo number_format($ligne->getMnt(), 3, ',', ' '); ?>" id="mnt"></li>
                                            <li>Bloqué: <input type="text" class="form-control" value="<?php if ($ligne && $ligne->getIdTitre()) echo number_format($ligne->getMntencaisse(), 3, ',', ' '); ?>" id="mntencaisser"></li>
                                        </ul>
                                    </td>
                                    <td>Crédit Engagé</td>
                                    <td>
                                        <ul>
                                            <li>Définitive: <input type="text" class="form-control" value="<?php if ($ligne && $ligne->getIdTitre() && $ligne->getMntengage()) echo number_format($ligne->getMntengage(), 3, ',', ' '); ?>" id="credit"></li>
                                            <li>Provisoire: <input type="text" class="form-control" value="<?php if ($ligne && $ligne->getIdTitre()) echo number_format($ligne->getMntprovisoire(), 3, ',', ' '); ?>" id="creaditporv"></li>
                                            <?php $total = $ligne->getMntprovisoire() + $ligne->getMntengage(); ?>
                                            <li>Total: <input type="text" class="form-control" value="<?php if ($ligne && $ligne->getIdTitre()) echo number_format($total, 3, ',', ' '); ?>" id="total_engage"></li>
                                        </ul>
                                    </td>
                                    <td>Reliquat</td>
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
                                        $relicatprovisoire = $ligne->getMnt() - $mntprovisoire;
                                        $relicat = $ligne->getMnt() - $mntengager;
                                        if ($ligne && $ligne->getIdTitre())
                                            $relicat = $relicat;
                                        ?>
                                        <ul>
                                            <li>Définitive: <input type="text" class="form-control" value="<?php echo number_format($relicat, 3, ",", " "); ?>" id="reliq"></li>
                                            <!--<li>Provisoire: <input type="text" class="form-control" value="<?php // echo number_format($relicatprovisoire, 3, ',', ' ')          
                                        ?>" id="reliqprovisoire"></li>-->
                                            <?php
                                            $mntengager = 0;
                                            $relicat = 0;
                                            $mntprovisoire = 0;
                                            $relicatprovisoire = 0;
                                            if ($ligne->getMntengage())
                                                $mntengager = $ligne->getMntengage();
                                            if ($ligne->getMntprovisoire())
                                                $mntprovisoire = $ligne->getMntprovisoire();
                                            $relicatprovisoire = $ligne->getMnt() - $mntprovisoire - $mntengager;
                                            $relicat = $ligne->getMnt() - $mntengager - $mntprovisoire;
                                            if ($ligne && $ligne->getIdTitre())
                                                $relicat = $relicat;
                                            ?>
                                            <li>Provisoire+Définitive: <input type="text" class="form-control" value="<?php echo number_format($relicatprovisoire, 3, ',', ' ') ?>" id="reliqprovisoire"></li>
                                        </ul>
                                    </td>
                                    <?php
                                    // if ($documentachat->getDroittimbre() == 1) {
                                    //     $mnttc = $documentachat->getMntttc() + 0.600;
                                    // } else
                                    $mnttc = $documentachat->getMntttc();
                                    ?>
                                <tr>
                                    <td>Montant</td>
                                    <td>
                                        <input type="text" class="form-control" value="<?php echo $mnttc ?>" id="mntttc">
                                    </td>
                                    <td colspan="4" style="color: red">
                                        <table style="margin-bottom: 0px;">
                                            <?php $mntprovisoire = 0; ?>
                                            <thead>
                                                <tr>
                                                    <th></th>
                                                    <th style="color: #0066cc">Provisoire</th>
                                                    <th style="color: #0066cc">Définitif</th>
                                                </tr>
                                            </thead>
                                            <tr>
                                                <td style="color: green"><?php echo $doc_achat ?></td>
                                                <td></td>
                                                <td><?php echo number_format($mnttc, 3, ",", " ") ?></td>
                                            </tr>
                                            <?php if ($documentfils && !$form->getObject()->isNew() && !$form->getObject()->getMnt()) { ?>
                                                <tr>
                                                    <td style="color: green"><?php echo $documentfils ?></td>

                                                    <td><?php
                                                        // if ($documentfils->getDroittimbre() == 1) {
                                                        //     $mnttc_fils = $documentfils->getMntttc() + 0.600;
                                                        // } else
                                                        $mnttc_fils = $documentfils->getMntttc();
                                                        $mntprovisoire = $mnttc_fils;
                                                        if ($mntprovisoire != 0.000) {
                                                            echo number_format($mnttc_fils, 3, ",", " ");
                                                        } else {
                                                            $quitance = LigneoperationcaisseTable::getInstance()->findByIdDocachatAndIdCategorie($documentfils->getId(), 1);
                                                            if (sizeof($quitance) >= 1) {
                                                                echo $quitance->getFirst()->getMntoperation();
                                                            }
                                                        }
                                                        ?></td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td style="color: green">Différence</td>
                                                    <td colspan="2">
                                                        <?php
                                                        $quitance = LigneoperationcaisseTable::getInstance()->findByIdDocachatAndIdCategorie($documentfils->getId(), 1);
                                                        if (sizeof($quitance) >= 1) {
                                                            $dif = $mnttc - $quitance->getFirst()->getMntoperation();
                                                        }
                                                        echo number_format($dif, 3, ',', ' ');
                                                        ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="3" style="background-color: #ffdbdb; color: #757575; font-size: 16px;">===> Après l'engagement </td>
                                                </tr>
                                                <tr style="background-color: #b6fdbb; color: #757575;">
                                                    <td style="color: green">Crédit Engagé</td>
                                                    <td><?php echo number_format($ligne->getMntprovisoire(), 3, ',', ' ') . ' - ' . $mntprovisoire . ' = ' . number_format($ligne->getMntprovisoire() - $mntprovisoire, 3, ',', ' ') ?></td>
                                                    <td><?php echo number_format($ligne->getMntengage(), 3, ',', ' ') . ' + ' . number_format($mnttc, 3, ",", " ") . " = " . number_format($ligne->getMntengage() + $documentachat->getMntttc(), 3, ",", " ") ?></td>
                                                </tr>
                                                <tr style="background-color: #b6fdbb; color: #757575;">
                                                    <td style="color: green">Reliquat</td>
                                                    <td>
                                                        <?php
                                                        //                                                    $mnt = number_format($mntprovisoire + $relicatprovisoire, 3, ',', ' ');
                                                        //                                                    echo number_format($relicatprovisoire, 3, ',', ' ') . ' + ' . number_format($mntprovisoire, 3, ',', ' ') . ' = ' . $mnt;
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <?php
                                                        $mntd = number_format($relicat - $documentachat->getMntttc(), 3, ',', ' ');
                                                        echo number_format($relicat, 3, ',', ' ') . ' - ' . number_format($mnttc, 3, ',', ' ') . ' = ' . $mntd;
                                                        ?>
                                                    </td>
                                                </tr>
                                                <!--                                            <tr style="background-color: #b6fdbb; color: #757575;">
                                                <td style="color: green">Reliquat Total</td>
                                                <td>
                                                <?php
                                                //                                                    $mnt = number_format($mntprovisoire + $relicatprovisoire, 3, ',', ' ');
                                                //                                                    echo number_format($relicatprovisoire, 3, ',', ' ') . ' + ' . number_format($mntprovisoire, 3, ',', ' ') . ' = ' . $mnt;
                                                ?>

                                                </td>
                                            </tr>-->
                                            <?php } ?>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Objet</td>
                                    <td colspan="8">
                                        <textarea id="txt_object">
                                            <?php
                                            if (!$form->getObject()->isNew())
                                            //                                        echo $piece->getDescription(); 
                                                
                                                ?>
                                        </textarea>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    <?php endif; ?>
                </fieldset>
                <fieldset>
                    <legend>Action</legend>
                    <?php if ($doc_achat->getIdTypedoc() == 7) { ?>
                        <?php if ($idpiece == 0) { ?>
                            <input type="button" value="Mettre à ajour" ng-click="AjouterPreengagement(<?php echo $documentachat->getId() ?>)">
                            <?php
                        }
                        if ($documentachat->getDatesignature() && $idpiece != 0) {
                            ?>
                            <input type="button" value="Valider Engagement" ng-click="ValiderEngagement(<?php echo $documentachat->getId() ?>,<?php echo $form->getObject()->getId() ?>)">
                        <?php } ?>
                    <?php } ?>
                    <?php if ($doc_achat->getIdTypedoc() == 2 || $doc_achat->getIdTypedoc() == 17) { ?>
                        <?php if ($idpiece == 0) { ?>
                            <input type="button" value="Mettre à ajour" ng-click="AjouterPreengagement(<?php echo $documentachat->getId() ?>)">
                            <?php
                        }
                        if ($documentachat->ValidationEngagement() == 0 && $idpiece != 0 && $doc_achat->getIdTypedoc() == 2 && !$form->getObject()->getMnt()) {
                            ?>
                            <input type="button" value="Valider Engagement" ng-click="ValiderEngagement(<?php echo $documentachat->getId() ?>,<?php echo $form->getObject()->getId() ?>)">
                        <?php } ?>
                    <?php } ?>
                    <?php if (!$form->getObject()->isNew() && $form->getObject()->getMnt()) { ?>
                        <a class="btn btn-white btn-default" target="__blanc" href="<?php echo url_for('Documents/Imprimerprovisoire') . '?idfiche=' . $form->getObject()->getId() . '&iddoc=' . $documentachat->getId() ?>">Exporter Pdf & Impression <?php echo $form->getObject()->getTypedocbudget() ?></a>
                    <?php } ?>
                </fieldset>
            </div>
        </div>
        <div class="col-sm-6">
            <div class=" tab-content">
                <h3 class="row header smaller lighter blue">
                    <span class="col-xs-6"><i class="fa fa-plus"></i> Détail  </span><!-- /.col -->
                </h3>

                <?php
                $numero = strtoupper($documentachat->getTypedoc());
                $numero = str_replace(array('à', 'á', 'â', 'ã', 'ä', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ñ', 'ò', 'ó', 'ô', 'õ', 'ö', 'ù', 'ú', 'û', 'ü', 'ý', 'ÿ'), array('À', 'Á', 'Â', 'Ã', 'Ä', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ñ', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'Ù', 'Ú', 'Û', 'Ü', 'Ý'), $numero);
                ?>
                <?php if ($documentparent): ?>
                    <p>
                        <a target="__blanc" href="<?php echo url_for('documentachat/Imprimerdocachat?iddoc=' . $documentparent->getId()) ?>">
                            <i class="fa fa-eye"></i> <?php echo $documentparent->getTypedoc() ?> N°:<?php echo $documentparent->getNumerodocachat() ?>
                        </a>
                    </p>
                <?php endif ?>
                <?php if ($doc_achat->getIdTypedoc() == 7) { ?>
                    <p>
                        <a target="__blanc" href="<?php echo url_for('documentachat/imprimerBCEDefinitf?iddoc=' . $documentachat->getId()) ?>">
                            <i class="fa fa-eye"></i> <?php echo $numero ?> N°:<?php echo $documentachat->getNumerodocachat() ?>
                        </a>
                    </p>
                <?php } ?>

                <?php if ($doc_achat->getIdTypedoc() == 17) { ?>
                    <p>
                        <a target="__blanc" href="<?php echo url_for('documentachat/imprimerBDCProvisoire?iddoc=' . $documentachat->getId()) ?>">
                            <i class="fa fa-eye"></i> <?php echo $numero ?> N°:<?php echo $documentachat->getNumerodocachat() ?>
                        </a>
                    </p>
                <?php } ?>
                <?php if ($doc_achat->getIdTypedoc() == 2) { ?>
                    <p>
                        <a target="__blanc" href="<?php echo url_for('documentachat/imprimerBDCDefinitf?iddoc=' . $documentachat->getId()) ?>">
                            <i class="fa fa-eye"></i> <?php echo $numero ?> N°:<?php echo $documentachat->getNumerodocachat() ?>
                        </a>
                    </p>
                <?php } ?>


                <?php
                if ($documentfils) {
                    $piece_joint_provisoire = PiecejointbudgetTable::getInstance()->findOneByIdDocachat($documentfils->getId());
                    if ($piece_joint_provisoire) {
                        ?>
                        <p>
                            <a target="__blank" href="<?php echo url_for('Documents/Imprimerprovisoire') . '?iddoc=' . $documentfils->getId() . "&idfiche=" . $piece_joint_provisoire->getIdDocumentbudget() ?>">
                                <i class="fa fa-eye"></i> Fiche Engagement Provisoire N°:<?php echo $piece_joint_provisoire->getDocumentbudget()->getNumerodocachat() ?>
                            </a>
                        </p>

                        <?php
                    }
                }
                ?>

            </div>
        </div>
    </div>
</div>