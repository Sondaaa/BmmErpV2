<div class="row">
    <div class="col-sm-6">
        <div class="widget-box">
            <div class="widget-header widget-header-flat">
                <h4 class="widget-title smaller">Journal comptable</h4>
            </div>

            <div class="widget-body">
                <div class="widget-main">
                    <form>
                        <table class="table table-bordered table-hover" style="margin-bottom: 0px;">
                            <tr>
                                <td style="width: 50%">
                                    <div class="mws-form-inline">
                                        <div class="mws-form-row">
                                            <label class="mws-form-label" style="width: 100%">Date de Création * :</label>
                                        </div>
                                    </div>
                                </td>
                                <td style="width: 50%">
                                    <div class="mws-form-inline">
                                        <div class="mws-form-row">
                                            <label class="mws-form-label" style="width: 100%">Code Comptable * :</label>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 50%">
                                    <div class="mws-form-inline">
                                        <div class="mws-form-row" style="width: 100%">
                                            <input id="date" type="date" value="<?php echo date('d/m/Y', strtotime($journal->getDate())) ?>" obligatoire="true">
                                        </div>
                                    </div>
                                </td>
                                <td style="width: 50%">
                                    <div class="mws-form-row">
                                        <input id="code_comptable" value="<?php echo $journal->getCode() ?>" type="text"  style="width: 85%" obligatoire="true">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <div class="mws-form-inline" style="width: 100%">
                                        <label class="mws-form-label">Intitulé * :</label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <div class="mws-form-row" style="width: 100%">
                                        <input id="intitule" value="<?php echo $journal->getLibelle() ?>"  class="large" type="text" style="width: 93%" obligatoire="true">
                                        <input id="journal_id" value="<?php echo $journal->getId() ?>"  type="hidden" >
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="widget-box">
            <div class="widget-header widget-header-flat">
                <h4 class="widget-title smaller">Paramètres</h4>
            </div>
            <div class="widget-body">
                <div class="widget-main">
                    <form>
                        <table class="table table-bordered table-hover" style="margin-bottom: 0px;">
                            <tr>
                                <td>
                                    <label>Type : </label>
                                    <select id="type_journal" style="width: 100%;">
                                        <option value="-1"></option>
                                        <?php foreach ($type_journals as $type_journal): ?>
                                            <option value="<?php echo $type_journal->getId() ?>" <?php if ($journal->getIdTypeJournal() == $type_journal->getId()) echo 'selected="true"'; ?>> <?php echo $type_journal->getLibelle(); ?> </option>
                                        <?php endforeach; ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Contre Partie : </label>
                                    <select id="contre_partie" style="width: 100%;">
                                        <option value="-1"></option>
                                        <?php foreach ($comptes as $compte): ?>
                                            <option value="<?php echo $compte->getId() ?>" <?php if ($journal->getIdComptecontrepartie() == $compte->getId()): ?>selected="true"<?php endif; ?>> <?php echo $compte->getNumerocompte() . ' - ' . $compte->getLibelle() ?> </option>
                                        <?php endforeach; ?>
                                    </select>
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-6">
        <div class="widget-box">
            <div class="widget-header widget-header-flat">
                <h4 class="widget-title smaller">Journal et numérotation</h4>
            </div>
            <div class="widget-body">
                <div class="widget-main">
                    <form>
                        <table class="table table-bordered table-hover" style="margin-bottom: 0px;">
                            <tr>
                                <td style="width: 50%; padding-top: 10px;">
                                    <div class="mws-form-row" >
                                        <label class="mws-form-label" style="width: 20%">DU * :</label>
                                        <input id="date_debut_cloture" value="<?php echo date('d/m/Y', strtotime($journal->getDatedebutcloture())); ?>" type="date">
                                    </div>
                                </td>
                                <td style="width: 50%; padding-top: 10px;" colspan="2">
                                    <div class="mws-form-row" >
                                        <label class="mws-form-label" style="width: 20%">AU * :</label>
                                        <input id="date_fin_cloture" value="<?php echo date('d/m/Y', strtotime($journal->getDatefincloture())); ?>" type="date">
                                    </div>
                                </td>
                            </tr>
                            <?php $numerotation = $journal->getNumerotation(); ?>
                            <tr>
                                <td rowspan="3" style="padding-top: 10px;">
                                    <label class="mws-form-label" style="width: 100%">Numérotation * :</label>
                                </td>
                                <td style="padding-top: 10px;">
                                    <input name="numerotation" type="radio" value="1" <?php if ($numerotation == 1) echo 'checked="true"'; ?> >
                                    <label>Annuel</label>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input id="check_mensuel" name="numerotation" type="radio" <?php if ($numerotation == 2) echo 'checked="true"'; ?>  value="2">
                                    <label>Mensuel</label>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input name="numerotation" type="radio" value="3" <?php if ($numerotation == 3) echo 'checked="true"'; ?> >
                                    <label>Journalier</label>
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-6">
        <div class="widget-box">
            <div class="widget-header widget-header-flat">
                <h4 class="widget-title smaller">Avancés</h4>
            </div>
            <div class="widget-body">
                <div class="widget-main">
                    <form>
                        <table class="table table-bordered table-hover" style="margin-bottom: 0px;">
                            <tr>
                                <td>
                                    <label>Dossier Comptable * : </label>
                                    <select id="dossier" disabled="disabled">
                                        <option value="-1"></option>
                                        <?php foreach ($dossiers as $dossier): ?>
                                            <option value="<?php echo $dossier->getId(); ?>" <?php if ($dossier->getId() == $journal->getIdDossier()) echo 'selected="true"' ?> ><?php echo $dossier->getCode() . ' - ' . $dossier->getRaisonsociale(); ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </td> 
                            </tr>
                            <tr>
                                <td style="width: 50%; padding-top: 30px;">
                                    <label>Comptes Comptables : <span id="nombre_compte"> <?php echo $journal->getSouscomptejournal()->count(); ?> </span></label>
                                </td>
                                <td style="width: 50%; padding-top: 30px; display:none;">
                                    <button class="btn btn-xs btn-primary" style="margin-right: 3%;" onclick="gererCompte()"> Gérer Comptes</button>
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-sm-12" style="display: none;">
    <div class="mws-panel-header">
        <span>Numérotation Série
            <a id="btn_generer" class="btn" style="margin-left: 3%; cursor:pointer;" onclick="genererNumerotation()"> Générer</a>
        </span>
    </div>
    <div class="mws-panel-body no-padding">
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>Préfix</th>
                    <th>Date Début</th>
                    <th>Date Fin</th>
                    <th>Numéro Début</th>
                    <th>Numéro Fin</th>
                    <th>Attendu</th>
                    <th>Bloqué</th>
                </tr>
            </thead>
            <tbody id="liste_generer">
                <?php foreach ($journal->getNumeroseriejournal() as $numserie): ?>
                    <tr>
                        <td style="text-align: center;"><?php echo $numserie->getPrefixe(); ?></td>
                        <td style="text-align: center;"><?php echo date('d/m/Y', strtotime($numserie->getDatedebut())); ?></td>
                        <td style="text-align: center;"><?php echo date('d/m/Y', strtotime($numserie->getDatefin())); ?></td>
                        <td style="text-align: center;"><?php echo sprintf("%03s", $numserie->getNumerodebut()); ?></td>
                        <td style="text-align: center;"><?php echo sprintf("%03s", $numserie->getNumerofin()); ?></td>
                        <td style="text-align: center;"><?php echo sprintf("%03s", $numserie->getAttendu()); ?></td>
                        <td style="text-align: center;">
                            <?php
                            $bloque = $numserie->getIsbloque();
                            if ($bloque == 1):
                                ?>
                                <img  src="/images/icon/cheked.png"  />
                            <?php else: ?>
                                <img   src="/images/icon/unchecked.png"  />
                                <input id="bloque_a" type="hidden" value="1" />
                            <?php endif; ?>
                            <input id="bloque_a" type="hidden" value="<?php echo $bloque; ?>" />
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>


<table class="table table-bordered table-hover">
    <tr>
        <td>
            <button class="btn btn-danger" style="float: right; margin-right: 3%;" onclick="fermer()"><i class="icol-cross"></i> Annuler</button>
            <button class="btn btn-primary" style="float: right; margin-right: 3%;" onclick="confirmerJournalEdit()"><i class="icol-add"></i> Modifier</button>
        </td>
    </tr>
</table>


<div class="bpopup ui-dialog" id="liste_compte_comptable" style="left: 30%; position: absolute; z-index: 9999; display: none; width:60%">
    <div class="ui-dialog-titlebar ui-widget-header ui-corner-all ui-helper-clearfix">
        <span id="ui-dialog-title-mws-jui-dialog" class="ui-dialog-title">Compte Comptable </span>

        <a class="ui-dialog-titlebar-close ui-corner-all" href="#" role="button">
            <span class="ui-icon ui-icon-closethick bClose">close</span>
        </a>
    </div>
    <div class="mws-form-inline" id="liste_compte" style=" width:90%; margin:5% "  >
        <?php include_partial('journal/list_comptes', array('comptes' => $comptes)); ?>
    </div>

    <div class="ui-dialog-buttonpane ui-widget-content ui-helper-clearfix" style="text-align: right">
        <!--<input class="mws-button green mws-i-24 i-check large" type="button" value="OK" onclick="annulerListCompte()" />-->
        <input class="mws-button black mws-i-24 i-cross large" type="button" value="Fermer" onclick="annulerListCompte()" />
    </div>
</div>

<div class="bpopup ui-dialog" id="journalexiste" style="left: 30%; position: absolute; z-index: 9999; display: none;">
    <div class="ui-dialog-titlebar ui-widget-header ui-corner-all ui-helper-clearfix">
        <span id="ui-dialog-title-mws-jui-dialog" class="ui-dialog-title">Existance Journal</span>
    </div>
    <div align="center" style="padding: 40px 0px;font-size: 20px; width:80%; margin-left: 10%">
        Code Comptable et/ou Intitulé existe déja dans ce dossier comptable 
        <br>
        voulez vous continuer ?
    </div>
    <div align="center" class="ui-dialog-buttonpane ui-widget-content ui-helper-clearfix" style="text-align: right;">
        <input class="mws-button green mws-i-24 i-check large" type="button" value="Oui" onclick="saveEditJournal()" />
        <input class="mws-button black mws-i-24 i-cross large" type="button" value="Non" onclick="annulerJournalConfirm()" />
    </div>
</div>

<div class="bpopup ui-dialog" id="journalexisteautre" style="left: 30%; position: absolute; z-index: 9999; display: none;">
    <div class="ui-dialog-titlebar ui-widget-header ui-corner-all ui-helper-clearfix">
        <span id="ui-dialog-title-mws-jui-dialog" class="ui-dialog-title">Existance Journal</span>
    </div>
    <div align="center" style="padding: 40px 0px;font-size: 20px; width:80%; margin-left: 10%">
        Code Comptable et/ou Intitulé existe déja dans un autre dossier comptable 
        <br>
        voulez vous continuer ?
    </div>
    <div align="center" class="ui-dialog-buttonpane ui-widget-content ui-helper-clearfix" style="text-align: right;">
        <input class="mws-button green mws-i-24 i-check large" type="button" value="Oui" onclick="saveEditJournal()" />
        <input class="mws-button black mws-i-24 i-cross large" type="button" value="Non" onclick="annulerJournalConfirmAutre()" />
    </div>
</div>

<script  type="text/javascript">

    $('#type_journal').chosen({allow_single_deselect: true});
    $('#contre_partie').chosen({allow_single_deselect: true});
    $('#dossier').chosen({allow_single_deselect: true});

    var numerotation = 2;
    $('input[type="radio"][name=numerotation]').change(function () {
        if ($(this).is(':checked')) {
            if ($(this).val() == '1') {
                $('#btn_generer').show();
                numerotation = 1;
            }
            if ($(this).val() == '2') {
                $('#btn_generer').show();
                numerotation = 2;
            }
            if ($(this).val() == '3') {
                $('#btn_generer').hide();
                numerotation = 3;
            }
            $('#liste_generer').html('');
            $('#listevide').html('<tr> <td style="text-align:center; font-weight: bold; font-size: 16px !important;" colspan="7">Pas de génération</td></tr>');
        }
    });

    $('.list_checbox_compte').change(function () {
        if ($(this).is(':checked')) {
            $('#nombre_compte').html($('.list_checbox_compte[type=checkbox]:checked').length);
        } else
            $('#nombre_compte').html($('.list_checbox_compte[type=checkbox]:checked').length);
    });

    function genererNumerotation() {
        $('#listevide').html('');
        if (champsObligatoiresGenerer()) {
            $.ajax({
                url: '<?php echo url_for('@genererNumerotation') ?>',
                data: 'numerotation=' + numerotation + '&date_debut=' + $('#date_debut_cloture').val() +
                        '&date_fin=' + $('#date_fin_cloture').val(),
                success: function (data) {
                    $('#liste_generer').html(data);
                }
            });
        } else {
            $('#listevide').html('<tr> <td style="text-align:center; font-weight: bold; font-size: 16px !important;" colspan="7">Pas de génération</td></tr>');
        }

    }

    function gererCompte() {
        $('.list_checbox_compte[type=checkbox]').each(function () {
<?php foreach ($journal->getSouscomptejournal() as $cj): ?>
                var compte = '<?php echo $cj->getId() ?>';
                if ($(this).val() == compte) {
                    $(this).attr('checked', 'checked');
                }
<?php endforeach; ?>
        });

        $('#liste_compte_comptable').bPopup();
        $('#myTable01').fixedHeaderTable({footer: true, altClass: 'odd', fixedColumns: 1});
        $('#selecte_all').change(function () {
            if ($(this).is(':checked')) {
                $('.list_checbox_compte').attr('checked', 'checked');
                $('#nombre_compte').html($('.list_checbox_compte[type=checkbox]:checked').length);
                if ($('.list_checbox_compte[type=checkbox]:checked').length == 0) {
                    $('#nombre_compte').html($('.list_checbox_compte[type=checkbox]:checked').length);
                }
            } else {
                $('.list_checbox_compte').removeAttr('checked');
                $('#nombre_compte').html($('.list_checbox_compte[type=checkbox]:checked').length);
            }
        });
    }

    function annulerListCompte() {
        $('#liste_compte_comptable').bPopup().close();
    }

    function confirmerJournalEdit() {
        if (champsObligatoires()) {
            $.ajax({
                url: '<?php echo url_for('journal/VerifierExistance') ?>',
                data: 'journal_id=' + $('#journal_id').val() + '&dossier=' + $('#dossier').val() +
                        '&code_comptable=' + $('#code_comptable').val() + '&intitule=' + $('#intitule').val(),
                success: function (data) {
                    if (data == '0') {
                        $('#journalexiste').bPopup();
                    }
                    if (data == '1') {
                        $('#journalexisteautre').bPopup();
                    }
                    if (data == '2') {
                        saveEditJournal();
                    }
                }
            });
        }
    }

    function annulerJournalConfirm() {
        $('#journalexiste').bPopup().close();
        $('#journalexiste').fadeOut();
    }

    function annulerJournalConfirmAutre() {
        $('#journalexisteautre').bPopup().close();
        $('#journalexisteautre').fadeOut();
    }

    function saveEditJournal() {
        if (champsObligatoires()) {
            var comptes = '';

            $('.list_checbox_compte[type=checkbox]:checked').each(function () {
                comptes += $(this).val() + ',';
            });
            var numserie = chargerlist_generer();

            $.ajax({
                url: '<?php echo url_for('@saveEditJournal') ?>',
                data: 'numerotation=' + numerotation +
                        '&id=' + $('#journal_id').val() +
                        '&date_debut_cloture=' + $('#date_debut_cloture').val() +
                        '&date_fin_cloture=' + $('#date_fin_cloture').val() +
                        '&date=' + $('#date').val() +
                        '&code_comptable=' + $('#code_comptable').val() +
                        '&intitule=' + $('#intitule').val() +
                        '&type_journal=' + $('#type_journal').val() +
                        '&contre_partie=' + $('#contre_par tie').val() +
                        '&integre=' + $('#integre').is(':checked') +
                        '&dossier=' + $('#dossier').val() +
                        '&numserie=' + numserie +
                        '&comptes=' + comptes,
                success: function (data) {
                    location.href = '<?php echo url_for('@listeJournalComptable') ?>';
                }
            });
        }
    }

    function chargerlist_generer() {
        var list_generer = "";
        if ($('#liste_generer tr').size() > 0) {
            $('#liste_generer tr').each(function () {
                list_generer += $(this).children('td:eq(6)').children('input:first').val() + ',';
            });
        }
        return list_generer;
    }

    function champsObligatoiresGenerer() {
        var valide = true;
        var date1 = $('#date_debut_cloture').val().split('/');
        var date2 = $('#date_fin_cloture').val().split('/');

        if (date1[2] == date2[2] && ((date1[1] + date1[0]) <= (date2[1] + date2[0]))) {

            $('#date_debut_cloture').css('border', '');
            $('#date_fin_cloture').css('border', '');
        } else {
            $('#date_debut_cloture').css('border', '3px solid red');
            $('#date_fin_cloture').css('border', '3px solid red');
            valide = false;
        }

        return valide;
    }

    function champsObligatoires() {
        var valide = true;
        $('input[type="text"][obligatoire=true]').each(function () {
            if ($(this).val() !== '')
                $(this).css('border', '');
            else {
                $(this).css('border', '3px solid red');
                valide = false;
            }
        });
        return valide;
    }

    function resetJournal() {
        $('#date').val('<?php echo date('d/m/Y'); ?>');
        $('#date_debut_cloture').val('<?php echo '01/01/' . date('Y'); ?>');
        $('#date_fin_cloture').val('<?php echo '31/12/' . date('Y'); ?>');
        $("#code_comptable").val('');
        $('#intitule').val('');
        $("#type_journal").select2("val", "");
        $("#contre_partie").select2("val", "");
        $('#integre').removeAttr('checked');
        $('#check_mensuel').attr('checked', 'true');
        $('#liste_generer').html('');
        $('#listevide').html('<tr><td style="text-align:center; font-weight: bold; font-size: 16px !important;" colspan="7">Pas de génération</td></tr>');
    }

    function fermer() {
        $('#zone_journal').html('');
    }

</script>