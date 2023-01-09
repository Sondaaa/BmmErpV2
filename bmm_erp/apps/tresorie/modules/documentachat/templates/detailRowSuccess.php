<tr class="detail-row">
    <td colspan="10">
        <?php $lignes = LignedocachatTable::getInstance()->getByDocachatInOrderSaisie($documentachat->getId()); ?>

        <?php if ($lignes->count() != 0) : ?>
            <table style="width: 98%; margin-bottom: 10px; margin-left: 1%;" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th style="width: 4%; text-align: center;">N°</th>
                        <th style="width: 30%;">Code Article</th>
                        <th style="width: 13%; text-align: center;">Désignation Article</th>
                        <th style="width: 13%; text-align: center;">Qte</th>
                        <th style="width: 15%;">Projet</th>
                        <th style="width: 30%;">Observation</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 0; ?>
                    <?php foreach ($lignes as $lg) : ?>
                        <tr>
                            <td style="text-align:center;"><?php echo sprintf('%02d', $lg->getNordre());  ?></td>
                            <td style="text-align: justify;">
                                <?php echo $lg->getCodearticle(); ?>
                            </td>
                            <td style="text-align:right;">
                                <?php echo $lg->getDesignationarticle(); ?>
                            </td>
                            <?php if ($lg->getUnitedemander()) : ?>
                                <td><?php echo $lg->getQte() . " (" . trim($lg->getUnitedemander()) . ")" ?></td>
                            <?php else : ?>
                                <td><?php echo $lg->getQte(); ?></td>
                            <?php endif; ?>
                            <td><?php echo $lg->getProjet() ?></td>
                            <td><?php echo html_entity_decode($lg->getObservation()) ?></td>
                        </tr>
                        <?php $i++; ?>
                    <?php endforeach; ?>

                </tbody>
            </table>
        <?php endif; ?>
    </td>
</tr>