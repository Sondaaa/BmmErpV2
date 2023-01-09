<?php
$color1 = "#D7BDE2";
# e6ecff #EDBB99 b3c6ff
$color2 = "#EDBB99;";

$id_articlestock = '';
$Str_Row_Color = '';
$id_s = []; ?>
<?php if (count($pager) == 0) : ?>
    <tr>
        <td style="text-align:center; font-weight: bold; font-size: 16px !important;" colspan="9">Liste des BCI vide</td>
    </tr>
<?php endif; ?>
<?php foreach ($pager->getResults() as $i => $documentachat) : ?>
    <?php
    array_push($id_s, $documentachat->getId());
    //echo $documentachat->getId();
    ?>
<?php endforeach; ?>
<?php foreach ($pager->getResults() as $i => $documentachat) : ?>
    <tr id="ligne_<?php echo $i ?>" onclick="AddIdDocachat(<?php echo $documentachat->getId() ?>)" class="row_facture">
        <input type="hidden" idientifiant="<?php echo $documentachat->getId() ?>">

        <td>
            <input type="checkbox" idientifiant="<?php echo $documentachat->getId() ?>" onclick="AddIdDocachat('<?php echo $documentachat->getId()  ?>')" name="checkk" id="check_<?php echo $documentachat->getId() ?>" libelle="check_0" index_ligne_chek="0" class="list_checbox_facture">
        </td>


        <td name="ligne_date" style="text-align: center;"><?php echo date('d/m/Y', strtotime($documentachat->getDatecreation())) ?></td>
        <td name="ligne_numero" style="text-align: center;"><?php echo $documentachat->getNumerodocachat() ?></td>
        <td name="ligne_serie" style="text-align: center;"><?php echo $documentachat->getReference() ?></td>
        <td name="ligne_numero" style="text-align: center;"><?php echo $documentachat->getDemandeur(); ?></td>
        <td name="ligne_numero" style="text-align: center;"><?php echo $documentachat->getNaturedocachat(); ?></td>
        <td name="ligne_numero" style="text-align: right;"><?php echo $documentachat->getMontantestimatif(); ?></td>
        <td name="ligne_user" style="text-align: left;"><?php
         echo $documentachat->getEtatdocument(); ?>
        </td>
        <td style="cursor: pointer; text-align: center;">
            <div class="btn-toolbar">
                <div class="btn-group" id="btnaction">
                    <button data-toggle="dropdown" class="btn btn-primary btn-white dropdown-toggle">
                        Action
                        <i class="ace-icon fa fa-angle-down icon-on-right"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-right" role="menu">
                        <li>
                            <a id="btnimpexpo" class="btn btn-xs btn-success " href="<?php echo url_for('documentachat/showdocument?iddoc=') . $documentachat->getId() ?>"><i class="ace-icon fa fa-eye bigger-110"></i>Détails N°: <?php echo $documentachat->getNumerodocachat() ?></a>
                        </li>
                        <?php if ($documentachat->getIdEtatdoc() == 1) { ?>
                            <?php //if ($documentachat->getIdNaturedoc() == 2 || $documentachat->getIdNaturedoc() == 1) { ?>

                                <li>

                                    <button type="button" onclick="document.location.href = '<?php echo url_for('documentachat/rempliretexporterDA') . '?iddoc=' . $documentachat->getId() ?>'" class="btn btn-outline btn-default"><i class="fa fa-long-arrow-right"></i> Valider D/A et Envoyer Budget</button>
                                </li> <?php //} ?>
                        <?php } ?>

                        <!-- <li>
                            <button type="button" onclick="document.location.href = '<?php //echo url_for('documentachat/rempliretexporterDA') . '?iddoc=' . $documentachat->getId() 
                                                                                        ?>'" class="btn btn-outline btn-default"><i class="fa fa-long-arrow-right"></i>Envoyer Pour Regroupper</button>
                        </li> -->

                        <li>
                            <a id="btnimpexpo" class="btn btn-white btn-primary" href="<?php echo url_for('documentachat/imprimerboncomande?iddoc=') . $documentachat->getId() ?>"> <i class="ace-icon fa fa-print bigger-110"></i>Imprimer D.I.: <?php echo $documentachat->getNumerodocachat() ?></a>
                        </li>
                        <li>
                            <button onclick="if (confirm('Etes-vous sûr?')) {
                                        var f = document.createElement('form');
                                        f.style.display = 'none';
                                        this.parentNode.appendChild(f);
                                        f.method = 'post';
                                        f.action = 'documentachat/delete?id=<?php echo $documentachat->getId() ?>';
                                        var m = document.createElement('input');
                                        m.setAttribute('type', 'hidden');
                                        m.setAttribute('name', 'sf_method');
                                        m.setAttribute('value', 'delete');
                                        f.appendChild(m);
                                        f.submit();
                                    }
                                    ;
                                    return false;" type="button" class="btn btn-xs btn-danger btn-white "><i class="fa fa-bitbucket"></i> Supprimer</button>
                        </li>

        </td>
    </tr>
    <tr>
        <td colspan="9">
            <?php $lignes = LignedocachatTable::getInstance()->getByDocachatInOrderSaisie($documentachat->getId());
            ?>

            <?php if ($lignes->count() > 0) : ?>
                <table style="width: 98%; margin-bottom: 10px; margin-left: 1%;" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th style="width: 4%; text-align: center;">N°</th>
                            <th style="width: 30%;">Code Article</th>
                            <th style="width: 13%; text-align: center;">Désignat°Art</th>
                            <th style="width: 13%; text-align: center;">Qte</th>
                            <th style="width: 15%;">Projet</th>
                            <th style="width: 30%;">Observation</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 0;


                        $lignesss = LignedocachatTable::getInstance()->getByInDocachat($id_s);  ?>
                        <?php foreach ($lignes as $lg) : ?>
                            <?php $count = 0;
                            foreach ($lignesss as $lgrech) {
                                if (intval($lg->getIdArticlestock()) ==  intval($lgrech->getIdArticlestock())) {
                                    $count++;
                                }
                            }
                            if ($count > 1) : // echo ($count . "de");

                                $Str_Row_Color = $color1;
                                if ($Str_Row_Color == $color1)
                                    $Str_Row_Color = $color2;
                                else
                                    $Str_Row_Color = $color1;
                                $border = 'border:solid 1px #000000';

                            endif;
                            ?>
                            <tr style="background: <?php //echo $Str_Row_Color 
                                                    ?>">
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
                            <?php $i++;  ?>
                        <?php endforeach; ?>

                    </tbody>
                </table>
            <?php endif; ?>
        </td>
    </tr>
<?php endforeach; ?>

<script type="text/javascript">
    var footer = '';
    $('#listPiece_footer').html('');
    <?php if ($pager->haveToPaginate()) : ?>
        footer = '<tr>' +
            '<td style ="padding: 0px;" colspan ="10">' +
            '<div class ="row" style ="border-bottom: 1px solid #e0e0e0; padding-top: 12px; padding-bottom: 12px; background-color: #EFF3F8; margin-left: 0px; margin-right: 0px;">' +
            '<div class ="col-xs-12" >' +
            '<div class ="dataTables_paginate paging_simple_numbers" id ="dynamic-table_paginate">' +
            '<ul class ="pagination">' +
            <?php if ($pager->getPage() == 1) : ?> '<li class ="paginate_button previous disabled" aria-controls ="dynamic-table" tabindex ="0" id ="dynamic-table_previous"> <a href = "#"> <i class="ace-icon fa fa-angle-double-left"></i> Première </a></li>' +
                '<li class ="paginate_button previous disabled" aria-controls ="dynamic-table" tabindex ="0" id ="dynamic-table_previous"> <a href = "#"> <i class="ace-icon fa fa-angle-left"></i> Précédente </a></li>' +
            <?php else : ?> '<li class ="paginate_button previous" aria-controls ="dynamic-table" tabindex ="0" id ="dynamic-table_previous"> <a onclick="goPage(\'1\')"> <i class="ace-icon fa fa-angle-double-left"></i> Première </a></li>' +
                '<li class ="paginate_button previous" aria-controls ="dynamic-table" tabindex ="0" id ="dynamic-table_previous"> <a onclick="goPage(\'<?php echo $pager->getPreviousPage() ?>\')"> <i class="ace-icon fa fa-angle-left"></i> Précédente </a></li>' +
            <?php endif; ?>
        <?php foreach ($pager->getLinks() as $page) : ?>
            <?php if ($page == $pager->getPage()) : ?>
                    '<li class ="paginate_button active" aria-controls ="dynamic-table" tabindex ="0"> <a href = "#"> <?php echo $page ?> </a></li>' +
                <?php else : ?> '<li class ="paginate_button" aria-controls ="dynamic-table" tabindex ="0"> <a onclick="goPage(\'<?php echo $page ?>\')"> <?php echo $page ?> </a></li>' +
                <?php endif; ?>
            <?php endforeach; ?>
            <?php if ($pager->getPage() == $pager->getLastPage()) : ?>
                    '<li class ="paginate_button next disabled" aria-controls ="dynamic-table" tabindex ="0" id ="dynamic-table_next"> <a href = "#"> Suivante <i class="ace-icon fa fa-angle-right"></i> </a></li>' +
                    '<li class ="paginate_button next disabled" aria-controls ="dynamic-table" tabindex ="0" id ="dynamic-table_next"> <a href = "#"> Dernière <i class="ace-icon fa fa-angle-double-right"></i> </a></li>' +
                <?php else : ?> '<li class ="paginate_button next" aria-controls ="dynamic-table" tabindex ="0" id ="dynamic-table_next"> <a onclick="goPage(\'<?php echo $pager->getNextPage() ?>\')"> Suivante <i class="ace-icon fa fa-angle-right"></i> </a></li>' +
                    '<li class ="paginate_button next" aria-controls ="dynamic-table" tabindex ="0" id ="dynamic-table_next"> <a onclick="goPage(\'<?php echo $pager->getLastPage() ?>\')"> Dernière <i class="ace-icon fa fa-angle-double-right"></i> </a></li>' +
                <?php endif; ?> '</ul>' +
                '</div>' +
                '</div>' +
                '</div>' +
                '</td>' +
                '</tr>';
            <?php else : ?>
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