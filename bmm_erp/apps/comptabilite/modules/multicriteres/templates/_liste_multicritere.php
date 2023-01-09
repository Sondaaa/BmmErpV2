<?php
$url = 'filtre=' . $filtre;
switch ($filtre) {
    case 'date_piece':
        if ($operation != '')
            $url.= '&operation=' . $operation;
        if ($date != '')
            $url.= '&date=' . $date;
        if ($date_debut != '')
            $url.= '&date_debut=' . $date_debut;
        if ($date_fin != '')
            $url.= '&date_fin=' . $date_fin;
        break;

    case 'date_saisie':
        if ($operation != '')
            $url.= '&operation=' . $operation;
        if ($date != '')
            $url.= '&date=' . $date;
        if ($date_debut != '')
            $url.= '&date_debut=' . $date_debut;
        if ($date_fin != '')
            $url.= '&date_fin=' . $date_fin;
        break;

    case 'date_modification':
        if ($operation != '')
            $url.= '&operation=' . $operation;
        if ($date != '')
            $url.= '&date=' . $date;
        if ($date_debut != '')
            $url.= '&date_debut=' . $date_debut;
        if ($date_fin != '')
            $url.= '&date_fin=' . $date_fin;
        break;

    case 'montant':
        if ($operation != '')
            $url.= '&operation=' . $operation;
        if ($montant != '')
            $url.= '&montant=' . $montant;
        if ($montant_min != '')
            $url.= '&montant_min=' . $montant_min;
        if ($montant_max != '')
            $url.= '&montant_max=' . $montant_max;
        break;

    case 'libelle':
        if ($libelle != '')
            $url.= '&libelle=' . $libelle;
        break;

    case 'numero_piece':
        if ($numero != '')
            $url.= '&numero=' . $numero;
        break;

    case 'numero_externe':
        if ($externe != '')
            $url.= '&externe=' . $externe;
        break;

    case 'reference':
        if ($reference != '')
            $url.= '&reference=' . $reference;
        break;

    case 'journal':
        if ($date_debut != '')
            $url.= '&date_debut=' . $date_debut;
        if ($date_fin != '')
            $url.= '&date_fin=' . $date_fin;
        break;

    case 'compte':
        if ($compte_debut != '')
            $url.= '&compte_debut=' . $compte_debut;
        if ($compte_fin != '')
            $url.= '&compte_fin=' . $compte_fin;
        break;

    case 'devise':
        if ($devise != '')
            $url.= '&devise=' . $devise;
        break;

    case 'sens':
        if ($credit != '')
            $url.= '&credit=' . $credit;
        if ($debit != '')
            $url.= '&debit=' . $debit;
        if ($creditdebit != '')
            $url.= '&creditdebit=' . $creditdebit;
        break;

    case 'user':
        if ($user != '')
            $url.= '&user=' . $user;
        break;
}
?>
<div class="mws-panel-body">
    <div class="row">
        <div class="col-xs-12">
            <div class="table-header">
                Liste des pièces comptables :
                <a target="_blank" class="btn btn-sm btn-success" style="float: right; padding: 5px 12px;" href="<?php echo url_for("multicriteres/imprimerListe?" . $url); ?>">
                    <i class="ace-icon fa fa-print bigger-110"></i>
                    <span class="bigger-110 no-text-shadow">Imprimer</span>
                </a>
            </div>
            <div>
                <table id="listPiece" class="table table-bordered table-hover">
                    <thead>
                        <tr id="list_tri" style="border-bottom: 1px solid #000000">
                            <th>Journal Comptable</th>
                            <th style="width: 10%;">Date</th>  
                            <th style="width: 10%;">Numéro</th>
                            <th style="width: 10%;">Référence</th>
                            <th style="width: 10%;">Série</th> 
                            <th style="width: 10%;">Total débit</th>
                            <th style="width: 10%;">Total cédit</th>
                            <th style="width: 20%;">Libellé</th>
                            <th style="width: 10%;">Opérations</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (count($pager) == 0): ?>
                            <tr>
                                <td style="text-align:center; font-weight: bold; font-size: 16px !important;" colspan="8">Liste des Pièces Vide</td>
                            </tr>
                        <?php endif; ?>

                        <?php foreach ($pager->getResults() as $i => $piece): ?>
                            <tr style="cursor: pointer;" id="ligne_<?php echo $i ?>" onclick="formatLigne('<?php echo $i ?>')" index_ligne="<?php echo $i ?>">
                                <td style="text-align: left; padding-left: 1%;"><?php echo $piece->getJournalcomptable()->getLibelle() ?></td>
                                <td style="text-align: center;"><?php echo date('d/m/Y', strtotime($piece->getDate())) ?></td>
                                <td style="text-align: center;">
                                    <a target="_blank" title="Modifer Pièce" href="<?php echo url_for('saisie_pieces/showEdit?id=' . $piece->getId()) ?>"><?php echo $piece->getNumero() ?></a>
                                </td>
                                <td style="text-align: center;"><?php echo $piece->getLignepiececomptable()->getReference() ?></td>
                                <td style="text-align: center;"><?php echo $piece->getNumeroseriejournal()->getPrefixe() ?></td>
                                
                                <td style="text-align: center;"><?php echo $piece->getTotaldebit() ?></td>
                                <td style="text-align: center;"><?php echo $piece->getTotalcredit() ?></td>
                                <td style="text-align: center;">
<!--                                    <a class="blue" id="show-option" href="#" title="Saisie Le : <?php // echo date('d/m/Y', strtotime($piece->getDatecreation())) ?>">
                                        <i class="ace-icon fa fa-hand-o-right"></i>-->
                                        <?php echo $piece->getLibelle(); ?>
                                    <!--</a>-->
                                </td>
                                <td style="cursor: pointer; text-align: center;">
                                    <a type="button" title="Afficher" href="<?php echo url_for('saisie_pieces/show?id=' . $piece->getId()); ?>" target="_blank" class="btn btn-xs btn-primary"><i class="ace-icon fa fa-eye bigger-110" style="margin-right: 1px; margin-top: 0px;"></i></a>
                                    <a type="button" title="Imprimer" href="<?php echo url_for('saisie_pieces/imprimePiece?id=' . $piece->getId()); ?>" target="_blank" class="btn btn-xs btn-warning"><i class="ace-icon fa fa-print bigger-110" style="margin-right: 1px; margin-top: 0px;"></i></a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot id="listPiece_footer">

                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
<script  type="text/javascript">
    var footer = '';
    $('#listPiece_footer').html('');
<?php if ($pager->haveToPaginate()): ?>
        footer = '<tr>' +
                '<td style ="padding: 0px;" colspan ="9">' +
                '<div class ="row" style ="border-bottom: 1px solid #e0e0e0; padding-top: 12px; padding-bottom: 12px; background-color: #EFF3F8; margin-left: 0px; margin-right: 0px;">' +
                '<div class ="col-xs-12" >' +
                '<div class ="dataTables_paginate paging_simple_numbers" id ="dynamic-table_paginate">' +
                '<ul class ="pagination">' +
    <?php if ($pager->getPage() == 1): ?>
            '<li class ="paginate_button previous disabled" aria-controls ="dynamic-table" tabindex ="0" id ="dynamic-table_previous"> <a href = "#"> <i class="ace-icon fa fa-angle-double-left"></i> Première </a></li>' +
                    '<li class ="paginate_button previous disabled" aria-controls ="dynamic-table" tabindex ="0" id ="dynamic-table_previous"> <a href = "#"> <i class="ace-icon fa fa-angle-left"></i> Précédente </a></li>' +
    <?php else: ?>
            '<li class ="paginate_button previous" aria-controls ="dynamic-table" tabindex ="0" id ="dynamic-table_previous"> <a onclick="goPage(\'1\')"> <i class="ace-icon fa fa-angle-double-left"></i> Première </a></li>' +
                    '<li class ="paginate_button previous" aria-controls ="dynamic-table" tabindex ="0" id ="dynamic-table_previous"> <a onclick="goPage(\'<?php echo $pager->getPreviousPage() ?>\')"> <i class="ace-icon fa fa-angle-left"></i> Précédente </a></li>' +
    <?php endif; ?>
    <?php foreach ($pager->getLinks() as $page): ?>
        <?php if ($page == $pager->getPage()): ?>
                '<li class ="paginate_button active" aria-controls ="dynamic-table" tabindex ="0"> <a href = "#"> <?php echo $page ?> </a></li>' +
        <?php else: ?>
                '<li class ="paginate_button" aria-controls ="dynamic-table" tabindex ="0"> <a onclick="goPage(\'<?php echo $page ?>\')"> <?php echo $page ?> </a></li>' +
        <?php endif; ?>
    <?php endforeach; ?>
    <?php if ($pager->getPage() == $pager->getLastPage()): ?>
            '<li class ="paginate_button next disabled" aria-controls ="dynamic-table" tabindex ="0" id ="dynamic-table_next"> <a href = "#"> Suivante <i class="ace-icon fa fa-angle-right"></i> </a></li>' +
                    '<li class ="paginate_button next disabled" aria-controls ="dynamic-table" tabindex ="0" id ="dynamic-table_next"> <a href = "#"> Dernière <i class="ace-icon fa fa-angle-double-right"></i> </a></li>' +
    <?php else: ?>
            '<li class ="paginate_button next" aria-controls ="dynamic-table" tabindex ="0" id ="dynamic-table_next"> <a onclick="goPage(\'<?php echo $pager->getNextPage() ?>\')"> Suivante <i class="ace-icon fa fa-angle-right"></i> </a></li>' +
                    '<li class ="paginate_button next" aria-controls ="dynamic-table" tabindex ="0" id ="dynamic-table_next"> <a onclick="goPage(\'<?php echo $pager->getLastPage() ?>\')"> Dernière <i class="ace-icon fa fa-angle-double-right"></i> </a></li>' +
    <?php endif; ?>
        '</ul>' +
                '</div>' +
                '</div>' +
                '</div>' +
                '</td>' +
                '</tr>';
<?php else: ?>
        footer = '<tr>' +
                '<td style ="padding: 0px;" colspan ="10">' +
                '<div class ="row" style ="border-bottom: 1px solid #e0e0e0; padding-top: 12px; padding-bottom: 12px; background-color: #EFF3F8; margin-left: 0px; margin-right: 0px;">' +
                '<div class ="col-xs-12">' +
                '</div>' +
                '</div>' +
                '</td>' +
                '</tr>';
<?php endif; ?>

    $('#listPiece_footer').html(footer);

</script>

<script  type="text/javascript">
    //tooltips
    $("#show-option").tooltip({
        show: {
            effect: "slideDown",
            delay: 250
        }
    });

    function formatLigne(index) {
        $('#listPiece tbody tr').each(function () {
            $(this).css('background', '');
            $(this).css('border-bottom', '');
            $(this).css('border-top', '');
        });
        $('#ligne_' + index).css('background-color', '#F0F0F0');
        $('#ligne_' + index).css('border-bottom', '1px solid #000000');
        $('#ligne_' + index).css('border-top', '1px solid #000000');
    }

</script>