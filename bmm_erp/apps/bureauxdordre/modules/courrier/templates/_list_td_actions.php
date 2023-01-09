<td>
    <div class="btn-toolbar">
        <div class="btn-group" id="btnaction">
            <button data-toggle="dropdown" class="btn btn-primary btn-white dropdown-toggle">
                Action
                <i class="ace-icon fa fa-angle-down icon-on-right"></i>
            </button>
            <ul class="dropdown-menu dropdown-menu-right" role="menu">
                <li>
                    <?php if ($courrier->getIdUser() != $user->getId()): ?>
                    <a class="btn btn-sm btn-white btn-success" href="<?php echo url_for('courrier/edit?id=' . $courrier->getId()) ?>">
                            <i class="fa fa-keyboard-o"></i> Rédiger (Reçevoir)
                        </a>
                    <?php else: ?>
                        <?php if ($courrier->getCourrier()->count() == 0): ?>
                            <a class="btn btn-sm btn-white btn-primary" href="<?php echo url_for('courrier/edit?id=' . $courrier->getId()) ?>">
                                <i class="fa fa-keyboard-o"></i> Modifier
                            </a>
                        <?php endif; ?>
                    <?php endif; ?>
                </li>
                <li>
                    <a class="btn btn-sm btn-white btn-primary" href="<?php echo url_for('courrier/shocimprimer?idcourrier=' . $courrier->getId()) ?>">
                        <i class="fa fa-print"></i><?php if ($courrier->getIdUser() != $user->getId()): ?> Reçevoir<?php else: ?> Voir<?php endif; ?> et Imprimer
                    </a>
                </li>
                <li>
                    <a class="btn btn-sm btn-white btn-default" href="<?php echo url_for('courrier/showcourrier?idcourrier=' . $courrier->getId() . '&idtab=3') ?>">
                        <i class="glyphicon glyphicon-print"></i> Scan Document
                    </a>
                </li>

                <li>
                    <a  class="btn btn-sm btn-white btn-danger" href="<?php echo url_for('courrier/showcourrier?idcourrier=' . $courrier->getId() . '&idtab=1') ?>">
                        <i class="fa fa-long-arrow-right"></i> Transférer
                    </a>
                </li>
                <?php
                $user = $sf_user->getAttribute('userB2m');
                if ($user->getAcceesDroit("responsable bureaux d'ordre") && $courrier->getIdType() == '1') {
                    $cour_a_transformer = Doctrine_Core::getTable('courrier')->findOneByIdCourrier($courrier->getId());
                    if (!$cour_a_transformer) {
                        ?>
                        <li>
                            <a href="<?php echo url_for('courrier/transformer?idcourrier=' . $courrier->getId() . '&idtype1=' . $courrier->getIdType() . '&idtype2=4') ?>">
                                <i class="fa fa-long-arrow-right"></i> Transformer Ar.Int -> Départ Ext.
                            </a>
                        </li>
                        <?php
                    }
                }
                ?>  
            </ul>
        </div>
    </div>
</td>