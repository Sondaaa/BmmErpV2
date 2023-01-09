<?php if ($comptes->count() == 0): ?>
    <tr>
        <td style="text-align:center; font-weight: bold; font-size: 16px !important; height: 240px;" colspan="5"> Liste des comptes Vide </td>
    </tr>
<?php else: ?>
    <?php foreach ($comptes as $compte): ?>
        <tr class="ligne_compte" data_libelle="<?php echo $compte->getLibelle(); ?>" data_number="<?php echo $compte->getNumeroCompte(); ?>" data_class="<?php echo $compte->getIdClasse(); ?>">
            <td style="text-align: left;">
                <b><?php echo $compte->getNumeroCompte(); ?></b>
                <input type="hidden" name="compte_dossier" value="<?php echo $compte->getId(); ?>"/>
            </td>
            <td style="text-align: left;"><?php echo $compte->getLibelle(); ?></td>
            <td><?php echo $compte->getLibellecompte(); ?></td>
            <td style="text-align: center;">
                <?php
                $sous_compte = SouscomptejournalTable::getInstance()->findOneByIdSouscompteAndIdJournal($compte->getId(), $journal);
                $bloque = $sous_compte->getIsbloque();
                if ($bloque == 1):
                    ?>
                    <i class="ace-icon fa fa-check-square-o bigger-170" onclick="checkBloque('<?php echo $compte->getId() ?>', '<?php echo $journal ?>')" style="cursor: pointer;"></i>
                <?php else: ?>
                    <i class="ace-icon fa fa-square-o bigger-170" onclick="checkBloque('<?php echo $compte->getId() ?>', '<?php echo $journal ?>')" style="cursor: pointer;"></i>
                <?php endif; ?>
            </td>
            <td>
                <button type="button" class="btn btn-danger btn-sm" onclick="supprimerCompteJournal('<?php echo $compte->getId() ?>', '<?php echo $journal ?>')">
                    <i class="ace-icon fa fa-remove bigger-110 icon-only"></i>
                </button>
            </td>
        </tr>

    <?php endforeach; ?>
<?php endif; ?>

<script  type="text/javascript">

    function searchByNumeroAndLibelle() {
        var libelle = '';
        var numero = '';
        var class_compte = '';
        var motiflib = $('#search_libelle').val();
        var motifnum = $('#search_numero').val();
        var motifclass = $('#class_comptable').val();
        motiflib = motiflib.toUpperCase();
        $('#myTable01 tbody tr').each(function () {
            libelle = $(this).attr('data_libelle');
            numero = $(this).attr('data_number');
            class_compte = $(this).attr('data_class');
            var indexlib = libelle.indexOf(motiflib);
            var indexnum = numero.indexOf(motifnum);
            var indexclass = class_compte.indexOf(motifclass);
            if (indexlib >= 0 && indexnum >= 0 && indexclass >= 0) {
                $(this).css('display', '');
            }
            else {
                $(this).css('display', 'none');
            }
        });
    }

</script>