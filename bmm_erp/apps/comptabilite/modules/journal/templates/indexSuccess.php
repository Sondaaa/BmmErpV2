<div id="sf_admin_container">
    <h1 id="replacediv"> Base Comptable 
        <small>
            <i class="ace-icon fa fa-angle-double-right"></i>
            Journaux Comptables
        </small>
    </h1>
</div>

<div>
    <div class="col-sm-8">
        <span class="text-primary">. <u>Bloquer un journal comptable</u> ça veut dire bloquer tout ses <u>numérotations séries</u>.</span>
        <br>
        <span class="text-primary">. <u>Valider un journal comptable</u> ça veut dire bloquer tout ses <u>numérotations séries</u>.</span>
        <br>
        <span class="text-primary">. On <u>ne peut plus ajouter</u> des pièces comptables (saisie de pièce) dans une numérotation de <u>série bloquée</u>.</span>
        <br>
        <span class="text-primary">. <u>Un journal comptable</u> qui n'a pas des comptes comptables, peut avoir tout les comptes comptables dans ses pièces comptables.</span>
        <br><br>
    </div>
    <?php if ($_SESSION['exercice'] != null): ?>
        <div class="col-sm-4">
            <a href="<?php echo url_for('journal/new') ?>" class="btn btn-app btn-primary radius-4" style="margin-bottom: 5px;">
                <i class="ace-icon fa fa-plus-square-o bigger-190"></i>
                Ajouter Journal Comptable
            </a>
            <br>
        </div>
    <?php endif; ?>
</div>

<div class="row">
    <div class="col-xs-12">
        <div class="clearfix">
            <div class="pull-right tableTools-container"></div>
        </div>
        <div class="table-header">
            Liste des journaux comptables
        </div>

        <div>
            <table id="listJournal" class="mws-datatable-fn mws-table">
                <thead>
                    <tr>
                        <th style="width: 10%; text-align: center;">Code</th>
                        <th style="width: 25%;">Libellé</th>
                        <th style="width: 10%; text-align: center;">Numérotation</th>
                        <th style="width: 10%; text-align: center;">Type Journal</th>
                        <th style="width: 10%; text-align: center;">Exercices Comptables</th>
                        <th style="width: 5%; text-align: center;">Bloqué </th>
                        <th style="width: 5%; text-align: center;">Validé </th>
                        <th style="width: 5%; text-align: center;">Comptes Comptables </th>
                        <th style="width: 5%; text-align: center;">Numérotation Série </th>
                        <th style="width: 15%; text-align: center;">Opérations</th>
                    </tr>
                    <tr>
                        <th><input type="text" id="code" onkeyup="goPage(1);" style="width: 100%; text-align: center !important;" /></th>
                        <th><input type="text" id="libelle" onkeyup="goPage(1);" style="width: 100%;" /></th>
                        <th></th>
                        <th>
                            <select id="type_journal" onchange="goPage(1);">
                                <option value="0">Tous les types</option>
                                <?php foreach ($type_journals as $tj): ?>
                                    <option value="<?php echo $tj->getId() ?>"><?php echo $tj->getLibelle() ?></option>
                                <?php endforeach; ?>
                            </select>
                        </th>
                        <th>
                            <select id="exercice" onchange="goPage(1);">
                                <option value="0">Tous les exercices</option>
                                <?php foreach ($exercices as $ex): ?>
                                    <option value="<?php echo $ex->getId() ?>"><?php echo $ex->getLibelle() ?></option>
                                <?php endforeach; ?>
                            </select>
                        </th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tfoot>

                </tfoot>
                <tbody>
                    <?php include_partial("journal/liste", array("pager" => $pager)) ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script  type="text/javascript">
    function goPage(page) {
        $.ajax({
            url: '<?php echo url_for('@listeJournalComptable'); ?>',
            data:   'page=' + page +
                    '&type_journal=' + $('#type_journal').val() +
                    '&exercice=' + $('#exercice').val() +
                    '&code=' + $('#code').val() +
                    '&libelle=' + $('#libelle').val(),
            success: function (data) {
                $('#listJournal tbody').html(data);
            }
        });
    }

    function showJournal(id) {
        $.ajax({
            url: '<?php echo url_for('@showJournal') ?>',
            data: 'id=' + id,
            success: function (data) {
                bootbox.dialog({
                    message: data,
                    buttons:
                            {
                                "button":
                                        {
                                            "label": "Fermer",
                                            "className": "btn-sm"
                                        }
                            }
                });
            }
        });
    }

    function supprimer(id) {
        bootbox.confirm({
            message: "Voulez-vous supprimer ce journal comptable ?",
            buttons: {
                cancel: {
                    label: "Non",
                    className: "btn-sm",
                },
                confirm: {
                    label: "Oui",
                    className: "btn-primary btn-sm",
                }
            },
            callback: function (result) {
                if (result) {
                    deleteJournal(id);
                }
            }
        });
    }

    function deleteJournal(id) {
        $.ajax({
            url: '<?php echo url_for('@deleteJournalComptable') ?>',
            data: 'id=' + id,
            success: function (data) {
                $('#listJournal tbody').html(data);
            }
        });
    }

    var journal_id_courant = '';
    function listePlan(journal_id) {
        journal_id_courant = journal_id;
        $.ajax({
            url: '<?php echo url_for('@listePlanJournal') ?>',
            data: 'id=' + journal_id,
            success: function (data) {

                bootbox.dialog({
                    message: data,
                    buttons:
                            {
                                "button":
                                        {
                                            "label": "Fermer",
                                            "className": "btn-sm"
                                        }
                            }
                });
            }
        });
    }

    function goPagePlanCompt() {
        listePlan(journal_id_courant);
    }

    function listeNumSerie(journal_id) {
        journal_id_courant = journal_id;

        var check_bloque = $('#bloque_journal_' + journal_id_courant).val();
        var check_valide = $('#valide_journal_' + journal_id_courant).val();
        $.ajax({
            url: '<?php echo url_for('@listeNumSerie') ?>',
            data: 'id=' + journal_id,
            success: function (data) {

                bootbox.dialog({
                    message: data,
                    buttons:
                            {
                                "button":
                                        {
                                            "label": "Fermer",
                                            "className": "btn-sm"
                                        }
                            }
                });

                validerTous(check_valide);
                bloquerTous(check_bloque);
            }
        });
    }

    function supprimerCompteJournal(compte, journal) {

        $.ajax({
            url: '<?php echo url_for('@deleteCompteJournal') ?>',
            data: 'compte=' + compte + '&journal=' + journal,
            success: function (data) {
                $('#myTable01 tbody').html(data);
            }
        });
    }

    function checkBloque(num, journal) {
        $.ajax({
            url: '<?php echo url_for('@bloquerCompteJournal'); ?>',
            data: 'num=' + num + '&journal=' + journal,
            success: function (data) {
                $('#myTable01 tbody').html(data);
            }
        });
    }

    function bloquerJournal(id) {
        $.ajax({
            url: '<?php echo url_for('@bloquerJournal'); ?>',
            data: 'id=' + id,
            success: function (data) {
                $('#listJournal tbody').html(data);
            }
        });
    }

    function validerJournal(id) {
        $.ajax({
            url: '<?php echo url_for('@validerJournal'); ?>',
            data: 'id=' + id,
            success: function (data) {
                $('#listJournal tbody').html(data);
            }
        });
    }

    function checkBloqueTous() {
        var check_bloque = $('#bloque_journal_' + journal_id_courant).val();
        $.ajax({
            url: '<?php echo url_for('@bloquerNumSerieJournalTous'); ?>',
            data: 'journal=' + journal_id_courant + '&check_bloque=' + check_bloque,
            success: function (data) {
                $('#list_num_serie tbody').html(data);
                if (check_bloque == 1) {
                    $('#bloque_journal_' + journal_id_courant).val('');
                } else {
                    $('#bloque_journal_' + journal_id_courant).val(1);
                }
                check_bloque = $('#bloque_journal_' + journal_id_courant).val();
                bloquerTous(check_bloque);
            }
        });
    }

    function checkValideTous() {
        var check_valide = $('#valide_journal_' + journal_id_courant).val();
        $.ajax({
            url: '<?php echo url_for('@validerNumSerieJournalTous'); ?>',
            data: 'journal=' + journal_id_courant + '&check_valide=' + check_valide,
            success: function (data) {
                $('#list_num_serie tbody').html(data);
                if (check_valide == 1) {
                    $('#valide_journal_' + journal_id_courant).val('');
                } else {
                    $('#valide_journal_' + journal_id_courant).val(1);
                }
                check_valide = $('#valide_journal_' + journal_id_courant).val();
                validerTous(check_valide);
            }
        });
    }

    function bloquerTous(check_bloque) {
        if (check_bloque == 1) {
            $('#block_tous').html('Débloquer Tous');
        } else {
            $('#block_tous').html('Bloquer Tous');
        }
    }

    function validerTous(check_valide) {
        if (check_valide == 1) {
            $('#valide_tous').html('Dévalider Tous');
        } else {
            $('#valide_tous').html('Valider Tous');
        }
    }

</script>

<style>

    #listJournal tr td{vertical-align: middle;}
    #code{text-align: center;}

</style>

<script  type="text/javascript">
    document.title = ("BMM - G. Compta. : Journaux Comptables");
</script>