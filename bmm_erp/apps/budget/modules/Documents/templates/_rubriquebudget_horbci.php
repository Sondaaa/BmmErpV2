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
    <h3 class="smaller lighter blue no-margin">Détail d'engagement</h3>
</div>
<div class="modal-body">
    <?php
    $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
    $text_lists_bon_extrene = "";
    $mnt_total = 0;
    foreach ($listdoc as $key => $list) :
        $mnt_total += $list['ttc'];
        $bon_commande_externe = DocumentachatTable::getInstance()->findOneById($list['id']);
        $documentachat = new Documentachat();
        $form = new DocumentbudgetForm();
        $typedoc = TypedocTable::getInstance()->findOneById($bon_commande_externe->getIdTypedoc());
        if ($key < count($listdoc) - 1)
            $text_lists_bon_extrene .= $bon_commande_externe . ' , ';
        else
            $text_lists_bon_extrene .= $bon_commande_externe;
    endforeach;
    ?>
    <fieldset>
        <legend><?php echo $typedoc . ':   (' . $text_lists_bon_extrene . ')' ?>
            <br>
            <span style="color:brown"> Montant total: <?php echo number_format($mnt_total, 3, ',', ' ') ?></span>
            <input type="hidden" id="total" value="<?php echo $mnt_total; ?>">
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
        <table style="margin-bottom: 0px;" class="table table-bordered table-hover">

            <tr>
                <td>Exercice</td>
                <td colspan="5"> <?php
                                    $date = $_SESSION['exercice_budget'];
                                    echo $date;
                                    ?></td>

            </tr>
            <tr>
                <td>Budget</td>
                <td colspan="5">
                    <?php
                    $annees = date('Y');
                    //$annees = $_SESSION['exercice_budget'];
                    $ligne = new Ligprotitrub();
                    $budgets = Doctrine_Query::create()
                        ->select("*")
                        ->from('titrebudjet')
                      //  ->where("Etatbudget=2")
                      ->where("trim(typebudget) not like trim('Prototype') ")
                                                         ->andWhere("trim(typebudget) not like trim('%Budget Prévisionnel / Direction & Projet%') ")
                                                         ->andWhere("trim(typebudget) not like trim('%Budget Prévisionnel Global%') ")
                                                         ->orWhere("trim(typebudget) like trim('Exercice:" . date('Y') . "') ")
                                                         ->andWhere("id_tranches is not null and id_tranches <>'' ")
                                                          ->orderBy('id asc')->execute();
                        
                    $budgets = $budgets->execute();


                    ?>

                    <select id="budget" onchange="chargerRubriqueAndSousRubrique('titrebudjet', 'liste_rubrique')">
                        <option value="0">Sélectionnez</option>
                        <?php foreach ($budgets as $budget) { ?>
                            <option value="<?php echo $budget->getId() ?>">
                                <?php echo $budget->getLibelle() ?>
                            </option>
                        <?php } ?>
                    </select>
                </td>

            </tr>
            <tr>
                <td>Rubrique:</td>
                <td colspan="5">
                    <div id="div_select"></div>
                </td>
            </tr>
            <tr>
                <td>Rubrique :</td>
                <td colspan="5">
                    <input type="text" class="form-control" readonly="true" id="rubrique" value="">
                </td>

            </tr>
            <tr>
                <td>Crédits alloués :</td>
                <td>
                    <input type="text" class="align_right" readonly="true" value="" id="mnt">
                </td>
                <td>Crédits consommés:</td>
                <td>
                    <input type="text" class="align_right" readonly="true" value="" id="credit">
                </td>
                <td>Reliquat:</td>
                <td>
                    <input type="text" class="align_right" readonly="true" value="" id="reliq">
                </td>
            </tr>
            <tr>
                <td colspan="6">
                    Objet
                    <textarea id="txt_object" style="width: 100%;"><?php if (!$form->getObject()->isNew()) echo $piece->getDescription(); ?></textarea>
                </td </tbody>
        </table>
    </fieldset>

</div>

<script>
    function chargerRubriqueAndSousRubrique(table, rubrique) {

        id_title = $('#budget').val();
        if (!isNaN(parseInt(id_title)))
            angular.element('[ng-controller="myCtrldoc"]').scope().InialiserComboBudgetEngagementHrosBCi(table, rubrique, id_title, null);
    }

    function chargerSousRubriqueEtCalculer(select_id) {

        if (!isNaN(parseInt($('#' + select_id).val()))) {
            id = parseInt($('#' + select_id).val());
            angular.element('[ng-controller="myCtrldoc"]').scope().ChargerNordre(id);
        }
    }
    $('[id^=parent_]').change(function() {

        chargerRubriqueAndSousRubrique('titrebudjet', 'liste_rubrique')

    });
    $('[id^=enf_]').change(function() {
        id_select = $(this).attr('id');
        chargerSousRubriqueEtCalculer(id_select);

    });
</script>