<?php
$listes = LigprotitrubTable::getInstance()->getParentByTitreBudget($titre);
$budget = TitrebudjetTable::getInstance()->find($titre);
if ($type_montant == 0)
    $text = "Engagement : ";
else
    $text = "Paiement : ";
?>
<div class="col-xs-12">
    <div class="widget-box <?php if ($type_montant == 0): ?>widget-color-blue<?php else: ?>widget-color-red<?php endif; ?>" id="widget-box-2">
        <div class="widget-header">
            <h5 class="widget-title bigger lighter">
                <i class="ace-icon fa fa-table"></i> 
                <?php echo $text; ?> Traiter la situation Cumulée entre <?php echo $annee_debut; ?> et <?php echo $annee_fin; ?>
            </h5>
        </div>

        <div class="widget-body">
            <div class="widget-main no-padding">
                <div id="table-scroll" class="table-scroll" style="margin-bottom: 10px;">
                    <div class="table-wrap">
                        <table class="mws-datatable-fn mws-table table table-bordered table-hover main-table">
                            <thead>
                                <tr>
                                    <th class="fixed-side" scope="col">Rubriques</th>
                                    <?php for ($i = $annee_debut; $i <= $annee_fin; $i++): ?>
                                        <th style="width: 135px;text-align: center;"><?php echo $i; ?></th>
                                    <?php endfor; ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($listes as $liste): ?>
                                    <tr>
                                        <td class="fixed-side" scope="col">
                                            <b style="<?php if ($type_montant == 0): ?>color: #0066CC;<?php else: ?>color: #AA3319;<?php endif; ?>"><?php echo $liste->getNordre(); ?> : </b> <?php echo $liste->getRubrique(); ?>
                                        </td>
                                        <?php for ($i = $annee_debut; $i <= $annee_fin; $i++): ?>
                                            <?php
                                            $situationcumulee = SituationcumuleeTable::getInstance()->findOneByIdLigprotitreAndAnneesAndMois($liste->getId(), $i, 12);
                                            $montant = '';
                                            if ($situationcumulee) {
                                                if ($type_montant == 0)
                                                    $montant = $situationcumulee->getMntEngagement();
                                                else
                                                    $montant = $situationcumulee->getMntPaiement();
                                            }
                                            ?>
                                        <td><input onchange="saveMontant('<?php echo $liste->getId(); ?>', '<?php echo $i; ?>', '<?php echo $type_montant; ?>')" type="text" class="align-center" style="max-width: 130px;" id="<?php echo $liste->getId() . '_' . $i; ?>" value="<?php echo $montant; ?>" placeholder="<?php echo $liste->getNordre() . ': => ' . $i; ?>" /></td>
                                        <?php endfor; ?>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>

    .table-scroll {
        position:relative;
        max-width:100%;
        margin:auto;
        overflow:hidden;
        width: 100%;
        border:1px solid #fff;
    }
    .table-wrap {
        width:100%;
        overflow:auto;
    }
    .table-scroll table {
        width:100%;
        margin:auto;
        border-collapse:separate;
        border-spacing:0;
    }
    .table-scroll th, .table-scroll td {
        padding:5px 10px;
        border:1px solid #000;
        white-space:nowrap;
        vertical-align:top;
    }
    .clone {
        position:absolute;
        top:0;
        left:0;
        pointer-events:none;
    }
    .clone th, .clone td {
        visibility:hidden
    }
    .clone td, .clone th {
        border-color:transparent
    }
    .clone tbody th {
        visibility:visible;
    }
    .clone .fixed-side {
        visibility:visible;
        /*background-color: #fff;*/
        background: repeat-x #F2F2F2;
    }
    .clone thead, .clone tfoot{background:transparent;}

</style>

<script  type="text/javascript">

    // requires jquery library
    jQuery(".main-table").clone(true).appendTo('#table-scroll').addClass('clone');

</script>