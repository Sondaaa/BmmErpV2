<table style="width: 80%; margin: 20px;">
    <tr>
        <td style="text-align: right">
            <div id="button_affect" style="display:none;">
                <input name="button" type="button" class="mws-button green large" onclick="saveDossierForManyCompte()" value="Affecter">
            </div>
        </td>
        <td style="display:none;">
            <input type="hidden" id="dossier_id" value="<?php echo $dossier; ?>"/>
        </td>
    </tr>

</table>

<div class="mws-panel grid_8">
    <div class="mws-panel-body no-padding">
        <form class="mws-form">
            <div class="mws-form-inline" id="liste_compte" >
                <div class="mws-panel-header">
                    <span>Plan Comptable</span>
                </div>
                <div style="margin-left: 1%; margin-top: 10px;">
                    <table style="width: 100%">
                        <tr>
                            <td style="width: 50%">
                                <div class="mws-form-row">
                                    <label class="mws-form-label" style="width: 35%;">Numéro du Compte Comptable :</label>
                                    <div class="mws-form-item">
                                        <input class="large" type="text" id="search_numero" onkeyup="searchByNumeroAndLibelle()">
                                    </div>
                                </div>
                            </td>
                            <td style="width: 45%">
                                <div class="mws-form-row">
                                    <label class="mws-form-label" style="width: 35%;">Intitulé du Compte Comptable :</label>
                                    <div class="mws-form-item">
                                        <input class="large" type="text" id="search_libelle" onkeyup="searchByNumeroAndLibelle()">
                                    </div>
                                </div>
                            </td>
                            <td>
                                <a style="cursor: pointer; height: 15px; padding: 7px 10px; margin-top: -7px;" title="Réinitialiser" onclick="initListeCompte()" class="btn btn-small"><i class="icon-repeat "></i></a>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="mws-panel-body no-padding" style="margin-bottom: 15px;">
                    <div style="height: 360px; overflow: auto;" >
                        <table class="fancyTable" id="myTable01">
                            <thead>
                                <tr>
                                    <th><input id="selecte_all" type="checkbox"></th>
                                    <th>Numéro</th>
                                    <th>Intitulé du Compte</th>
<!--                                    <th>Lettrage</th>-->
                                    <th>Classe</th>
<!--                                    <th>Solde</th>-->
                                    <th>Date de Création</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <td colspan="7" style="height: 15px;"></td>
                                </tr>
                            </tfoot>
                            <tbody>
                                <?php foreach ($comptes as $compte): ?>
                                    <?php
                                    $check = 0;
                                    foreach ($compte->getDossierComptable() as $cd):
                                        ?>
                                        <?php
                                        if ($cd->getId() == $dossier)
                                            $check = 1;
                                        ?>
                                    <?php endforeach; ?>
                                    <?php if ($check == 0): ?>
                                        <tr class="ligne_compte" data_libelle="<?php echo $compte->getLibelle(); ?>" data_number="<?php echo $compte->getNumeroCompte(); ?>">
                                            <td> <input class="list_checbox_compte"  value="<?php echo $compte->getId(); ?>" type="checkbox"/> </td>
                                            <td><b><?php echo $compte->getNumeroCompte(); ?></b>
                                                <input type="hidden" name="compte_dossier" value="<?php echo $compte->getId(); ?>"/>
                                            </td>
                                            <td><?php echo $compte->getLibelle(); ?></td>
                                            <!--<td>-->
                                                <?php
//                                                switch ($compte->getLettrage()) {
//                                                    case '0':
//                                                        echo 'Libre';
//                                                        break;
//                                                    case '1':
//                                                        echo 'Lettrable';
//                                                        break;
//                                                    case '2':
//                                                        echo 'Rapprochable';
//                                                        break;
//
//                                                    default:
//                                                        echo 'Libre';
//                                                        break;
//                                                }
                                                ?>
                                            <!--</td>-->
                                            <td><?php echo $compte->getClasseComptable()->getLibelle(); ?></td>
<!--                                            <td>-->
                                                <?php
//                                                switch ($compte->getTypeSolde()) {
//                                                    case '0':
//                                                        echo 'Débiteur';
//                                                        break;
//                                                    case '1':
//                                                        echo 'Créditeur';
//                                                        break;
//                                                    case '2':
//                                                        echo 'Soldé';
//                                                        break;
//                                                    case '3':
//                                                        echo 'Libre';
//                                                        break;
//
//                                                    default:
//                                                        echo 'Libre';
//                                                        break;
//                                                }
                                                ?>
                                            <!--</td>-->
                                            <td>
                                                <?php if ($compte->getDate() != '' && $compte->getDate() != null): ?>
                                                    <?php echo date('d/m/Y', strtotime($compte->getDate())); ?>
                                                <?php endif; ?>
                                            </td>


                                        </tr>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </form>
    </div>
</div>
<script  type="text/javascript">


    $('.list_checbox_compte').change(function() {
        if ($('.list_checbox_compte[type=checkbox]:checked').length == 0) {
            $('#button_affect').css('display', 'none');
        }
        if ($(this).is(':checked')) {
            $('#button_affect').css('display', 'block');
        }
    });

    $(document).ready(function() {
        $('#myTable01').fixedHeaderTable({footer: true, altClass: 'odd', fixedColumns: 1});
        $('#selecte_all').change(function() {
            if ($(this).is(':checked')) {
                $('.list_checbox_compte').attr('checked', 'checked');
                $('#button_affect').css('display', 'block');
                if ($('.list_checbox_compte[type=checkbox]:checked').length == 0) {
                    $('#button_affect').css('display', 'none');
                }
            } else {
                $('.list_checbox_compte').removeAttr('checked');
                $('#button_affect').css('display', 'none');
            }
        });
    });
    $('#myTable01 tbody tr').click(function() {
        $('#myTable01 tbody tr td').each(function() {
            $(this).css('background', '');
            $(this).css('border-bottom', '');
            $(this).css('border-top', '');
        });
        $(this).children().css('background', 'repeat-x scroll left bottom #d8d6d6');
        $(this).children().css('border-bottom', '1px solid #000000');
        $(this).children().css('border-top', '1px solid #000000');
    });
</script>
