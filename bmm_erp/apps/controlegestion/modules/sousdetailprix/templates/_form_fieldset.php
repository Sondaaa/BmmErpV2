<fieldset id="sf_fieldset_<?php echo preg_replace('/[^a-z0-9_]/', '_', strtolower($fieldset)) ?>">
    <?php if ('NONE' != $fieldset): ?>
        <h2><?php echo __($fieldset, array(), 'messages') ?></h2>
    <?php endif; ?>

    <table>
        <tr>
            <th style="width: 80px">
                N° du prix
            </th>
            <th>DESIGNATION DES TRAVAUX</th>
            <th>UNITE</th>
            <th>QUANTITE</th>
            <th>Prix unitaire<br>
                HTVA</th>
            <th>Prix Total<br> 
                HTVA</th>
            
            <th>Action</th>
        </tr>
        <tr>
            <td><?php echo $form['nordre'] ?></td>
            <td><?php echo $form['designation'] ?></td>
            <td><?php echo $form['id_unite'] ?></td>
            <td><?php echo $form['quetiteant'] ?></td>
            <td><?php echo $form['prixunitaire'] ?></td>
            <td><?php echo $form['prixthtva'] ?></td>
          
            <td>+Ajouter</td>
        </tr>
    </table>
</fieldset>
