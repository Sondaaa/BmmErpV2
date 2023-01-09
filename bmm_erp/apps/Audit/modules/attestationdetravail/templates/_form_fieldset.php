<diV ng-controller="CtrlRessourcehumaine">
    <fieldset id="sf_fieldset_<?php echo preg_replace('/[^a-z0-9_]/', '_', strtolower($fieldset)) ?>">
        <?php if ('NONE' != $fieldset): ?>
            <h2><?php echo __($fieldset, array(), 'messages') ?></h2>
        <?php endif; ?>

        <center> <legend><i> Attestation de travail</i></legend></center>

        <table style="width: 60%"><tr>
                <td colspan="3">  Le Directeur Général  de  l'Office de Développement de
                </td>
                <td>     <?php echo $form['id_lieu'] ?>
                </td>
            </tr>
            <tr>
                <td colspan="3">
                    Soussigné,atteste par la présente que :
                </td>
                <td>
                    <span style="width: 150px;"><?php echo $form['id_agents'] ?></span>
                </td> </tr><tr>
                <td> né à</td>
                <td> <input data-width="fixed" type="text" placeholder="Lieu de naissance" id="lieunaissance">
                </td>   <td>le</td>
                <td>    <input data-width="fixed" type="text" placeholder="Date de naissance" id="datenaissnce" style="width: 350px">
                </td> </tr></table>
        <table style="width: 60%"><tr>
                <td> fait partie du personnel de l’ODRM 
                    en  
                </td> 
                <td>  <input data-width="fixed" type="text" placeholder="Corps" id="corps">
                </td>
                <td>   <input data-width="fixed" type="text" placeholder="Grade" id="grade">
                </td>
            </tr>
            <tr>
                <td>Causse d'obtenir Attestation</td>
                <td>    
                     <?php echo $form['cause'] ?>
                </td>
            </tr>
        </table>   
        <br>       La présente attestation est délivrée sur sa demande pour servir et vouloir ce que de droit.
        <input type="hidden" id="idcontrat">

    </fieldset>        
</diV>
<script  type="text/javascript">
    $('#attestationdetravail_id_lieu').attr('style', 'width: 150px;');
</script>