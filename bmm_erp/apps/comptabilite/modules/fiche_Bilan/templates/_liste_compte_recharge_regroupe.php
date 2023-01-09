
            <?php foreach ($comptes as $i => $compte): ?>
                <?php
                $checked = true;
                $regr='';
                if ($parametre_id != '') {
                    $Parametrebilancompte = ParametrebilancompteTable::getInstance()->findByIdCompteAndIdParametrebilan($compte->getId(), $parametre_id)->getFirst();
                    if ($Parametrebilancompte) {
                        if ($Parametrebilancompte->getType() == 0)
                            $checked = false;
                        if($Parametrebilancompte->getRegrouppement()&& $Parametrebilancompte->getRegrouppement()!='')
                            $regr=$Parametrebilancompte->getRegrouppement();
                    }else {
                        $checked = false;
                    }
                }
                ?>
                <tr id="tr_<?php echo $i; ?>" class="ligne_compte">
                    <td style="width: 5%; text-align: center;"> <input <?php if ($checked): ?>checked="checked"<?php endif; ?> id="check_input_<?php echo $compte->getId(); ?>" class="list_checbox_compte" value="<?php echo $compte->getId(); ?>" type="checkbox" idientifiant="<?php echo $compte->getId() ?>" onclick="addId()"/> </td>
                    <td style="width: 10%;"><b><?php echo $compte->getNumerocompte(); ?></b>
                        <input type="hidden" name="compte_dossier" value="<?php echo $compte->getId(); ?>"/>
                    </td>
                    <td style="width: 40%;"><?php echo $compte->getLibelle(); ?></td>
                    <td style="width: 20%;">
                        <input type="text" value="<?php echo $regr ?>" name="regrouppement" id="regrouppement_<?php echo $compte->getId(); ?>">
                    </td>
                    <td style="width: 20%;"><?php echo $compte->getPlancomptable()->getClassecompte()->getLibelle(); ?></td>
                    <td style="width: 5%; text-align: center;">
                        <button onclick="deleteCompte('<?php echo $i; ?>')" class="btn btn-xs btn-danger"><i class="ace-icon fa fa-close"></i></button></td>
                </tr>
            <?php endforeach; ?>
       