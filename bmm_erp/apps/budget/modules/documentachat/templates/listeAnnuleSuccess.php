<div id="sf_admin_container">
    <h1>Liste des documents d'achat annulés</h1>

    <div id="sf_admin_content">  
        <fieldset>
            <table>
                <thead>
                    <tr>
                        <th>N°</th>
                        <th>Document</th>
                        <th>Date Création</th>
                        <th>Date Annulation</th>
                        <th>Motif d'annulation</th>
                        <th>Utilisateur</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php for($i = 0; $i < sizeof($docs); $i++): ?>
                        <tr>
                            <td style="text-align: center;"><?php echo $i + 1; ?></td>
                            <td><?php echo $docs[$i]['type'] . " N° : " . $docs[$i]['numero'] ?></td>
                            <td style="text-align: center;"><?php echo date('d/m/Y', strtotime($docs[$i]['datecreation'])); ?></td>
                            <td style="text-align: center;"><?php echo date('d/m/Y', strtotime($docs[$i]['dateannulation'])); ?></td>
                            <td><?php echo html_entity_decode($docs[$i]['motif']) ?></td>
                            <td><?php echo $docs[$i]['user'] ?></td>
                            <td style="text-align: center;">
                                <a type="button" href="<?php echo url_for('documentachat/showAnnule') . '?iddoc=' . $docs[$i]['id'] ?>" class="btn btn-xs btn-primary">Détails</a>
                            </td>
                        </tr>
                    <?php endfor; ?>
                </tbody>
            </table>
        </fieldset>
    </div>
</div>