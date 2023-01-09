<div ng-controller="CtrlRessourcehumaine">
    <fieldset id="sf_fieldset_<?php echo preg_replace('/[^a-z0-9_]/', '_', strtolower($fieldset)) ?>">
        <?php if ('NONE' != $fieldset): ?>
            <h2><?php echo __($fieldset, array(), 'messages') ?></h2>
        <?php endif; ?>
        <center><legend><i>Attestation de travail</i></legend></center>
        <table style="width: 65%">
            <tr>
                <td colspan="3"> Le Directeur Général de l'Office de Développement de</td>
                <td><?php echo $form['id_lieu'] ?></td>
            </tr>
            <tr>
                <td colspan="3">Soussigné,atteste par la présente que :</td>
                <td><?php echo $form['id_agents'] ?></td>
            </tr>
            <tr>
                <td> né à</td>
                <td><input type="text" placeholder="Lieu de naissance" id="lieunaissance"></td>
                <td>le</td>
                <td><input type="text" placeholder="Date de naissance" id="datenaissnce"></td>
            </tr>
        </table>
        <table style="width: 65%">
            <tr>
                <td> fait partie du personnel de l’ODRM en </td> 
                <td><input type="text" placeholder="Corps" id="corps"></td>
                <td><input type="text" placeholder="Grade" id="grade"></td>
            </tr>
            <tr>
                <td>Cause d'obtenir Attestation</td>
                <td colspan="2"><?php echo $form['cause'] ?></td>
            </tr>
        </table>   
        <br>
        La présente attestation est délivrée sur sa demande pour servir et vouloir ce que de droit.
        <input type="hidden" id="idcontrat">
    </fieldset>        
</div>