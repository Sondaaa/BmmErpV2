<style>
    table {
        border-spacing: 1px;
    }

    th {
        padding: 5px;
    }

    td {
        padding: 10px;
    }
</style>
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h3 class="smaller lighter blue no-margin">Détail d'engagement provisoire</h3>
</div>
<div class="modal-body">
    <?php
    $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
    $text_lists_bon_extrene = "";
    $mnt_total = 0;
    $form = new DocumentbudgetForm();
    foreach ($listdoc as $key => $list) :
        $mnt_total += $list['ttc'];
        $bon_commande_externe = DocumentachatTable::getInstance()->findOneById($list['id']);
        $documentachat = new Documentachat();
       
        $typedoc = TypedocTable::getInstance()->findOneById($bon_commande_externe->getIdTypedoc());
        if ($key < count($listdoc) - 1)
            $text_lists_bon_extrene .= $bon_commande_externe . ' , ';
        else
            $text_lists_bon_extrene .= $bon_commande_externe;
    endforeach;
    ?>
    <fieldset>
        <legend><?php
            if ($listdoc && $typedoc) {
                echo $typedoc . ':   (' . $text_lists_bon_extrene . ')';
            }
            ?>
            <br>
            <span style="color:brown"> Montant total: <?php echo number_format($mnt_total, 3, ',', ' ') ?></span>
        </legend>
        <table style="margin-bottom: 10px;">
            <tbody>
                <tr>
                    <td>Numéro</td>
                    <td class="disabledbutton">
                        <?php echo $form['numero']->renderError() ?>
                        <?php echo $form['numero']->render(array('value' => $form->getObject()->NumeroSeqDocumentAchat(3))); ?>
                    </td>
                    <td>Date Création</td>
                    <td class="disabledbutton">
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
                                    <th>Exercice</th>
                                    <th> <?php
                                        $date = $_SESSION['exercice_budget'];
                                        echo $date;
                                        ?></th>


                                </tr>


                                </tr>
                            </thead>
                            <tr>
                                <th>Budget</th>
                                <td>
                                    <?php
                                    $ligne = new Ligprotitrub();
                                    $budgets = Doctrine_Query::create()
                                            ->select("*")
                                            ->from('titrebudjet')
                                            ->where("Etatbudget=2")
                                            ->andwhere(" trim(typebudget) like trim('Exercice:" . $_SESSION['exercice_budget'] . "')")
                                            ->orderBy('id asc');
                                    $budgets = $budgets->execute();
                                    $ligne = null;
                                    $ligne_parent = null;
                                    if ($bon_commande_externe->getDocumentparent()->getLigavisdoc()->getFirst()) {
                                        $ligne = $bon_commande_externe->getDocumentparent()->getLigavisdoc()->getFirst()->getLigprotitrub();
                                    }
                                    ?>

                                    <select id="budget" class="chosen-select form-control" onchange="chargerRubriqueAndSousRubrique('titrebudjet', 'liste_rubrique')">
                                        <?php foreach ($budgets as $budget) { ?>
                                            <option value="<?php echo $budget->getId() ?>" <?php if ($ligne && $ligne->getIdTitre() == $budget->getId()) echo 'selected="selected"' ?>>
                                                <?php echo $budget->getCategorietitre() . ': ' . $budget->getLibelle() ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    Rubrique budgétaire
                                    <div id="div_select">
                                        <?php
                                        if ($ligne->getRubrique()->getIdRubrique() && $ligne->getIdTitre()) :
                                            $rubP = RubriqueTable::getInstance()->findOneById($ligne->getRubrique()->getIdRubrique());

                                            $query = "SELECT ligprotitrub.id, ligprotitrub.nordre, ligprotitrub.code, "
                                                    . " rubrique.libelle, ligprotitrub.mnt,rubrique.id as rp,"
                                                    . " ligprotitrub.mntengage, ligprotitrub.mntdeponser, "
                                                    . " ligprotitrub.mntencaisse, mntprovisoire "
                                                    . " FROM ligprotitrub, rubrique "
                                                    . " WHERE ligprotitrub.id_rubrique = rubrique.id and rubrique.id_rubrique is null "
                                                    . " AND ligprotitrub.id_titre = " . $ligne->getIdTitre() . "  order by ligprotitrub.nordre asc";
                                            $rubrique_parent = $conn->fetchAssoc($query);
                                            ?>
                                            <?php if (count($rubrique_parent) > 0) : ?>
                                                <select id="<?php if ($rubP) echo 'parent_' . $rubP->getId() ?>">
                                                    <?php foreach ($rubrique_parent as $parent) : ?>

                                                        <option value="<?php echo $parent['id'] ?>" <?php
                                                        if ($rubP && $rubP->getId() == $parent['rp']) : echo 'selected';
                                                        endif;
                                                        ?>>
                                                                    <?php echo $parent['code'] . ' ' . $parent['libelle'] ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <?php
                                                if ($rubP) :
                                                    $query_enfant = "SELECT ligprotitrub.id, ligprotitrub.nordre, ligprotitrub.code, "
                                                            . " rubrique.libelle, ligprotitrub.mnt,rubrique.id as rp, "
                                                            . " ligprotitrub.mntengage, ligprotitrub.mntdeponser, "
                                                            . " ligprotitrub.mntencaisse, mntprovisoire "
                                                            . " FROM ligprotitrub, rubrique "
                                                            . " WHERE ligprotitrub.id_rubrique = rubrique.id"
                                                            . " AND ligprotitrub.id_titre = " . $ligne->getIdTitre() . " "
                                                            . " AND rubrique.id_rubrique='" . $rubP->getId() . "'"
                                                            . " order by ligprotitrub.nordre asc";
                                                    $rubrique_enfant = $conn->fetchAssoc($query_enfant);
                                                    if (count($rubrique_enfant) > 0) :
                                                        ?>
                                                        <select id="<?php if ($rubP) echo 'enf_' . $rubP->getId() ?>">
                                                            <?php foreach ($rubrique_enfant as $parent) : ?>

                                                                <option value="<?php echo $parent['id'] ?>" <?php
                                                                if ($ligne->getIdRubrique() == $parent['rp']) : echo 'selected';
                                                                endif;
                                                                ?>>
                                                                            <?php echo $parent['code'] . ' ' . $parent['libelle'] ?>
                                                                </option>
                                                            <?php endforeach; ?>
                                                        </select>

                                                        </select>
                                                        <?php
                                                    endif;
                                                endif;
                                                ?>
                                            <?php endif; ?>
                                            <?php
                                        else :
                                            if ($ligne->getRubrique()->getId() )
                                                $rubP = RubriqueTable::getInstance()->findOneById($ligne->getRubrique()->getId());
                                            $query = "SELECT ligprotitrub.id, ligprotitrub.nordre, ligprotitrub.code, "
                                                    . " rubrique.libelle, ligprotitrub.mnt,rubrique.id as rp,"
                                                    . " ligprotitrub.mntengage, ligprotitrub.mntdeponser, "
                                                    . " ligprotitrub.mntencaisse, mntprovisoire "
                                                    . " FROM ligprotitrub, rubrique "
                                                    . " WHERE ligprotitrub.id_rubrique = rubrique.id and rubrique.id_rubrique is null ";
                                            if ($ligne &&  $ligne->getIdTitre())
                                                $query = $query . " AND ligprotitrub.id_titre = " . $ligne->getIdTitre();
                                            $query = $query . "  order by ligprotitrub.nordre asc";
                                            $rubrique_parent = $conn->fetchAssoc($query);
                                            ?>
                                            <select id="<?php if ($rubP) echo 'parent_' . $rubP->getId() ?>" onchange="chargerSousRubriqueEtCalculer('<?php if ($rubP) echo 'parent_' . $rubP->getId() ?>')">
                                                <?php foreach ($rubrique_parent as $parent) : ?>

                                                    <option value="<?php echo $parent['id'] ?>" <?php
                                                    if ($rubP && $rubP->getId() == $parent['rp']) : echo 'selected';
                                                    endif;
                                                    ?>>
                                                                <?php echo $parent['code'] . ' ' . $parent['libelle'] ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>

                                        <?php
                                        endif;
                                        ?>
                                    </div>

                                </td>
                            </tr>
                            <tr>
                                <td colspan="3">
                                    <button onclick="chargerRubriqueAndSousRubrique('titrebudjet', 'liste_rubrique')" class="btn btn-banger btn-sm"><i class="fa fa-gear"></i>
                                        Changer rubrique budgétaire
                                    </button>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr class="disabledbutton">
                    <td style="width: 60%;">
                        Rubrique
                        <input type="hidden" class="form-control" id="id_rubrique_sous_rubrique" value="<?php if ($ligne && $ligne->getIdTitre()) echo $ligne->getId() ?>">
                        <input type="text" class="form-control" id="rubrique" value="<?php if ($ligne && $ligne->getIdTitre()) echo $ligne->getRubrique() ?>">
                    </td>
                    <td>
                        Montant
                        <input type="text" class="form-control align_right" id="mntttc" value="<?php if ($ligne && $ligne->getIdTitre()) echo number_format(floatval($ligne->getMnt()), 3, ',', ' ') ?>">
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        <table style="margin-bottom: 0px;">
                            <thead>
                                <tr>
                                    <th>Crédit Réservé</th>
                                    <th>Crédit Engagé</th>
                                    <th>Reliquat</th>
                                </tr>
                            </thead>
                            <tr class="disabledbutton">
                                <td> <?php //                                                            echo ($ligne->getMnt().'devdddddddd');       
                                        ?>
                                    <ul style="list-style: none;">
                                        <li>Alloué: <input type="text" class="form-control align_right" value="<?php
                                            if ($ligne && $ligne->getIdTitre())
                                                echo number_format($ligne->getMnt(), 3, ',', ' ');
                                            ?>" id="mnt"></li>
                                        <li>DéBloqué: <input type="text" class="form-control align_right" value="<?php
                                            if ($ligne && $ligne->getIdTitre())
                                                echo number_format($ligne->getMntencaisse(), 3, ',', ' ');
                                            ?>" id="mntencaisser"></li>

                                    </ul>
                                </td>
                                <td>
                                    <ul style="list-style: none;">
                                        <li>Définitif: <input type="text" class="form-control align_right" value="<?php
                                            if ($ligne && $ligne->getIdTitre() && $ligne->getMntengage())
                                                echo number_format($ligne->getMntengage(), 3, '.', ',');
                                            else
                                                echo '0.000'
                                                ?>" id="credit"></li>
                                        <li>Provisoire: <input type="text" class="form-control align_right" value="<?php if ($ligne && $ligne->getIdTitre()) echo number_format($ligne->getMntprovisoire(), 3, ',', ' '); ?>" id="creaditporv"></li>
                                        <?php
                                        $total = '0.000';

                                        $total = floatval($ligne->getMntengage()) + floatval($ligne->getMntprovisoire());

                                        //die("fed".floatval($total)); 
                                        ?>
                                        <li>Total: <input type="text" class="form-control align_right" value="<?php if ($total) echo number_format(floatval($total), 3, ',', ' '); ?>" id="total_engage"></li>
                                    </ul>
                                </td>
                                <td>
                                    <?php
                                    //                                                            echo ($ligne->getMnt().'fffffff');
                                    $mntengager = 0;
                                    $relicat = 0;
                                    $mntprovisoire = 0;
                                    $relicatprovisoire = 0;
                                    if ($ligne->getMntengage())
                                        $mntengager = $ligne->getMntengage();
                                    if ($ligne->getMntprovisoire())
                                        $mntprovisoire = $ligne->getMntprovisoire();
                                    //                                                            $relicatprovisoire = number_format($ligne->getMntencaisse() - $mntprovisoire, 3, ',', '.');
                                    $relicatprovisoire = $ligne->getMnt() - $mntprovisoire;

                                    //           
                                    //  $relicat = $ligne->getMntencaisse() - $mntengager;
                                    $relicat = $ligne->getMnt() - $mntengager;

                                    $relicatprvisoire_defi = number_format($relicat - $total, 3, ',', ' ');
                                    // die($relicat. '-'. $relicatprovisoire.'='. $relicatprvisoire_defi);
                                    //    die($relicatprvisoire_defi);
                                    if ($ligne && $ligne->getIdTitre())
                                        $relicat = number_format($relicat, 3, ',', ' ');
                                    ?>
                                    <ul style="list-style: none;">
                                        <li>Définitif: <input type="text" class="form-control align_right" value="<?php echo $relicat ?>" id="reliq"></li>
                                        <li>Provisoire + Définitif : <input type="text" class="form-control align_right" value="<?php echo $relicatprvisoire_defi; ?>" id="reliqprovisoire"></li>
                                    </ul>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3">
                                    Objet
                                    <textarea id="txt_object" style="width: 100%;"><?php if (!$form->getObject()->isNew()) echo $piece->getDescription(); ?></textarea>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </tbody>
        </table>
    </fieldset>

</div>

<script>
    function chargerRubriqueAndSousRubrique(table, rubrique) {

        id_title = $('#budget').val();
        if (!isNaN(parseInt(id_title)))
            angular.element('[ng-controller="myCtrldoc"]').scope().InialiserComboBudgetEngagement(table, rubrique, id_title, null);
    }

    function chargerSousRubriqueEtCalculer(select_id) {

        if (!isNaN(parseInt($('#' + select_id).val()))) {
            id = parseInt($('#' + select_id).val());
            angular.element('[ng-controller="myCtrldoc"]').scope().ChargerNordre(id);
        }
    }
    $('[id^=parent_]').change(function () {

        chargerRubriqueAndSousRubrique('titrebudjet', 'liste_rubrique')

    });
    $('[id^=enf_]').change(function () {
        id_select = $(this).attr('id');
        chargerSousRubriqueEtCalculer(id_select);

    });
</script>