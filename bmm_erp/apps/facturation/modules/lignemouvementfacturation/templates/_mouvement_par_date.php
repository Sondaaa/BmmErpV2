<?php
$url = '';
//$resultat_debit = '';
//$resultat_credit = '';
//$listelignemouvement $date_mouvement
//$url.= 'id=' . $journal->getId();
?>
<div class="row">
    <div class="col-xs-12">
        <div class="clearfix">
            <div class="pull-right tableTools-container"></div>
        </div>
        <div class="table-header">
            Liste des Mouvements  :
 <?php
//            echo $date_mouvement;
            ?>
            <a target="_blanc" href="<?php echo url_for('lignemouvementfacturation/ImprimerMouvement') ?>" 
               class="btn btn-sm btn-success" style="float: right; padding: 5px 9px;">
                <i class="ace-icon fa fa-print bigger-110"></i>
                <span class="bigger-110 no-text-shadow">Imprimer</span>
            </a>
        </div>

        <div>
            <table class="table table-bordered table-hover" id="listPiece">
                <thead>
                    <tr>

                        <th style="width: 100px">Date</th>
                        <th style="width: 150px">Facture N°</th>
                        <th style="width: 150px">Montant</th>
                        <th style="width: 200px; background-color: #dff0d8;">B.C.E / B.D.C </th>
                        <th style="width: 100px; background-color: #dff0d8;">Date</th>
                        <th style="width: 150px; background-color: #fcf8e3;">R.R.S + P.V.R</th>
                        <th style="width: 100px; background-color: #fcf8e3;">Date</th>
                        <th style="width: 200px">Fournisseur</th>
                        <th style="width: 50px; text-align: center;">Opération</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $color1 = "#e6ecff";
                    $color2 = "#b3c6ff;";
                    $numero_piece = '';
                    $Str_Row_Color = '';
                    ?>
                    <?php if ($listelignemouvement->count() != 0): ?>
                        <?php
                        foreach ($listelignemouvement as $fiche):
                            ?>
                            <?php
                            if ($numero_piece != $fiche->getNumerofacture() && $numero_piece != ''):
                                $numero_piece = $fiche->getNumerofacture();
                                if ($Str_Row_Color == $color1)
                                    $Str_Row_Color = $color2;
                                else
                                    $Str_Row_Color = $color1;
                                $border = 'border:solid 1px #000000';
                            else:
                                $numero_piece = $fiche->getNumerofacture();
                                $border = '';
                            endif;
                            ?>
                            <tr style="background: <?php echo $Str_Row_Color ?>">
                                <td style="text-align: center;"><?php echo date('d/m/Y', strtotime($fiche->getDate())) ?></td>
                                <td style="text-align: center;">
                                    <?php echo $fiche->getNumerofacture(); ?>
                                    <!--                                    <a style="cursor: pointer;" target="_blank" title="Modifier Mouvement" 
                                                                           href="<?php // echo url_for('saisie_pieces/showEdit?id=' . $fiche->getPiececomptable()->getId())     ?>">
                                    <?php // echo $fiche->getNumerofacture(); ?>
                                                                        </a>-->
                                </td>  
                                <td style="text-align: center;"> <?php echo number_format($fiche->getMontant(), 3, ',', ' '); ?></td>  
                                <td style="text-align: center;"> <?php echo $fiche->getDocumentachat()->getNumerodocachat() ?></td>  

                                <td style="text-align: center;"><?php echo date('d/m/Y', strtotime($fiche->getDocumentachat()->getDatecreation())) ?></td>
                                <td style="text-align: center;"> <?php echo $fiche->getRrs() . ' ' . $fiche->getPvr() ?></td>  

                                <td style="text-align: center;"><?php echo date('d/m/Y', strtotime($fiche->getDaterrspvr())) ?></td>
                                <td style="text-align: center;"> <?php echo $fiche->getFournisseur() ?></td>                    
                                <td style="cursor: pointer; text-align: center;">

                                    <span class="btn-group">
                                        <a    class="btn btn-danger btn-xs" onclick="openPopupSupprimerForm(<?php echo $fiche->getId() ?>)" ><i class="ace-icon fa fa-trash"></i></a>
                                    </span>

                                </td>
                            <?php endforeach; ?> 
                        <?php else: ?>
                        <tr>
                            <td style="text-align:center; font-weight: bold; font-size: 16px !important; height: 100px; vertical-align: middle;" colspan="10">
                                Pas des Mouvements</td>
                        </tr>

                    <?php endif; ?>
                </tbody>
            </table>

        </div>
    </div>
</div>