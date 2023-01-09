<div id="sf_admin_container">
    <h1 id="replacediv"> Base Comptable 
        <small>
            <i class="ace-icon fa fa-angle-double-right"></i>
            Modifier Maquette de Saisie
        </small>
    </h1>
</div>

<div id="form_maquette">
    <?php include_partial('maquette_saisie/formEdit', array('journals' => $journals, 'nature_pieces' => $nature_pieces, 'maquette' => $maquette, 'comptes' => $comptes)) ?>
</div>

<script  type="text/javascript">

    function validerMaquette() {
        if (verifierFormPiece()) {
            var nb_lignes = 0;
            var numero_compte = '';
            var ligne_contre = '';
            var ck_compte = '';
            var ck_compte_tiers = '';
             var ck_compte_retenue = '';
            var ck_montant = '';
            var ck_contre = '';
            var spec_compte = '';
            var spec_montant = '';
            var spec_contre = '';
            var ligne_montant_saisi = '';
            var ligne_montant = '';
            var ligne_numero_ligne = '';
            var ligne_taux = '';
            var type_montant = '';

            var valide = true;

            $('#liste_ligne tbody tr').each(function () {
                nb_lignes++;
                var i_ligne = $(this).attr('index_ligne');
                numero_compte = numero_compte + $('#ligne_compte_' + i_ligne).val() + ',,';
                ligne_contre = ligne_contre + $('#ligne_contre_' + i_ligne).val() + ',,';
                ck_compte = ck_compte + $('#ck_compte_' + i_ligne).is(':checked') + ',,';
                ck_compte_tiers = ck_compte_tiers + $('#ck_compte_tiers_' + i_ligne).is(':checked') + ',,';
                ck_compte_retenue = ck_compte_retenue + $('#ck_compte_retenue_' + i_ligne).is(':checked') + ',,';

                ck_montant = ck_montant + $('#ck_montant_' + i_ligne).is(':checked') + ',,';
                ck_contre = ck_contre + $('#ck_contre_' + i_ligne).is(':checked') + ',,';
                spec_compte = spec_compte + $('#specification_compte_' + i_ligne).val() + ',,';
                spec_montant = spec_montant + $('#specification_montant_' + i_ligne).val() + ',,';
                spec_contre = spec_contre + $('#specification_contre_' + i_ligne).val() + ',,';
                ligne_montant_saisi = ligne_montant_saisi + $('#montant_ligne_saisi_' + i_ligne).val() + ',,';
                ligne_montant = ligne_montant + $('#montant_ligne_' + i_ligne).val() + ',,';
                ligne_numero_ligne = ligne_numero_ligne + $('#numero_ligne_' + i_ligne).val() + ',,';
                ligne_taux = ligne_taux + $('#taux_' + i_ligne).val() + ',,';
                type_montant = type_montant + $('#type_montant_' + i_ligne).val() + ',,';

                if (!$('#ck_compte_tiers_' + i_ligne).is(':checked') || !$('#ck_compte_retenue_' + i_ligne).is(':checked')) {
                    if ($('#specification_compte_' + i_ligne).val() == '-1') {
                        valide = false;
                    } else {
                        if ($('#specification_compte_' + i_ligne).val() != 'sans' && $('#ligne_compte_' + i_ligne).val() == '-1') {
                            valide = false;
                        }
                    }
                }
//                if (!$('#ck_compte_retenue_' + i_ligne).is(':checked')) {
//                    if ($('#specification_compte_' + i_ligne).val() == '-1') {
//                        valide = false;
//                    } else {
//                        if ($('#specification_compte_' + i_ligne).val() != 'sans' && $('#ligne_compte_' + i_ligne).val() == '-1') {
//                            valide = false;
//                        }
//                    }
//                }
                if ($('#specification_montant_' + i_ligne).val() == 'saisimanuel' && $('#montant_ligne_saisi_' + i_ligne).val() == '')
                    valide = true;
                if ($('#ck_compte_retenue_' + i_ligne).is(':checked'))
                    valide = true;
                if ($('#specification_montant_' + i_ligne).val() == '-1') {
                    valide = false;
                } else {
                    if ($('#specification_montant_' + i_ligne).val() == 'fixe' && $('#montant_ligne_' + i_ligne).val() == '') {
                        valide = false;
                    }
                    if ($('#specification_montant_' + i_ligne).val() == 'copie' && $('#numero_ligne_' + i_ligne).val() == '') {
                        valide = false;
                    }
                    if ($('#specification_montant_' + i_ligne).val() == 'taux' && ($('#numero_ligne_' + i_ligne).val() == '' || $('#taux_' + i_ligne).val() == '')) {
                        valide = false;
                    }
                }
                if ($('#type_montant_' + i_ligne).val() == '-1') {
                    valide = false;
                }
                if ($('#specification_contre_' + i_ligne).val() == '-1') {
                    valide = false;
                } else {
                    if ($('#specification_contre_' + i_ligne).val() != 'sans' && $('#ligne_contre_' + i_ligne).val() == '-1') {
                        valide = false;
                    }
                }
            });

            if (nb_lignes != 0) {
                if (valide == true || valide == false) {
                    $.ajax({
                        url: '<?php echo url_for('maquette_saisie/validerModifierMaquette') ?>',
                        data: 'journal=' + $('#journal').val() +
                                '&nature_piece=' + $('#nature_piece').val() +
                                '&libelle=' + $('#libelle').val() +
                                '&code=' + $('#code_maquette').val() +
                                '&numero_compte=' + numero_compte +
                                '&ligne_contre=' + ligne_contre +
                                '&ck_compte=' + ck_compte +
                                '&ck_compte_tiers=' + ck_compte_tiers +
                                '&ck_compte_retenue=' + ck_compte_retenue +
                                '&ck_montant=' + ck_montant +
                                '&ck_contre=' + ck_contre +
                                '&spec_compte=' + spec_compte +
                                '&spec_montant=' + spec_montant +
                                '&spec_contre=' + spec_contre +
                                '&ligne_montant_saisi=' + ligne_montant_saisi +
                                '&ligne_montant=' + ligne_montant +
                                '&type_montant=' + type_montant +
                                '&ligne_numero_ligne=' + ligne_numero_ligne +
                                '&ligne_taux=' + ligne_taux +
                                '&maquette_id=' + $('#maquette_id').val(),
                        success: function (data) {
                            bootbox.dialog({
                                message: "Maquette de saisie modifiée avec succès !",
                                buttons:
                                        {
                                            "button":
                                                    {
                                                        "label": "Ok",
                                                        "className": "btn-sm"
                                                    }
                                        }
                            });
                        }
                    });
                } else {
                    bootbox.dialog({
                        message: "Ligne(s) non achevée(s), veuillez vérifier le(s) ligne(s) du maquette !",
                        buttons:
                                {
                                    "button":
                                            {
                                                "label": "Ok",
                                                "className": "btn-sm"
                                            }
                                }
                    });
                }
            } else {
                bootbox.dialog({
                    message: "Veuillez ajouter au moins un ligne !",
                    buttons:
                            {
                                "button":
                                        {
                                            "label": "Ok",
                                            "className": "btn-sm"
                                        }
                            }
                });
            }
        }
    }

    function verifierFormPiece() {
        var valide = true;
        if ($('#journal').val() != '-1')
            $('#s2id_journal').css('border', '');
        else {
            $('#s2id_journal').css('border', '3px solid red');
            $('#s2id_journal').css('border-radius', '6px');
            valide = false;
        }

        var valide = true;
        if ($('#nature_piece').val() != '-1')
            $('#s2id_nature_piece').css('border', '');
        else {
            $('#s2id_nature_piece').css('border', '3px solid red');
            $('#s2id_nature_piece').css('border-radius', '6px');
            valide = false;
        }

        if ($('#libelle').val() != '')
            $('#libelle').css('border', '');
        else {
            $('#libelle').css('border', '3px solid red');
            valide = false;
        }

        if ($('#code_maquette').val() != '')
            $('#code_maquette').css('border', '');
        else {
            $('#code_maquette').css('border', '3px solid red');
            valide = false;
        }

        return valide;
    }

</script>