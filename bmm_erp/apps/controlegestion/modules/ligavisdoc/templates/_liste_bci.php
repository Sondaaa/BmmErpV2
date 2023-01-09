<div class="row">
    <div class="col-xs-12">

        <div>
            <form>
                <div class="sf_admin_list">
                    <table id="list_bci" class="table table-bordered table-hover" cellspacing="0">
                        <thead>
                            <tr>

                                <?php if ($id_typedoc == 9): ?>
                                    <th style="width: 13%">B.C.I.M.P Numéro</th>
                                <?php elseif ($id_typedoc == 17): ?>
                                    <th style="width: 13%">B.D.C / BCE Numéro</th> 
                                <?php elseif ($id_typedoc == 21): ?>
                                    <th style="width: 13%">B.D.C Regroupe Prov</th> 
                                <?php elseif ($id_typedoc == 19): ?>
                                    <th style="width: 13%">Contrat Provisoire</th> 
                                <?php elseif ($id_typedoc == 20): ?>
                                    <th style="width: 13%">Contrat Définitif</th> 
                                     <?php elseif ($id_typedoc == 22): ?>
                                    <th style="width: 13%">B.D.C Regroupe Définitif</th> 
                                <?php else: ?>
                                    <th style="width: 13%">B.C.I Numéro</th>
                                <?php endif; ?>
                                <th style="width: 8%">Date</th>
                                <th style="width: 8%">Référence</th>
                                <th style="width: 8%">Montant Estimatif</th>
                                <th style="width: 10%; background-color: #dff0d8;">Avis</th>
                                <th style="width: 8%; background-color: #dff0d8;">Date</th>
                                <th style="width: 35%; background-color: #dff0d8;">Rubrique</th>
                                <th style="width: 10%; background-color: #dff0d8;">Reliquat</th>
                                <th style="width: 10%">Opérations</th>
                            </tr>
                        </thead>
                        <tfoot></tfoot>
                        <tbody>
                            <?php if ($documents->count() == 0): ?>
                                <tr>
                                    <td style="text-align:center; font-weight: bold; font-size: 16px !important;" colspan="9">Pas de B.C.I</td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($documents as $doc): ?>
                                    <?php $avis_budget = $doc->getLigavisdoc(); ?>
                                    <tr>
                                        <td><?php echo $doc; ?></td>
                                        <td style="text-align: center;"><?php echo date('d/m/Y', strtotime($doc->getDatecreation())); ?></td>
                                        <td><?php echo $doc->getReference(); ?></td>
                                        <td style="text-align: center;"><?php echo $doc->getMontantestimatif(); ?></td>
                                        <td style="background-color: #dff0d8;">
                                            <?php foreach ($avis_budget as $avis): ?>
                                                <?php echo $avis->getAvis(); ?><br>
                                            <?php endforeach; ?>
                                        </td>
                                        <td style="text-align: center; background-color: #dff0d8;">
                                            <?php foreach ($avis_budget as $avis): ?>
                                                <?php if ($avis->getDatecreation() != ''): ?>
                                                    <?php echo date('d/m/Y', strtotime($avis->getDatecreation())); ?><br>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        </td>
                                        <td style="background-color: #dff0d8;">
                                            <?php foreach ($avis_budget as $avis): ?>
                                                <?php if ($avis->getIdLigprotitrub() != ''): ?>
                                                    <?php echo $avis->getLigprotitrub(); ?><br>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        </td>
                                        <td style="text-align: center; background-color: #dff0d8;">
                                            <?php foreach ($avis_budget as $avis): ?>
                                                <?php echo $avis->getMntdisponible(); ?><br>
                                            <?php endforeach; ?>
                                        </td>
                                        <td style="text-align: center;">
                                            <a target="_blanc" href="<?php echo url_for('documentachat/rempliretexporter') . '?iddoc=' . $doc->getId() ?>" class="btn btn-sm btn-success" style="padding: 3px 10px;">
                                                <i class="ace-icon fa fa-eye bigger-110"></i>
                                                <span class="bigger-110 no-text-shadow">Détails</span>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </form>
        </div>
    </div>
</div>