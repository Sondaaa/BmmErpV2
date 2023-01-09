<div id="sf_admin_container">
    <h1 id="replacediv"> Rapports Travaux des Chantiers 
        <small><i class="ace-icon fa fa-angle-double-right"></i> Affichage</small>
    </h1>
</div>

<legend>Rapport Travaux</legend>

<div class="row">
    <div class="col-sm-9">
        <legend>Chantier</legend>
        <div class="profile-user-info profile-user-info-striped">
            <div class="profile-info-row">
                <div class="profile-info-name"> Nature </div>

                <div class="profile-info-value">
                    <span class="editable editable-click"><?php echo $rapportcontrole->getNaturetravaux()->getLibelle(); ?></span>
                </div>
            </div>

            <div class="profile-info-row">
                <div class="profile-info-name"> Service </div>

                <div class="profile-info-value">
                    <span class="editable editable-click"><?php echo $rapportcontrole->getServicecontrole()->getLibelle(); ?></span>
                </div>
            </div>

            <div class="profile-info-row">
                <div class="profile-info-name"> Chantier </div>

                <div class="profile-info-value">
                    <span class="editable editable-click"><?php echo $rapportcontrole->getChantiercontrole()->getLibelle(); ?></span>
                </div>
            </div>

            <div class="profile-info-row">
                <div class="profile-info-name"> Référence </div>

                <div class="profile-info-value">
                    <span class="editable editable-click"><?php echo $rapportcontrole->getChantiercontrole()->getReference(); ?></span>
                </div>
            </div>

            <div class="profile-info-row">
                <div class="profile-info-name"> Lieu Chantier</div>
                <div class="profile-info-value">
                    <i class="fa fa-map-marker light-orange bigger-110"></i>
                    <span class="editable editable-click"><?php echo $rapportcontrole->getChantiercontrole()->getLieuchantier(); ?></span>
                </div>
            </div>

            <div class="profile-info-row">
                <div class="profile-info-name"> Observation </div>

                <div class="profile-info-value">
                    <span class="editable editable-click"><?php echo $rapportcontrole->getObservation(); ?></span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-3">
        <legend>Rapport</legend>
        <div class="profile-user-info profile-user-info-striped">
            <div class="profile-info-row">
                <div class="profile-info-name"> Date Création </div>

                <div class="profile-info-value">
                    <span class="editable editable-click"><?php echo date('d/m/Y', strtotime($rapportcontrole->getDatecreation())); ?></span>
                </div>
            </div>
            <?php if ($rapportcontrole->getIdNaturetravaux() == 1 || $rapportcontrole->getIdServicecontrole() == 2 || $rapportcontrole->getIdServicecontrole() == 4): ?>
                <div class="profile-info-row">
                    <div class="profile-info-name"> Total </div>

                    <div class="profile-info-value">
                        <span class="editable editable-click"><?php echo number_format($rapportcontrole->getTotal(), 3, '.', ' '); ?> DT</span>
                    </div>
                </div>
            <?php elseif ($rapportcontrole->getIdNaturetravaux() == 2): ?>

            <?php endif; ?>
        </div>
    </div>
</div>
<hr>

<legend>Tableau des Articles</legend>

<div class="row">
    <div class="col-sm-12">
        <table id="liste_articles">
            <thead>
                <tr>
                    <th style="width:5%;text-align:center;">#</th>
                    <?php if ($rapportcontrole->getIdNaturetravaux() == 1 || $rapportcontrole->getIdServicecontrole() == 2 || $rapportcontrole->getIdServicecontrole() == 4): ?>
                        <th style="width:38%;height:25px;text-align:center;"><b>Désignation</b></th>
                        <th style="width:18%;text-align:center;"><b>Unité</b></th>
                    <?php elseif ($rapportcontrole->getIdNaturetravaux() == 2): ?>
                        <th style="width:51%;height:25px;text-align:center;"><b>Désignation</b></th>
                    <?php endif; ?>
                    <th style="width:13%;text-align:center;"><b>Quantité</b></th>
                    <?php if ($rapportcontrole->getIdNaturetravaux() == 1 || $rapportcontrole->getIdServicecontrole() == 2 || $rapportcontrole->getIdServicecontrole() == 4): ?>
                        <th style="width:13%;text-align:center;"><b>P.U (DT)</b></th>
                        <th style="width:13%;text-align:center;"><b>P.R (DT)</b></th>
                    <?php elseif ($rapportcontrole->getIdNaturetravaux() == 2): ?>
                        <th style="width:26%;text-align:center;"><b>Observation</b></th>
                    <?php endif; ?>
                </tr>
            </thead>
            <tbody>
                <?php $total = 0; ?>
                <?php foreach ($rapportcontrole->getLignerapportcontrole() as $ligne): ?>
                    <tr id="tr_<?php echo $ligne->getId(); ?>">
                        <td name="numero" style="text-align: center;"><?php echo $ligne->getNumero(); ?></td>
                        <td name="designation"><?php echo $ligne->getDesignation(); ?></td>
                        <?php if ($rapportcontrole->getIdNaturetravaux() == 1 || $rapportcontrole->getIdServicecontrole() == 2 || $rapportcontrole->getIdServicecontrole() == 4): ?>
                            <td name="unite" style="text-align:center;"><?php echo $ligne->getUnite(); ?></td>
                        <?php elseif ($rapportcontrole->getIdNaturetravaux() == 2): ?>
                        <?php endif; ?>
                        <td name="quantite" style="text-align:center;"><?php echo $ligne->getQuantite(); ?></td>
                        <?php if ($rapportcontrole->getIdNaturetravaux() == 1 || $rapportcontrole->getIdServicecontrole() == 2 || $rapportcontrole->getIdServicecontrole() == 4): ?>
                            <td name="prix_unitaire" style="text-align:right;">
                                <?php
                                if ($ligne->getPrixunitaire() != null):
                                    echo $ligne->getPrixunitaire();
                                else:
                                    echo '---';
                                endif;
                                ?>
                            </td>
                            <td name="prix_total" style="text-align:right;">
                                <?php
                                if ($ligne->getPrixtotal() != null):
                                    echo $ligne->getPrixtotal();
                                else:
                                    echo '---';
                                endif;
                                ?>
                            </td>
                        <?php elseif ($rapportcontrole->getIdNaturetravaux() == 2): ?>
                            <td name="observation"><?php echo $ligne->getObservation(); ?></td>
                        <?php endif; ?>
                    </tr>
                    <?php $total = $total + $ligne->getPrixtotal(); ?>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php if ($rapportcontrole->getIdNaturetravaux() == 1 || $rapportcontrole->getIdServicecontrole() == 2 || $rapportcontrole->getIdServicecontrole() == 4): ?>
            <table>
                <tr style="background-color: #F0F0F0;">
                    <td style="width:74%;"></td>
                    <td style="width:13%;text-align:right;">Total </td>
                    <td style="width:13%;text-align:right;" id="total"><?php echo number_format($total, 3, '.', ' '); ?></td>
                </tr>
            </table>
        <?php elseif ($rapportcontrole->getIdNaturetravaux() == 2): ?>
        <?php endif; ?>
    </div>
    <div class="col-sm-12" style="text-align: right; margin-top: 20px;">
        <a class="btn btn-white btn-primary" href="<?php echo url_for('rapportcontrole/imprimer?id=' . $rapportcontrole->getId()); ?>" target="_blank">
            <i class="ace-icon fa fa-print"></i> Imprimer
        </a>
        <a class="btn btn-white btn-success" href="<?php echo url_for('@rapportcontrole'); ?>">
            <i class="ace-icon fa fa-undo"></i> Retour à la Liste
        </a>
    </div>
</div>