<?php
$piece = Doctrine_Core::getTable('piecejointbudget')->findOneByIdDocachat($documentachat->getIdFils());
$idpiece = 0;
if ($piece)
    $idpiece = $piece->getId();
$doc_achat = new Documentachat();
$doc_achat = $documentachat;
?>

<div id="sf_admin_container" ng-controller="CtrlFormEngagement" ng-init="AffichePreEngagement(<?php echo $idpiece ?>,<?php echo $documentachat->getId() ?>)">
    <h1 id="replacediv"> 
        Engagement du <?php echo $doc_achat->getTypedoc() ?> : <?php echo $documentachat->getNumerodocachat() ?>
    </h1>
    <div class="panel-body">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs">
            <li class="<?php if ($tab == "") echo 'active' ?>"><a href="#home" data-toggle="tab" aria-expanded="true">Détail </a></li>
            <?php if ($trouve_facture != 0) { ?>
                <li class=""><a href="#facture" data-toggle="tab" aria-expanded="true">Détail Facture</a></li>
            <?php } ?>
            <li class="<?php if ($tab != "") echo 'active' ?>" ng-click="InialiserPreengagment()"><a href="#engagement" data-toggle="tab" aria-expanded="false">Engagement Définitif</a></li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane <?php if ($tab == "") echo ' fade active in' ?>" id="home">
                <div style="margin-top: 10px;" class="row">
                    <div class="col-lg-6">
                        <?php
                        $numero = strtoupper($documentachat->getTypedoc());
                        $numero = str_replace(array('à', 'á', 'â', 'ã', 'ä', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ñ', 'ò', 'ó', 'ô', 'õ', 'ö', 'ù', 'ú', 'û', 'ü', 'ý', 'ÿ'), array('À', 'Á', 'Â', 'Ã', 'Ä', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ñ', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'Ù', 'Ú', 'Û', 'Ü', 'Ý'), $numero);
                        ?>
                        <h4 style="height: 50px;"><?php echo $numero ?> N°:<?php echo $documentachat->getNumerodocachat() ?></h4> 
                        <?php if ($doc_achat->getIdTypedoc() == 7) { ?>
                            <object style="width: 100%;height: 800px;" data="<?php echo url_for('Documents/Imprimerbonexterne?iddoc=' . $documentachat->getId()) ?>" type="application/pdf">
                                <embed src="<?php echo url_for('Documents/Imprimerbonexterne?iddoc=' . $documentachat->getId()) ?>" type="application/pdf" />
                            </object>
                        <?php } ?>
                        <?php if ($doc_achat->getIdTypedoc() == 2 || $doc_achat->getIdTypedoc() == 17) { ?>
                            <object style="width: 100%;height: 800px;" data="<?php echo url_for('Documents/Imprimerbondeponse?iddoc=' . $documentachat->getId()) ?>" type="application/pdf">
                                <embed src="<?php echo url_for('Documents/Imprimerbondeponse?iddoc=' . $documentachat->getId()) ?>" type="application/pdf" />
                            </object>
                        <?php } ?>
                    </div>
                    <div class="col-lg-6">
                        <h4 style="height: 50px;"><?php
                            if ($documentachat->getIdFils()) {
                                $documentfils = Doctrine_Core::getTable('documentachat')->findOneById($documentachat->getIdFils());
                                if ($documentfils) {
                                    $numero = strtoupper($documentfils->getTypedoc());
                                    $numero = str_replace(array('à', 'á', 'â', 'ã', 'ä', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ñ', 'ò', 'ó', 'ô', 'õ', 'ö', 'ù', 'ú', 'û', 'ü', 'ý', 'ÿ'), array('À', 'Á', 'Â', 'Ã', 'Ä', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ñ', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'Ù', 'Ú', 'Û', 'Ü', 'Ý'), $numero);
                                    echo $numero
                                    ?> N°:<?php echo $documentfils->getNumerodocachat() ?></h4> 
                                <?php if ($doc_achat->getIdTypedoc() == 7) { ?>
                                    <object style="width: 100%;height: 800px;" data="<?php echo url_for('Documents/Imprimerbonexterne?iddoc=' . $documentfils->getId()) ?>" type="application/pdf">
                                        <embed src="<?php echo url_for('Documents/Imprimerbonexterne?iddoc=' . $documentfils->getId()) ?>" type="application/pdf" />
                                    </object>
                                <?php } ?>
                                <?php if ($doc_achat->getIdTypedoc() == 2 || $doc_achat->getIdTypedoc() == 17) { ?>
                                    <object style="width: 100%;height: 800px;" data="<?php echo url_for('Documents/Imprimerbondeponse?iddoc=' . $documentfils->getId()) ?>" type="application/pdf">
                                        <embed src="<?php echo url_for('Documents/Imprimerbondeponse?iddoc=' . $documentfils->getId()) ?>" type="application/pdf" />
                                    </object>
                                    <?php
                                }
                            }
                        }
                        ?>
                    </div>
                    <?php
                    if ($documentfils) {
                        $piece_joint_provisoire = Doctrine_Core::getTable('piecejointbudget')->findOneByIdDocachat($documentfils->getId());
                        if ($piece_joint_provisoire) {
                            ?>
                            <div class="col-lg-12" style="margin-top: 20px;">
                                <fieldset>
                                    <legend>Fiche Engagement Provisoire</legend>
                                    <object style="width: 100%;height: 900px;" data="<?php echo url_for('Documents/Imprimerprovisoire?iddoc=' . $documentfils->getId() . "&idfiche=" . $piece_joint_provisoire->getIdDocumentbudget()) ?>" type="application/pdf">
                                        <embed src="<?php echo url_for('Documents/Imprimerprovisoire?iddoc=' . $documentfils->getId() . "&idfiche=" . $piece_joint_provisoire->getIdDocumentbudget()) ?>" type="application/pdf" />
                                    </object>
                                </fieldset>
                            </div>
                            <?php
                        }
                    }
                    ?>
                </div>
            </div>
            <?php if ($trouve_facture != 0) { ?>
                <div class="tab-pane" id="facture">
                    <h4><?php echo strtoupper($facture->getTypedoc()) ?> N°:<?php echo $facture->getNumerodocachat() ?></h4>
                    <div style="margin-top: 10px;">
                        <object style="width: 100%;height: 900px;" data="<?php echo url_for('Documents/Imprimerdocentre?iddoc=' . $facture->getId()) ?>" type="application/pdf">
                            <embed src="<?php echo url_for('Documents/Imprimerdocentre?iddoc=' . $facture->getId()) ?>" type="application/pdf" />
                        </object>
                    </div>
                </div>
            <?php } ?>
            <div class="tab-pane <?php if ($tab != "") echo ' fade active in' ?>" id="engagement">
                <fieldset <?php if ($idpiece != 0) echo 'class="disabledbutton"' ?> >
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
                    <table>
                        <tbody>
                            <tr>
                                <td>Exercice</td>
                                <td colspan="5">
                                    <?php
//                                    $date = date('Y');
                                    $date = $_SESSION['exercice_budget'];
//                                    if (!$form->getObject()->isNew() && $form->getObject()->getDatecreation()) {
//                                        $date = date('Y', strtotime($form->getObject()->getDatecreation()));
//                                    }
                                    echo $date;
                                    ?>
                                </td>
                            </tr>
                            <tr <?php if ($idpiece != 0) echo 'class="disabledbutton"' ?>>
                                <td>Budget</td>
                                <td colspan="2">
                                    <?php
//                                    $annees = date('Y');
                                    $annees = $_SESSION['exercice_budget'];
                                    $budgets = Doctrine_Query::create()
                                                    ->select("*")
                                                    ->from('titrebudjet')
                                                    ->where("Etatbudget=2")
                                                    ->andwhere("trim(typebudget) not like trim('Prototype') ")
                                                    ->andwhere("trim(typebudget) like trim('Exercice:" . $annees . "')")
                                                    ->orderBy('id asc')->execute();
                                    //Doctrine_Core::getTable('titrebudjet')->findByEtatbudget(2);
//                                    if (!$form->getObject()->isNew() && $form->getObject()->getIdBudget()) {
                                    if ($form->getObject()->getIdBudget()) {
                                        $ligne = LigprotitrubTable::getInstance()->find($form->getObject()->getIdBudget());
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
                                <td>N°D'engagement</td>
                                <td colspan="2">
                                    <input type="hidden" id="id_budget" value="<?php if (!$form->getObject()->isNew() && $form->getObject()->getIdBudget()) echo $form->getObject()->getIdBudget(); ?>">
                                    <select id="numeroengaement" name="numeroengaement">

                                    </select>
                                </td>
                            </tr>
                            <tr class="disabledbutton">
                                <td>Rubrique</td>
                                <td colspan="8">
                                    <input type="text" class="form-control" id="rubrique"
                                           value="<?php if ($ligne && $ligne->getIdTitre()) echo $ligne->getRubrique() ?>">
                                </td>
                            </tr>
                            <tr class="disabledbutton">
                                <td>Crédit Réservé</td>
                                <td>
                                    <ul>
                                        <li>Alloué: <input type="text" class="form-control" value="<?php if ($ligne && $ligne->getIdTitre()) echo number_format($ligne->getMnt(), 3, ',', ' '); ?>" id="mnt" ></li>
                                        <li>Bloqué: <input type="text" class="form-control" value="<?php if ($ligne && $ligne->getIdTitre()) echo number_format($ligne->getMntencaisse(), 3, ',', ' '); ?>" id="mntencaisser" ></li>
                                    </ul>
                                </td>
                                <td>Crédit Engagé</td>
                                <td>
                                    <ul>
                                        <li>Définitive: <input type="text" class="form-control" value="<?php if ($ligne && $ligne->getIdTitre() && $ligne->getMntengage()) echo number_format($ligne->getMntengage(), 3, ',', ' '); ?>" id="credit"></li>
                                        <li>Provisoire: <input type="text" class="form-control" value="<?php if ($ligne && $ligne->getIdTitre()) echo number_format($ligne->getMntprovisoire(), 3, ',', ' '); ?>" id="creaditporv" ></li>
                                        <?php $total = floatval($ligne->getMntprovisoire()) + floatval($ligne->getMntengage()); ?>
                                        <li>Total: <input type="text" class="form-control" value="<?php if ($ligne && $ligne->getIdTitre()) echo number_format($total, 3, ',', ' '); ?>" id="total_engage" ></li>

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
                                        <!--<li>Provisoire: <input type="text" class="form-control" value="<?php // echo number_format($relicatprovisoire, 3, ',', ' ')        ?>" id="reliqprovisoire"></li>-->
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
                            </tr>
                            <tr>
                                <td>Montant</td>
                                <td>
                                    <input type="text" class="form-control" value="<?php echo $documentachat->getMntttc() ?>" id="mntttc">
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
                                            <td><?php echo number_format($documentachat->getMntttc(), 3, ",", " ") ?></td>
                                        </tr>
                                        <?php if ($documentfils && !$form->getObject()->isNew() && !$form->getObject()->getMnt()) { ?>
                                            <tr>
                                                <td style="color: green"><?php echo $documentfils ?></td>

                                                <td><?php
                                                    $mntprovisoire = $documentfils->getMntttc();
                                                    echo number_format($documentfils->getMntttc(), 3, ",", " ")
                                                    ?></td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td style="color: green">Différence</td>
                                                <td colspan="2">
                                                    <?php
                                                    $dif = $documentachat->getMntttc() - $mntprovisoire;
                                                    echo number_format($dif, 3, ',', ' ');
                                                    ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="3" style="background-color: #ffdbdb; color: #757575; font-size: 16px;">===> Après l'engagement Provisoire</td>
                                            </tr>
                                            <tr style="background-color: #b6fdbb; color: #757575;">
                                                <td style="color: green">Crédit Engagé</td>
                                                <td><?php echo number_format($ligne->getMntprovisoire(), 3, ',', ' ') . ' - ' . $mntprovisoire . ' = ' . number_format($ligne->getMntprovisoire() - $mntprovisoire, 3, ',', ' ') ?></td>
                                                <td><?php echo number_format($ligne->getMntengage(), 3, ',', ' ') . ' + ' . number_format($documentachat->getMntttc(), 3, ",", " ") . " = " . number_format($ligne->getMntengage() + $documentachat->getMntttc(), 3, ",", " ") ?></td>
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
                                                    echo number_format($relicat, 3, ',', ' ') . ' - ' . number_format($documentachat->getMntttc(), 3, ',', ' ') . ' = ' . $mntd;
                                                    ?>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td>Objet</td>
                                <td colspan="8">
                                    <textarea id="txt_object"><?php // if (!$form->getObject()->isNew()) echo $piece->getDescription();  ?></textarea>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </fieldset>
                <fieldset>
                    <legend>Action</legend>

                    <?php if ($doc_achat->getIdTypedoc() == 19 || $doc_achat->getIdTypedoc() == 20) { ?>
                        <?php if ($idpiece == 0) { ?>
                            <input  type="button" value="Mettre à ajour" ng-click="AjouterPreengagement(<?php echo $documentachat->getId() ?>)">
                        <?php }

                        if ($documentachat->ValidationEngagementContrat() == 0 && $idpiece != 0 && $doc_achat->getIdTypedoc() == 20) {
                            ?>
                            <input  type="button" value="Valider Engagement" ng-click="ValiderEngagementContrat(<?php echo $documentachat->getId() ?>,<?php echo $form->getObject()->getId() ?>)">
                        <?php } ?>
                    <?php } ?>
                    <?php if ($form->getObject()->getMnt()) { ?>
                        <a class="btn btn-white btn-default" target="__blanc" href="<?php echo url_for('Documents/Imprimerprovisoire?idfiche=') . $form->getObject()->getId() . '&iddoc=' . $documentachat->getId() ?>" >Exporter Pdf & Impression <?php echo $form->getObject()->getTypedocbudget() ?></a>
                    <?php } ?>
                </fieldset>
            </div>
        </div>
    </div>
</div>