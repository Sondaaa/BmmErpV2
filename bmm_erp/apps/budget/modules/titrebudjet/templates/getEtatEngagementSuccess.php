<?php
$array_romain = array("1" => "I", "2" => "II", "3" => "III", "4" => "IV", "5" => "V",
    "6" => "VI", "7" => "VII", "8" => "VIII", "9" => "IX", "10" => "X",
    "11" => "XI", "12" => "XII", "13" => "XIII", "14" => "XIV", "15" => "XV",
    "16" => "XVI", "17" => "XVII", "18" => "XVIII", "19" => "XIX", "20" => "XX",
    "21" => "XXI", "22" => "XXII", "23" => "XXIII", "24" => "XXIV", "25" => "XXV",
    "26" => "XXVI", "27" => "XXVII", "28" => "XXVIII", "29" => "XXIX", "30" => "XXX"
);
?>
<div class="panel-body">
    <div class="col-md-12">
        <div class="row" style="padding: 8px; background-color: #f7f7f9; border: 1px solid #e1e1e8;">
            <h3>Total des engagements à payer : <?php echo $titre; ?></h3>
            <hr style="border-top: 1px solid #aaa;">

            <?php if ($engagements->count() != 0): ?>
                <?php
                $total = 0;
                $total_romain = 0;
                $total_rubrique = 0;
                $total_sous_rubrique = 0;
                $ran_romain = 1;
                $annee = 0;
                $id_lig = '';
                $id_rubrique_parent = '';
                ?>
                <ul style="list-style:none;">
                    <?php foreach ($engagements as $engagement): ?>
                        <li style="padding-bottom: 15px;">
                            <?php if ($annee != $engagement->getAnnee()): ?>
                                <script  type="text/javascript">
                                    $("#total_<?php echo $annee; ?>").html('<?php echo number_format($total_romain, 3, '.', ' '); ?>');
                                </script>
                                <?php
                                $annee = $engagement->getAnnee();
                                $id_lig = '';
                                $total_romain = 0;
                                ?>
                                <label style="width: 70%; font-weight: bold; font-size: 18px;"><?php echo $array_romain[$ran_romain]; ?>) ENGAGEMENTS DE <?php echo $engagement->getAnnee(); ?> : </label><label id="total_<?php echo $engagement->getAnnee(); ?>" style="width: 13%; font-size: 18px; font-weight: bold; color: #40B33A; text-align: right;"></label>
                                <?php $ran_romain++; ?>
                            <?php endif; ?>

                            <?php if ($engagement->getLigprotitrub()->getRubrique()->getIdRubrique() != null): ?>
                                <?php $ligprotitrub = LigprotitrubTable::getInstance()->findOneByIdTitreAndIdRubrique($engagement->getIdTitre(), $engagement->getLigprotitrub()->getRubrique()->getIdRubrique()); ?>
                                <?php if ($id_rubrique_parent != $engagement->getLigprotitrub()->getRubrique()->getIdRubrique()): ?>
                                    <script  type="text/javascript">
                                        $("#rubrique_parent_<?php echo $id_rubrique_parent; ?>_<?php echo $annee; ?>").html('<?php echo number_format($total_sous_rubrique, 3, '.', ' '); ?>');
                                    </script>
                                    <?php $id_rubrique_parent = $engagement->getLigprotitrub()->getRubrique()->getIdRubrique(); ?>
                                    <label style="width: 60%; font-weight: bold; padding-left: 15px;"><?php echo trim($ligprotitrub->getNordre()) . ') ' . $ligprotitrub->getRubrique(); ?></label><label id="rubrique_parent_<?php echo $id_rubrique_parent ?>_<?php echo $annee; ?>" style="width: 10%; font-weight: bold; text-align: right;"></label>
                                    <?php $total_sous_rubrique = 0; ?>
                                <?php endif; ?>

                                <?php if ($id_lig != $engagement->getLigprotitrub()->getId() && $id_lig != ''): ?>
                                    <script  type="text/javascript">
                                        $("#rubrique_<?php echo $id_lig; ?>_<?php echo $annee; ?>").html('<?php echo number_format($total_rubrique, 3, '.', ' '); ?>');
                                    </script>
                                    <?php $id_lig = $engagement->getLigprotitrub()->getId(); ?>
                                    <label style="width: 60%; font-weight: bold; padding-left: 30px;"><?php echo trim($engagement->getLigprotitrub()->getNordre()) . ') ' . $engagement->getLigprotitrub()->getRubrique(); ?></label><label id="rubrique_<?php echo $engagement->getLigprotitrub()->getId(); ?>_<?php echo $annee; ?>" style="width: 10%; font-weight: normal; text-align: right;"></label>
                                    <?php $total_rubrique = 0; ?>
                                <?php endif; ?>

                                <label style="width: 50%; font-weight: normal; padding-left: 30px;"><?php echo trim($engagement->getDescription()) ?></label><label style="width: 10%; font-weight: normal; text-align: right;"><?php echo number_format($engagement->getMontant(), 3, '.', ' ') ?></label><label style="width: 10%; font-weight: normal;"></label>
                                <?php
                                $total = $total + $engagement->getMontant();
                                $total_romain = $total_romain + $engagement->getMontant();
                                $total_rubrique = $total_rubrique + $engagement->getMontant();
                                $total_sous_rubrique = $total_sous_rubrique + $engagement->getMontant();
                                ?>
                            <?php else: ?>
                                <?php if ($id_lig != $engagement->getLigprotitrub()->getId()): ?>
                                    <script  type="text/javascript">
                                        $("#rubrique_<?php echo $id_lig; ?>_<?php echo $annee; ?>").html('<?php echo number_format($total_rubrique, 3, '.', ' '); ?>');
                                    </script>
                                    <?php $id_lig = $engagement->getLigprotitrub()->getId(); ?>
                                    <label style="width: 60%; font-weight: bold; padding-left: 15px;"><?php echo trim($engagement->getLigprotitrub()->getNordre()) . ') ' . $engagement->getLigprotitrub()->getRubrique(); ?></label><label id="rubrique_<?php echo $engagement->getLigprotitrub()->getId(); ?>_<?php echo $annee; ?>" style="width: 10%; font-weight: bold; text-align: right;"></label>
                                    <?php $total_rubrique = 0; ?>
                                <?php endif; ?>

                                <label style="width: 50%; font-weight: normal; padding-left: 15px;"><?php echo trim($engagement->getDescription()) ?></label><label style="width: 10%; font-weight: normal; text-align: right;"><?php echo number_format($engagement->getMontant(), 3, '.', ' ') ?></label>
                                <?php
                                $total = $total + $engagement->getMontant();
                                $total_romain = $total_romain + $engagement->getMontant();
                                $total_rubrique = $total_rubrique + $engagement->getMontant();
                                ?>
                            <?php endif; ?>
                        </li>
                        <script  type="text/javascript">
                            $("#total_<?php echo $annee; ?>").html('<?php echo number_format($total_romain, 3, '.', ' '); ?>');
                            $("#rubrique_<?php echo $id_lig; ?>_<?php echo $annee; ?>").html('<?php echo number_format($total_rubrique, 3, '.', ' '); ?>');
                            $("#rubrique_parent_<?php echo $id_rubrique_parent; ?>_<?php echo $annee; ?>").html('<?php echo number_format($total_sous_rubrique, 3, '.', ' '); ?>');
                        </script>
                    <?php endforeach; ?>
                </ul>
                <label style="width: 70%; font-weight: bold; font-size: 18px; padding-left: 25px; color: #CE6341;">Total des Engagements</label><label id="total_engagements" style="width: 13%; font-size: 18px; font-weight: bold; color: #CE6341; text-align: right;"><?php echo number_format($total, 3, '.', ' ') ?></label>
                <hr style="border-top: 1px solid #aaa; margin-bottom: 10px;">
                <a href="<?php echo url_for("titrebudjet/imprimerEtatAntecedent?id=" . $titre->getId()); ?>" class="btn btn-white btn-primary" target="_blank" style="float: right;">
                    <i class="ace-icon fa fa-print bigger-110"></i>
                    <span class="bigger-110 no-text-shadow">Imprimer</span>
                </a>
            <?php else: ?>
                <label style="width: 100%; height: 50px; font-weight: bold; font-size: 18px; text-align: center;">Pas d'engagement(s) antécédents à payer pour ce titre de budget !</label>
            <?php endif; ?>
        </div>
    </div>
</div>