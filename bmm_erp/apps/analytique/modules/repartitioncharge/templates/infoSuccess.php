<legend>Répartition des Charges - <?php echo $repartitioncharge->getAnnee(); ?></legend>
<div class="col-md-12">
    <table id="liste_unite" class="table table-bordered table-hover" style="margin-bottom: 0px;">
        <thead>
            <tr>
                <th style="width: 26%;">Unité</th>
                <th style="width: 20%;">Main d'œuvre</th>
                <th style="width: 39%;">Intrant</th>
                <th style="width: 10%;">Mécanisation</th>
            </tr>
        </thead>
        <tbody>
            <?php $unites = UniterepartitionchargeTable::getInstance()->getByRepartition($repartitioncharge->getId()); ?>
            <?php foreach ($unites as $unite): ?>
                <tr id="tr_<?php echo $unite->getId(); ?>">
                    <td>
                        <?php echo $unite->getLibelle(); ?>
                    </td>
                    <td>
                        <ul class="ul_point">
                            <?php foreach ($unite->getParametreuniterepartition() as $param): ?>
                                <?php if ($param->getIdChantierrepartition() != null): ?>
                                    <li style="min-height:22px; text-align: justify;"><?php echo $param->getChantierrepartitionsalaireouvrier()->getLibelle(); ?></li>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </ul>
                    </td>
                    <td>
                        <ul class="ul_point">
                            <?php foreach ($unite->getParametreuniterepartition() as $param): ?>
                                <?php if ($param->getIdRapporttravaux() != null): ?>
                                    <li style="min-height:22px; text-align: justify;"><?php echo $param->getRapporttravaux()->getLibelle() . ' ' . $param->getRapporttravaux()->getTyperapport()->getLibelle(); ?></li>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </ul>
                    </td>
                    <td>
                        <ul class="ul_point">
                            <?php foreach ($unite->getParametreuniterepartition() as $param): ?>
                                <?php if ($param->getTypemecanisation() != null): ?>
                                    <li style="min-height:22px; text-align: justify;"><?php echo $param->getTypemecanisation(); ?></li>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </ul>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<div class="row"></div>
<style>
    .modal-dialog{width: 85%;}
</style>