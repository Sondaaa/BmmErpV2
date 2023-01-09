<div class="row">
    <div class="col-xs-12">
        <div class="widget-box">
            <div class="widget-header widget-header-flat">
                <h4 class="widget-title smaller">Entête Maquette</h4>
            </div>
            <div class="widget-body">
                <div class="widget-main">
                    <form>
                        <table style="margin-bottom: 0px;">
                            <tr>
                                <td style="width: 10%">Code :</td>
                                <td style="width: 30%;">Libellé :</td>
                                <td style="width: 20%;">Nature Pièce :</td>
                                <td style="width: 40%;">Journal Comptable :</td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="text" disabled="disabled" value="<?php echo trim($maquette->getCode()); ?>">
                                </td>
                                <td>
                                    <input type="text" disabled="disabled" value="<?php echo trim($maquette->getLibelle()); ?>">
                                </td>
                                <td>
                                    <input type="text" disabled="disabled" value="<?php echo trim($maquette->getNaturepiece()->getLibelle()); ?>">
                                </td>
                                <td>
                                    <input type="text" disabled="disabled" value="<?php echo trim($maquette->getJournalcomptable()->getLibelle()); ?>">
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
    <div class="col-xs-12">
        <div class="widget-box">
            <div class="widget-header widget-header-flat">
                <h4 class="widget-title smaller">Détails Maquette</h4>
            </div>
            <div class="widget-body">
                <div class="widget-main">
                    <form>
                        <div class="mws-panel-body no-padding">
                            <table id="liste_ligne_show" style="margin-bottom: 0px;">
                                <thead>
                                    <tr style="background: repeat-x #F2F2F2; background-image: linear-gradient(to bottom,#F8F8F8 0,#ECECEC 100%);">
                                        <th style="width: 3%; text-align: center;">N°</th>
                                        <th style="width: 44%;">Numéro du Compte</th>
                                        <th style="width: 13%; text-align: center;">Montant</th>
                                        <th style="width: 40%;">Contre Partie</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    <?php foreach ($maquette->getLignemaquette() as $ligne): ?>
                                        <tr id="ligne_<?php echo $i ?>" onclick="formatLigne(<?php echo $i ?>)" index_ligne="<?php echo $i ?>">
                                            <td name="col_number" style="text-align:center"><?php echo $i ?></td>
                                            <td>
                                                <div class="mws-form-row" style="text-align: center;">
                                                    <span style="float: left; font-weight: bold;">
                                                        <input disabled="disabled"<?php if ($ligne->getObligatoirecompte() == 1): ?> checked="checked" <?php endif; ?>type="checkbox"/> Obligatoire
                                                    </span>
                                                    <span style="float: right; font-weight: bold;">
                                                        <input disabled="disabled"<?php if ($ligne->getTiers() == 1): ?> checked="checked" <?php endif; ?>type="checkbox"/> Compte Comptable du Tiers
                                                    </span>
                                                    <?php if ($ligne->getTiers() != 1): ?>
                                                        <?php
                                                        $spécification_compte = '';
                                                        switch (trim($ligne->getSpecificationcompte())) {
                                                            case 'fixe':
                                                                $spécification_compte = 'Fixe';
                                                                break;
                                                            case 'modifiable':
                                                                $spécification_compte = 'Modifiable';
                                                                break;
                                                            case 'sans':
                                                                $spécification_compte = 'Sans Spécification';
                                                                break;

                                                            default:
                                                                $spécification_compte = 'Sans Spécification';
                                                                break;
                                                        }
                                                        ?>
                                                        <input type="text" disabled="disabled" value="<?php echo $spécification_compte; ?>">
                                                    <?php endif; ?>
                                                </div>
                                                <?php if ($ligne->getTiers() != 1): ?>
                                                    <?php if (trim($ligne->getSpecificationcompte()) != 'sans'): ?>
                                                        <div class="mws-form-row" style="text-align: center;">
                                                            <input type="text" disabled="disabled" value="<?php echo trim($ligne->getPlandossiercomptable()->getNumerocompte()) . ' - ' . trim($ligne->getPlandossiercomptable()->getLibelle()); ?>">
                                                        </div>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <div class="mws-form-row" style="text-align: center;">
                                                    <label class="mws-form-label" style="font-weight: bold;">
                                                        <?php if (trim($ligne->getType()) == 'debit'): ?>
                                                            Débit
                                                        <?php else: ?>
                                                            Crédit
                                                        <?php endif; ?>
                                                        <br>
                                                        <input disabled="disabled"<?php if ($ligne->getObligatoiremontant() == 1): ?> checked="checked" <?php endif; ?>type="checkbox"/> Obligatoire
                                                    </label>
                                                    <?php
                                                    $spécification_montant = '';
                                                    switch (trim($ligne->getSpecificationmontant())) {
                                                        case 'fixe':
                                                            $spécification_montant = 'Fixe';
                                                            break;
                                                        case 'copie':
                                                            $spécification_montant = 'Copie du Montant';
                                                            break;
                                                        case 'taux':
                                                            $spécification_montant = 'Montant * Taux';
                                                            break;

                                                        default:
                                                            $spécification_montant = 'Fixe';
                                                            break;
                                                    }
                                                    ?>
                                                    <input type="text" disabled="disabled" value="<?php echo $spécification_montant; ?>">
                                                </div>
                                                <?php if (trim($ligne->getSpecificationmontant()) == 'fixe'): ?>
                                                    <div class="mws-form-row" style="text-align: center;">
                                                        <input type="text" disabled="disabled" value="<?php echo $ligne->getMontant(); ?>">
                                                    </div>
                                                <?php endif; ?>
                                                <?php if (trim($ligne->getSpecificationmontant()) == 'copie'): ?>
                                                    <div class="mws-form-row" style="text-align: center;">
                                                        <input type="text" disabled="disabled" value="<?php echo $ligne->getNumerolignemontant(); ?>">
                                                    </div>
                                                <?php endif; ?>
                                                <?php if (trim($ligne->getSpecificationmontant()) == 'taux'): ?>
                                                    <div class="mws-form-row" style="text-align: center;">
                                                        <input type="text" disabled="disabled" value="<?php echo $ligne->getNumerolignemontant(); ?>">
                                                    </div>
                                                    <div class="mws-form-row" style="text-align: center;">
                                                        <input type="text" disabled="disabled" value="<?php echo $ligne->getTaux(); ?>">
                                                    </div>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <div class="mws-form-row" style="text-align: center;">
                                                    <span style="float: left; font-weight: bold;">
                                                        <input disabled="disabled"<?php if ($ligne->getObligatoirecontre() == 1): ?> checked="checked" <?php endif; ?>type="checkbox"/> Obligatoire
                                                    </span>
                                                    <?php
                                                    $spécification_contre = '';
                                                    switch (trim($ligne->getSpecificationcontre())) {
                                                        case 'fixe':
                                                            $spécification_contre = 'Fixe';
                                                            break;
                                                        case 'modifiable':
                                                            $spécification_contre = 'Modifiable';
                                                            break;
                                                        case 'sans':
                                                            $spécification_contre = 'Sans Spécification';
                                                            break;

                                                        default:
                                                            $spécification_contre = 'Sans Spécification';
                                                            break;
                                                    }
                                                    ?>
                                                    <input type="text" disabled="disabled" value="<?php echo $spécification_contre; ?>">
                                                </div>
                                                <?php if (trim($ligne->getSpecificationcontre()) != 'sans'): ?>
                                                    <div class="mws-form-row" style="text-align: center;">
                                                        <input type="text" disabled="disabled" value="<?php echo trim($ligne->getPlandossiercomptable_3()->getNumerocompte()) . ' - ' . trim($ligne->getPlandossiercomptable_3()->getLibelle()); ?>">
                                                    </div>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                        <?php $i++; ?>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xs-12" style="text-align: right; margin-top: 10px;">
        <a class="btn btn-primary" onclick="fermer()"><i class="ace-icon fa fa-undo"></i> Fermer</a>
    </div>
</div>

<script  type="text/javascript">

    $("#show_maquette table").addClass("table table-bordered table-hover");
    $('#show_maquette input:text').addClass("class", "input-sm");
    $('#show_maquette input:text').attr('style', 'width: 100%;');

    function fermer() {
        $('#show_maquette').fadeOut();
        $('#form_liste_piece').fadeIn();
    }

    function formatLigneShow(index) {
        $('#liste_ligne_show tbody tr').each(function () {
            $(this).css('background', '');
            $(this).css('border-bottom', '');
            $(this).css('border-top', '');
        });
        $('#ligne_show_' + index).css('background', 'repeat-x scroll left bottom #d8d6d6');
        $('#ligne_show_' + index).css('border-bottom', '1px solid #000000');
        $('#ligne_show_' + index).css('border-top', '1px solid #000000');
    }

</script>