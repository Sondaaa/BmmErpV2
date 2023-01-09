<?php if (count($pager) == 0): ?>
    <tr>
        <td style="text-align:center; font-weight: bold; font-size: 16px !important;" colspan="9">Liste des Pièces Vide</td>
    </tr>
<?php endif; ?>

<?php foreach ($pager->getResults() as $i => $piece): ?>
    <tr id="ligne_<?php echo $i ?>" onclick="formatLigne(<?php echo $i ?>)" index_ligne="<?php echo $i ?>" ondblclick="showPiece('<?php echo $piece->getId() ?>')">

        <td name="ligne_journal" class="" style="text-align: left; padding-left: 1%;"><?php echo $piece->getJournalComptable()->getLibelle() ?></td>
        <td name="ligne_date" class="" style="text-align: center;"><?php echo date('d/m/Y', strtotime($piece->getDate())) ?></td>
        <td name="ligne_numero" class="" style="text-align: center;"><?php echo $piece->getNumero() ?></td>
        <td name="ligne_numero" class="" style="text-align: center;"><?php echo $piece->getNumeroSerieJournal()->getPrefixe() ?></td>
        <td style="text-align: center;"><?php echo $piece->getTotalDebit() ?></td>
        <td style="text-align: center;"><?php echo $piece->getTotalCredit() ?></td>
        <td name="ligne_user" class="" style="text-align: center;">
            <a rel="" href="#" date="<?php echo date('d/m/Y', strtotime($piece->getDateCreation())) ?>">
                <?php echo $piece->getSfGuardUser()->getLastName() . ' ' . $piece->getSfGuardUser()->getFirstName() ?>
            </a>
        </td>
        <td style="text-align: center;">
            <a style="cursor: pointer" href="<?php echo url_for('@showPieceSource?id=' . $piece->getPieceSourceId()); ?>" target="_blank" >   <?php echo $piece->getPieceComptable()->getNumero() ?> </a>
        </td>
        <td style="cursor: pointer; text-align: center;">
            <span class="btn-group">
                <a style="cursor: pointer" title="Afficher" onclick="showPiece('<?php echo $piece->getId() ?>')" class="btn btn-small"><i class="icon-eye-open"></i></a>
                <a style="cursor: pointer" title="Proprieté" onclick="showProprietePiece('<?php echo $piece->getId() ?>')" class="btn btn-small"><i class="icon-light-bulb"></i></a>
    <!--                <a style="cursor: pointer" onclick="imprimerPiece('<?php //echo $piece->getId()   ?>')" class="btn btn-small"><i class="icon-print"></i></a>
                <a style="cursor: pointer" onclick="showEditPiece('<?php //echo $piece->getId()   ?>')" class="btn btn-small"><i class="icon-pencil"></i></a>

                <a style="cursor: pointer" onclick="openPopupSupprimer(<?php //echo $piece->getId()   ?>)" class="btn btn-small"><i class="icon-trash"></i></a>-->
            </span>
        </td>
    </tr>
<?php endforeach; ?>

<?php if ($pager->haveToPaginate()): ?>
    <script  type="text/javascript">
    <?php if ($pager->getPage() == 1): ?>
            var divPage = '<div class="dataTables_paginate paging_full_numbers">' +
                    '<span  class="first paginate_button paginate_button_disabled">Premier</span>' +
                    '<span  class="previous paginate_button paginate_button_disabled">Précédent</span><span>';
    <?php else: ?>
            var divPage = '<div class="dataTables_paginate paging_full_numbers">' +
                    '<span onclick="goPage(\'1\')" class="first paginate_button ">Premier</span>' +
                    '<span onclick="goPage(\'<?php echo $pager->getPreviousPage() ?>\')" class="previous paginate_button ">Précédent</span><span>';
    <?php endif; ?>
    <?php foreach ($pager->getLinks() as $page): ?>
        <?php if ($page == $pager->getPage()): ?>
                divPage = divPage + '<span class="paginate_active"><?php echo $page ?></span>';
        <?php else: ?>
                divPage = divPage + '<span onclick="goPage(\'<?php echo $page ?>\')" class="paginate_button"><?php echo $page ?></span>';
        <?php endif; ?>
    <?php endforeach; ?>
    <?php if ($pager->getPage() == $pager->getLastPage()): ?>
            divPage = divPage + '<span  class="next paginate_button paginate_button_disabled">Suivant</span>' +
                    '<span  class="last paginate_button paginate_button_disabled">Dernier</span>';
            $('#list_piece_pager').html(divPage);
    <?php else: ?>
            divPage = divPage + '<span onclick="goPage(\'<?php echo $pager->getNextPage() ?>\')" class="next paginate_button">Suivant</span>' +
                    '<span onclick="goPage(\'<?php echo $pager->getLastPage() ?>\')" class="last paginate_button">Dernier</span>';

    <?php endif; ?>
        $('#list_piece_pager').html(divPage);
    </script>
<?php else: ?>
    <script  type="text/javascript">
        $('#list_piece_pager').html('<div class="dataTables_paginate paging_full_numbers"></div>');
    </script>
<?php endif; ?>
<script  type="text/javascript">
    $('#listPiece tbody a[rel]').each(function()
    {
        $(this).qtip(
                {
                    content: {
                        // Set the text to an image HTML string with the correct src URL to the loading image you want to use
                        text: '<img class="throbber" src="/projects/qtip/images/throbber.gif" alt="Loading..." /><br>Date de Création est ' + $(this).attr('date'),
//                url: $(this).attr('rel'), // Use the rel attribute of each element for the url to load
                        title: {
                            text: $(this).text(), // Give the tooltip a title using each elements text
//                    button: 'Close' // Show a close link in the title
                        }
                    },
                    position: {
                        corner: {
                            target: 'bottomMiddle', // Position the tooltip above the link
                            tooltip: 'topMiddle'
                        },
                        adjust: {
                            screen: true // Keep the tooltip on-screen at all times
                        }
                    },
                    show: {
                        when: 'mouseover',
                        solo: true // Only show one tooltip at a time
                    },
                    hide: 'mouseleave',
                    style: {
                        tip: true, // Apply a speech bubble tip to the tooltip at the designated tooltip corner
                        border: {
                            width: 0,
                            radius: 4
                        },
                        name: 'light', // Use the default light style
                        width: 200 // Set the tooltip width
                    }
                });
    });
</script>

<style>
    .nombre{
        background-color: #5b5b5b;
        border: medium none;
        border-radius: 4px;
        color: #fff;
        cursor: pointer;
        /*float: left;*/
        font-family: Bitter;
        font-weight: bold;
        line-height: 1.42857;
        margin: 0 3px;
        padding: 6px 12px;
        position: relative;
        text-decoration: none;
    }
</style>