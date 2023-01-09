<td style="text-align: center;">
    <ul class="sf_admin_td_actions" style="display: initial !important;">
        <li class="sf_admin_action_edit">
            <?php $courrier = Doctrine_Core::getTable('courrier')->findOneById($parcourcourier->getIdCourrierdest()); ?>
            <a  href="<?php echo url_for('courrier/shocimprimer?idcourrier=' . $parcourcourier->getIdCourrierdest()) ?>" class="btn btn-outline btn-success">
                <i class="fa fa-file-o"></i> Détail Courrier <br>N°: <?php echo $courrier->getNumerocourrierstring() ?>
            </a>
        </li>
    </ul>
</td>