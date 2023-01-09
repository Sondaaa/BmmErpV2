<tr style="border-bottom: 2px solid #ddd; border-top: 2px solid #ddd; background-color: #f9ffcf;" id="ligne_form_<?php echo $agent->getId(); ?>">
    <td style="width: 2%; text-align: center;">
        <a title="Ajouter agent" style="cursor: pointer; margin-left: 0px;" class="ui-pg-div ui-inline-save" onclick="saveAgent('<?php echo $agent->getId(); ?>')">
            <i class="ace-icon fa fa-check bigger-130 success"></i>
        </a>
        <a title="Annuler" style="cursor: pointer; margin-left: 0px;" class="ui-pg-div ui-inline-cancel" onclick="resetLigne('<?php echo $agent->getId(); ?>')">
            <i style="margin-top: 5px;" class="ace-icon fa fa-remove bigger-130 danger"></i>
        </a>
    </td>
    <td class="sf_admin_list_td_idrh" style="width: 5%;"><input id="form_idrh" maxlength="8" type="text" value="<?php echo trim($agent->getIdrh()); ?>" class="align-center" class="width:100%;" /></td>
    <td class="sf_admin_list_td_cin" style="width: 8%;"><input id="form_cin" maxlength="8" type="text" value="<?php echo trim($agent->getCin()); ?>" class="align-center" class="width:100%;" /></td>
    <td class="sf_admin_list_td_nomcomplet" style="width: 11%;"><input id="form_nom" type="text" value="<?php echo trim($agent->getNomcomplet()); ?>" class="width:100%;" /></td>
    <td class="sf_admin_list_td_prenom" style="width: 11%;"><input id="form_prenom" type="text" value="<?php echo trim($agent->getPrenom()); ?>" class="width:100%;" /></td>
    <td class="sf_admin_list_td_date_naissance" style="width: 8%;"><input id="form_date_naissance" type="date" value="<?php echo $agent->getDatenaissance(); ?>" class="width:100%;" /></td>
    <td class="sf_admin_list_td_lieu_naissance" style="width: 11%;">
        <?php $lieux = GouverneraTable::getInstance()->findAll(); ?>
        <select id="form_lieu_naissance">
            <option value="0"></option>
            <?php foreach ($lieux as $lieu): ?>
            <option value="<?php echo $lieu->getId() ?>" <?php if ($agent->getLieun() == $lieu->getId()): ?>selected="true"<?php endif; ?>><?php echo $lieu->getGouvernera(); ?></option>
            <?php endforeach; ?>
        </select>
    </td>
    <td class="sf_admin_list_td_sexe" style="width: 8%;">
        <?php $sexes = SexeTable::getInstance()->findAll(); ?>
        <select id="form_sexe">
            <option value="0"></option>
            <?php foreach ($sexes as $sexe): ?>
                <option value="<?php echo $sexe->getId() ?>" <?php if ($agent->getSexe()->getId() == $sexe->getId()): ?>selected="true"<?php endif; ?>><?php echo $sexe; ?></option>
            <?php endforeach; ?>
        </select>
    </td>
    <td class="sf_admin_list_td_regroupementagents" style="width: 7%;">
        <?php $regroupements = RegroupementagentsTable::getInstance()->findAll(); ?>
        <select id="form_regroupement">
            <option value="0"></option>
            <?php foreach ($regroupements as $regroupement): ?>
                <option value="<?php echo $regroupement->getId() ?>" <?php if ($agent->getIdRegrouppement() == $regroupement->getId()): ?>selected="true"<?php endif; ?>><?php echo $regroupement; ?></option>
            <?php endforeach; ?>
        </select>
    </td>
    <td class="sf_admin_list_td_adresse" style="width: 10%;"></td>
    <td class="sf_admin_list_td_situation" style="width: 9%;">
        <?php $situations = EtatcivilTable::getInstance()->findAll(); ?>
        <select id="form_situation">
            <option value="0"></option>
            <?php foreach ($situations as $situation): ?>
                <option value="<?php echo $situation->getId() ?>" <?php if ($agent->getEtatcivil()->getId() == $situation->getId()): ?>selected="true"<?php endif; ?>><?php echo $situation; ?></option>
            <?php endforeach; ?>
        </select>
    </td>
</tr>