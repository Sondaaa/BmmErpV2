<div id="sf_admin_container" ng-controller="myCtrldocvisa">
    <h1>Liste des Avis Budgétaires / Rubriques Budgétaire</h1>
    <div id="sf_admin_bar">
        <div class="sf_admin_filter" style=" width: 65%;">

            <table class="table table-bordered table-hover" cellspacing="0" style="margin-bottom: 0px;">
                <tfoot>
                    <tr>
                        <td colspan="2">
                            <a href="<?php echo url_for('ligavisdoc/bciRubrique') ?>" class="btn btn-white btn-success">Effacer</a>
                            <button onclick="goPage(1)" class="btn btn-white btn-success">Filtrer</button>
                        </td>
                    </tr>
                </tfoot>
                <tbody>
                    <tr>
                        <td><label>Exercice</label></td>
                        <td>
                            <select id="id_exercice">
                                <option value="0"></option>
                                <?php for ($i = 2018; $i <= date('Y'); $i++): ?>
                                    <option value="<?php echo $i ?>"><?php echo $i ?></option>
                                <?php endfor; ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td><label>Budget</label></td>
                        <td>
                            <select id="id_budget">
                                <option value="0"></option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td><label for="ligavisdoc_filters_id_doc">Rubrique Budgétaie</label></td>
                        <td>
                            <select id="id_rubrique">
                                <option value="0"></option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td><label>Date de création</label></td>
                        <td>
                            De <input type="date" value="" id="datecreation_from"> à <input type="date" value="" id="datecreation_to"></label>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div id="sf_admin_content" style="display: none;">
        <div class="row">
            <div class="col-xs-12">
                <div class="clearfix">
                    <div class="pull-right tableTools-container"></div>
                </div>
                <div class="table-header">Résultat de recherche</div>
                <div>
                    <form>
                        <div class="sf_admin_list">
                            <table id="list_bci" class="table table-bordered table-hover" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th style="width: 9%">B.C.I<br>Date</th>
                                        <th style="width: 8%">Référence</th>
                                        <th style="width: 8%">Montant Estimatif</th>
                                        <th style="width: 12%; background-color: #dff0d8;">Avis (Date)</th>
                                        
                                        <th style="width: 30%; background-color: #dff0d8;">Rubrique</th>
                                        <th style="width: 10%; background-color: #dff0d8;">Reliquat</th>
                                        
                                        <th style="width: 15%;">Etat</th>
                                        <th style="width: 8%">Opérations</th>
                                    </tr>
                                </thead>
                                <tfoot></tfoot>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script  type="text/javascript">

    function goPage(page) {
        $.ajax({
            url: '<?php echo url_for('ligavisdoc/goPageRubrique') ?>',
            data: 'page=' + page +
                    '&date_debut=' + $("#datecreation_from").val() +
                    '&date_fin=' + $("#datecreation_to").val() +
                    '&id_rubrique=' + $("#id_rubrique").val(),
            success: function (data) {
                $('#list_bci tbody').html(data);
                $('#sf_admin_content').fadeIn();
            }
        });
    }

</script>

<script  type="text/javascript">
    document.title = ("BMM - U. Contrôle Budgétaire : Liste des Avis / Rubrique Budgétaire");
</script>