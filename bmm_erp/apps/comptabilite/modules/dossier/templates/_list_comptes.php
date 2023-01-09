<div style="text-align: center; margin: 3%; font-weight: bold; font-size: 16px;">
    <span> Dossier Comptable : <?php echo $dossier->getCode() . ' - ' . $dossier->getRaisonSociale(); ?></span>
</div>
<div style="margin-left: 1%; ">
    <table style="width: 100%">
        <tr>
            <td style="width: 50%">
                <div class="mws-form-row">
                    <label class="mws-form-label" style="width: 37%;">Numéro du Compte :</label>
                    <div class="mws-form-item">
                        <input class="large" type="text" id="search_numero" onkeyup="searchByNumeroAndLibelle()">
                    </div>
                </div>
            </td>
            <td style="width: 50%">
                <div class="mws-form-row">
                    <label class="mws-form-label" style="width: 37%;">Intitulé du Compte :</label>
                    <div class="mws-form-item">
                        <input class="large" type="text" id="search_libelle" onkeyup="searchByNumeroAndLibelle()">
                    </div>
                </div>
            </td>
        </tr>
    </table>
</div>
<div class="mws-panel-body no-padding" style="margin-bottom: 15px; ">
    <div style="height: 360px; overflow: auto;" >
        <table class="fancyTable" id="myTable01" >
            <thead>
                <tr>
                    <th>Numéro</th>
                    <th>Intitulé du Compte</th>
                    <th>Classe</th>
                    <th>Date de Création</th>
                    <th>opérations</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <td colspan="5" style="height: 15px;"></td>
                </tr>
            </tfoot>
            <tbody>
                <?php foreach ($comptes as $compte): ?>
                    <tr class="ligne_compte" data_libelle="<?php echo $compte->getLibelle(); ?>" data_number="<?php echo $compte->getNumeroCompte(); ?>">
                        <td><b><?php echo $compte->getNumeroCompte(); ?></b>
                            <input type="hidden" name="compte_dossier" value="<?php echo $compte->getId(); ?>"/>
                        </td>
                        <td><?php echo $compte->getLibelle(); ?></td>
                        <td><?php echo $compte->getClasseComptable()->getLibelle(); ?></td>
                        <td>
                            <?php if ($compte->getDate() != '' && $compte->getDate() != null): ?>
                                <?php echo date('d/m/Y', strtotime($compte->getDate())); ?>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php if ($compte->getStandard() != 1): ?>
                                <a style="cursor: pointer" title="Supprimer" onclick="supprimerCompte(<?php echo $compte->getId() ?>)" class="btn btn-small"><i class="icon-trash"></i></a>
                                <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<script  type="text/javascript">

    function searchByNumeroAndLibelle() {
        var libelle = '';
        var numero = '';
        var motiflib = $('#search_libelle').val();
        var motifnum = $('#search_numero').val();
        motiflib = motiflib.toUpperCase();
        $('#myTable01 tbody tr').each(function() {
            libelle = $(this).attr('data_libelle');
            numero = $(this).attr('data_number');
            var indexlib = libelle.indexOf(motiflib);
            var indexnum = numero.indexOf(motifnum);
            if (indexlib >= 0 && indexnum >= 0) {
                $(this).css('display', '');
            }
            else {
                $(this).css('display', 'none');
            }
        });
    }
    
</script>