<?php use_helper('I18N', 'Date') ?>
<?php include_partial('paie/assets') ?>

<div id="sf_admin_container">
    <h1>Liste des Fiches de Paie - Année <?php echo $_SESSION['exercice']; ?></h1>
    <div id="sf_admin_bar">
        <div class="sf_admin_filter col-xs-10">
            <form>
                <table class="table table-bordered table-hover" cellspacing="0">
                    <tfoot>
                        <tr>
                            <td colspan="2">
                                <a href="<?php echo url_for('paie/index') ?>" class="btn btn-white btn-success">Effacer</a>
                                <button onclick="goPage(1)" class="btn btn-white btn-success">Filtrer</button>
                            </td>
                        </tr>
                    </tfoot>
                    <tbody>
                        <tr class="sf_admin_form_row sf_admin_text sf_admin_filter_field_idrh">
                            <td><label for="paie_filters_id_agents">Agent</label></td>
                            <td style="width: 70%">
                                <?php
                                $agents = Doctrine_Core::getTable('agents')
                                        ->createQuery('a')
                                        ->where('a.id_motifabsence IS NULL ')
                                        ->execute();
                                ?>
                                <select name="paie_filters[id_agents]" id="paie_filters_id_agents" class="chosen-select form-control" style="display: none;">
                                    <option></option>
                                    <?php foreach ($agents as $agent) { ?>
                                        <option value="<?php echo $agent->getId() ?>"><?php echo $agent->getIdrh() . " " . $agent->getNomcomplet() . " " . $agent->getPrenom() ?></option>
                                    <?php } ?>
                                </select>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </form>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xs-12">
        <div class="table-header">
            Liste des Fiches de Paie - Année <?php echo $_SESSION['exercice']; ?> 
        </div>
        <div>
            <table id="listPaie">
                <thead>
                    <tr>
                        <th style="width: 20%;">Agent</th>
                        <th style="width: 20%;">Mois</th>
                        <th style="width: 10%;">Année</th>
                        <th style="width: 10%;">Salaire Imposable</th>
                        <th style="width: 10%; ">Salaire Net</th>
                        <th style="width: 10%; ">Net à Payer</th>
                        <th style="width: 15%; ">Action</th>
                    </tr>
                </thead>
                <tfoot>

                </tfoot>
                <tbody>
                    <?php include_partial("listeFichePaie", array("pager" => $pager, "page" => $page)) ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
    function goPage(page) {
        $.ajax({
            url: '<?php echo url_for('paie/goPage'); ?>',
            data: 'page=' + page +
                    '&id_agents=' + $('#paie_filters_id_agents').val(),
            success: function (data) {
                $('#listPaie tbody').html(data);
            }
        });
    }
</script>