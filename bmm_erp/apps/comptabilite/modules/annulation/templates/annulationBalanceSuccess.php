<div id="sf_admin_container">
    <h1 id="replacediv"> Utilitaires
        <small>
            <i class="ace-icon fa fa-angle-double-right"></i> 
            Annulation Importation comptes comptables - Exercice <?php echo $_SESSION['exercice']; ?>
        </small>
    </h1>
</div>
<div>
    <div class="col-sm-12">
        <table>

            <tr>
                <td>
                    <b>Du</b>
                    <select id="compte_min">
                        <!--<option value=""></option>-->
                        <?php foreach ($comptes as $compte): ?>
                            <option id="compte_<?php echo $compte->getNumeroCompte() ?>" value="<?php echo $compte->getNumeroCompte() ?>"> <?php echo trim($compte->getNumeroCompte()) . ' - ' . trim($compte->getLibelle()) ?> </option>
                        <?php endforeach; ?>
                    </select></br>
                    <b>Au</b>
                    <select id="compte_max"> 
                         <!--<option value=""></option>-->
                        <?php foreach ($comptes as $compte): ?>
                            <option  value="<?php echo $compte->getNumeroCompte() ?>" selected="selected"> <?php echo trim($compte->getNumeroCompte()) . ' - ' . trim($compte->getLibelle()) ?> </option>
                        <?php endforeach; ?>
                    </select>
                </td>
                <td style="text-align: center;">
                    <button onclick="supprimer()" class="btn btn-sm btn-danger">
                        <i class="ace-icon fa fa-remove icon-on-right bigger-110"></i>
                        <span class="bigger-110 no-text-shadow">Supprimer</span>
                    </button>
                    <button style="cursor:pointer;margin-top: 2px;min-width: 114px " onclick="afficher()" class="btn btn-sm btn-primary"> 
                        <i class="ace-icon fa fa-eye bigger-110"></i>
                        <span class="bigger-110 no-text-shadow">Afficher</span>
                    </button>
                </td>
            </tr>

        </table>
        <table>
            <tr>
                <td style="width: 25%">
                    <label class="mws-form-label">Numéro du Compte Comptable :</label>
                    <div class="mws-form-item">
                        <input class="large" type="text" id="search_numero" onkeyup="searchByNumeroAndLibelle()">
                    </div>
                </td>
                <td style="width: 50%">
                    <label class="mws-form-label">Intitulé du Compte Comptable :</label>
                    <div class="mws-form-item">
                        <input class="large" type="text" id="search_libelle" onkeyup="searchByNumeroAndLibelle()">
                    </div>
                </td>
                <td style="width: 15%">
                    <label class="mws-form-label">Classe comptable :</label>
                    <div class="mws-form-item">
                        <select id="class_comptable" onchange="searchByNumeroAndLibelle()">
                            <option value="">Tous les classes</option>
                            <?php foreach ($classes as $cc): ?>
                                <option value="<?php echo $cc->getId(); ?>"><?php echo $cc->getLibelle(); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </td>
            </tr>
        </table>


        <div style="margin-bottom: 15px;" class="mws-panel-body no-padding">
            <div style="height: 360px; overflow: auto;" id="liste_compte_balance">
                <?php include_partial('annulation/list_comptes_balance', array('comptes' => $comptes)); ?>
            </div>   
        </div>
    </div>
</div>
<script  type="text/javascript">

//    function supprimer() {
//        $.ajax({
//            url: '<?php // echo url_for('annulation/supprimer')         ?>',
//            data: 'compte_min=' + $('#compte_min').val() + '&compte_max=' + $('#compte_max').val()
//             ,
//            success: function (data) {
////                $('#liste_compte').html(data);
//            }
//        });
//    }

    function supprimer() {
        var message_text = "Voulez-vous supprimer ces soldes des comptes comptables ? ";
        bootbox.confirm({
            message: message_text,
            buttons: {
                cancel: {
                    label: "Non",
                    className: "btn-sm",
                },
                confirm: {
                    label: "Oui",
                    className: "btn-primary btn-sm",
                }
            },
            callback: function (result) {
                if (result) {
                    validerSuppression();
                }
            }
        });
    }

    function validerSuppression() {

        $.ajax({
            url: '<?php echo url_for('annulation/supprimerSoldeComptecomptables') ?>',
            data: 'compte_min=' + $('#compte_min').val() + '&compte_max=' + $('#compte_max').val(),
            success: function (data) {
                if (data != null) {                    
                    $('#liste_compte_balance').html(data);
                    $('#compte_min').val('');
                    $('#compte_max').val('');
                    $('#compte_min').trigger("chosen:updated");
                    $('.chosen-container').trigger("chosen:updated");
                      $('#compte_max').trigger("chosen:updated");
                    $('.chosen-container').trigger("chosen:updated");
                }
                
//               
            }
        });
    }

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
            libelle = libelle.toUpperCase();
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


    function supprimerSeul(id, numero) {
        var message_text = "Voulez-vous supprimer les soldes du compte comptable    ?<br> Compte comptable numéro : " + numero;
        bootbox.confirm({
            message: message_text,
            buttons: {
                cancel: {
                    label: "Non",
                    className: "btn-sm",
                },
                confirm: {
                    label: "Oui",
                    className: "btn-primary btn-sm",
                }
            },
            callback: function (result) {
                if (result) {
                    validerSuppressionSeul(id);
                }
            }
        });
    }

    function validerSuppressionSeul(id) {
        $.ajax({
            url: '<?php echo url_for('@deleteSoldeCompteComptable') ?>',
            data: 'id=' + id,
            success: function (data) {
                $('#liste_compte_balance').html(data);
            }
        });
    }
    function afficher() {
        $.ajax({
            url: '<?php echo url_for('annulation/afficherComptescomptablesdansbalance') ?>',
            data: 'compte_min=' + $('#compte_min').val() + '&compte_max=' + $('#compte_max').val(),
            success: function (data) {
                $('#liste_compte_balance').html(data);
            }
        });
    }
</script>

<style type="text/css">
    .header_table th{
        font-weight: bold;
        font-size: 13px;
    }
    .mws-table tbody tr.odd td.sorting_1 {
        background-color: #cccccc;
    }
    .mws-table tbody tr.even td.sorting_1 {
        background-color: #e1e1e1;
    }

</style>

<script  type="text/javascript">
    document.title = ("BMM - G. Compta. : U. Annulations des comptes comptables");
</script>