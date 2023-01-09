<table style="margin-bottom: 0px;">
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
                            <input disabled="disabled"<?php if ($ligne->getCompteretenue() == 1): ?> checked="checked" <?php endif; ?>type="checkbox"/> Compte comptable Contre Partie
                        </span>
                        <span style="float: right; font-weight: bold;">
                            <input disabled="disabled"<?php if ($ligne->getTiers() == 1): ?> checked="checked" <?php endif; ?>type="checkbox"/> Compte Comptable du Tiers
                        </span>
                        <?php if ($ligne->getTiers() != 1 && $ligne->getCompteretenue() != 1): ?>
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
                    <?php if ($ligne->getTiers() != 1 && $ligne->getCompteretenue() != 1): ?>
                        <?php if (trim($ligne->getSpecificationcompte()) != 'sans'): ?>
                            <div class="mws-form-row" style="text-align: center;">
                                <input type="text" disabled="disabled" value="<?php echo trim($ligne->getPlancomptable()->getPlandossiercomptable()->getLast()->getNumerocompte()) . ' - ' . trim($ligne->getPlancomptable()->getPlandossiercomptable()->getLast()->getLibelle()); ?>">
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
                                                      <?php  if($ligne->getIdContrepartie() != '' && $ligne->getIdComptecomptable() != null)
                                                            {  $contrepartie= PlancomptableTable::getInstance()->findOneById($ligne->getIdContrepartie());
                                                         
                                                            $numero_contrepartie=$contrepartie->getNumerocompte();
                                                            $libelle_contrepartie=$contrepartie->getPlandossiercomptable()->getLast()->getLibelle();
                                                            ?>
                                                        <input type="text" disabled="disabled" 
                                                            value="<?php  echo trim($numero_contrepartie) .' - '.$libelle_contrepartie ;}?>">
                                                    </div>
                    <?php endif; ?>
                </td>
            </tr>
            <?php $i++; ?>
        <?php endforeach; ?>
    </tbody>
</table>

<div class="col-xs-12">
    <button class="btn btn-xs btn-primary" type="button" style="float: right; margin-top: 10px;" onclick="FermerDetailsMaquette()">
        <i class="ace-icon fa fa-close bigger-110"></i>
        Fermer
    </button>
</div>