<fieldset id="sf_fieldset_<?php echo preg_replace('/[^a-z0-9_]/', '_', strtolower($fieldset)) ?>">
    <?php if ('NONE' != $fieldset): ?>
        <h2><?php echo __($fieldset, array(), 'messages') ?></h2>
    <?php endif; ?>

    <div class="col-lg-10">
        <table style="margin-bottom: 0px;">
            <tr>
                <td>
                    <?php
                    // echo $form['id_caissebanque']->render();
                    //   echo $form['id_budget']->render();
                    echo $form['id_caissebanque']->renderError();
                    $banques = Doctrine_Core::getTable('caissesbanques')->findByIdTypecb(2);
                    ?>Compte Bancaire
                    <select name="id_caissebanque" id="id_caissebanque">
                        <option value="0"></option>
                        <?php foreach ($banques as $bn) { ?>
                            <option value="<?php echo $bn->getId() ?>"><?php echo $bn ?></option>
                        <?php } ?> 
                    </select>
                </td>
            </tr>
            <tr>
                <td>
                    <fieldset ng-controller="CtrlFormEngagement">
                        <legend>Informations sur le Budget</legend>
                        <table style="margin-bottom: 0px;">
                            <tbody>
                                <tr>
                                    <td>
                                        <table style="margin-bottom: 0px;">
                                            <tr>
                                                <th>Exercice</th>
                                                <th>Budget</th>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <?php
                                                    $date = date('Y');
                                                    echo $date;
//                                                    echo $_SESSION['exercice_budget'];
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    $ligne = new Ligprotitrub();
                                                    $budgets = Doctrine_Query::create()
                                                                    ->select("*")
                                                                    ->from('titrebudjet')
                                                                    ->where("Etatbudget=2")
                                                                    ->andWhere("trim(typebudget) not like trim('Prototype') ")
                                                                    ->andWhere("trim(typebudget) not like trim('%Budget Prévisionnel / Direction & Projet%') ")
                                                                    ->andWhere("trim(typebudget) not like trim('%Budget Prévisionnel Global%') ")
                                                                    ->orWhere("trim(typebudget) like trim('Exercice:" . date('Y') . "') ")
                                                                    ->orderBy('id asc')->execute();
                                                    ?>
                                                    <select id="budget_param_compte">
                                                        <option value="0">Sélectionnez</option>
                                                        <?php foreach ($budgets as $budget) { ?>
                                                            <option value="<?php echo $budget->getId() ?>" <?php if ($ligne && $ligne->getIdTitre() == $budget->getId()) echo 'selected="selected"' ?> >
                                                                <?php echo $budget->getLibelle() ?>
                                                            </option>
                                                        <?php } ?>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2">
                                                    <span style="font-size: 14px;">Rubriques Budgétaires</span>
<!--                                                    <select id="numeroengaement" name="id_budget">

                                                    </select>-->
                                                    <table style="margin-bottom: 0px;">
                                                        <thead>
                                                            <tr>
                                                                <th style="width:10%; text-align: center;">N° Ordre</th>
                                                                <th style="width:10%; text-align: center;">Code</th>
                                                                <th style="width:70%;">Rubrique</th>
                                                                <th style="width:10%; text-align: center;">
                                                                    <input type="checkbox" id="check_all" checked="true" onclick="checkAll()"> Choix
                                                                </th>
                                                            </tr>
                                                        </thead>
                                                        <tbody ng-repeat="lparam in paramRubriqueBudget" id="table_rubrique">
                                                            <tr>
                                                                <td style="text-align: center;">{{lparam.nordre}}</td>
                                                                <td style="text-align: center;">{{lparam.code}}</td>
                                                                <td>{{lparam.libelle}}</td>
                                                                <td style="text-align: center;">
                                                                    <input type="checkbox" id="{{lparam.id}}" checked="true">
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
<!--                                <tr class="disabledbutton">
                                    <td>
                                        <label>Rubrique</label>
                                        <input type="text" class="form-control" id="rubrique" value="<?php // if ($ligne && $ligne->getIdTitre()) echo $ligne->getRubrique()                ?>">
                                    </td>
                                </tr>-->
                            </tbody>
                        </table>
                    </fieldset>   
                </td>
            </tr>
        </table>
    </div>
</fieldset>

<script>

    function checkAll() {
        if ($("#check_all").is(':checked')) {
            $('#table_rubrique input[type="checkbox"]').each(function () {
                $(this).prop("checked", true);
            });
        } else {
            $('#table_rubrique input[type="checkbox"]').each(function () {
                $(this).prop("checked", false);
            });
        }
    }
    function saveParam() {
        if ($("#id_caissebanque").val() != '0' && $("#budget").val() != '0') {
            var ids = '';
            $('#table_rubrique input[type="checkbox"]').each(function () {
                if ($(this).is(':checked'))
                    ids = ids + $(this).attr('id') + ',';
            });
            if (ids != '') {
                $.ajax({
                    url: '<?php echo url_for('lignebanquecaisse/saveParam') ?>',
                    data: 'id_compte=' + $("#id_caissebanque").val() +
                            '&ids=' + ids,
                    success: function (data) {
                        bootbox.dialog({
                            message: 'Paramétrage enregistré avec succès !',
                            buttons:
                                    {
                                        "button":
                                                {
                                                    "label": "Ok",
                                                    "className": "btn-sm"
                                                }
                                    }
                        });
                        location.reload();
                    }
                });
            } else {
                bootbox.dialog({
                    message: 'Veuillez coisir au moin une rubrique et/ou un sous rubrique budgétaire !',
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
        } else {
            bootbox.dialog({
                message: 'Veuillez coisir le compte bancaire et/ou le budget !',
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
    }

</script>