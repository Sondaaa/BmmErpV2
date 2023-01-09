<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form  action="<?php echo url_for('PCourrier/' . ($form->getObject()->isNew() ? 'create' : 'update') . (!$form->getObject()->isNew() ? '?id=' . $form->getObject()->getId() : '')) ?>" method="get" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
    <?php if (!$form->getObject()->isNew()): ?>
        <input type="hidden" name="sf_method" value="put" />
    <?php endif; ?>
        <input type="hidden" name="idcourrier" id="idcourrier" value="<?php echo $idcourrier ?>">
    <table>
        <tfoot>
            <tr>
                <td colspan="2">
                    
                    <?php if (!$form->getObject()->isNew()): ?>
                        &nbsp;<?php echo link_to('Supprimer', 'PCourrier/delete?id=' . $form->getObject()->getId(), array('method' => 'delete', 'confirm' => 'Êtes-vous sûr?')) ?>
                    <?php endif; ?>
                    <input type="submit" value="Mise à jour transfert" />
                </td>
            </tr>
        </tfoot>
        <tbody>

            <tr>
      
                <td>
                    <label>Date de Transfert </label>
                </td>
                <td>
                    <?php echo $form['datecreation']->renderError() ?>
                    <?php echo $form['datecreation'] ?>
                </td>
                <td>
                    <label>Max date de Réponse </label>
                </td>
                <td>
                    <?php echo $form['mdreponse']->renderError() ?>
                    <?php echo $form['mdreponse'] ?>
                </td>
            </tr>
             <tr>
                
                <td>
                    <label>Expéditeur </label>
                </td>
                <td>
                    <?php echo $form['id_exp']->renderError() ?>
                    <?php echo $form['id_exp'] ?>
                </td>
               
            </tr>
            <tr>
                <td>
                    <label>Réceptionneur </label>
                </td>
                <td>
                    <?php echo $form['id_rec']->renderError() ?>
                    <?php echo $form['id_rec'] ?>
                </td> 
            </tr>
             <tr>
                
                <td>
                    <label>Courrier </label>
                </td>
                <td>
                    <?php echo $form['id_courier']->renderError() ?>
                    <?php echo $form['id_courier'] ?>
                </td>
                <td>
                    <label>Action </label>
                </td>
                <td>
                    <?php echo $form['id_action']->renderError() ?>
                    <?php echo $form['id_action'] ?>
                </td>
            </tr>
            <tr>
                
               
                <td>
                    <label>Déscription ou Note de tarnsfert </label>
                </td>
                <td colspan="3">
                    <?php echo $form['description']->renderError() ?>
                    <?php echo $form['description'] ?>
                </td>
            </tr>
        </tbody>
    </table>
</form>

<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
    <thead>
        <tr>

            <th>Date Transfer</th>
            <th>Date Réponse</th>
            <th>Expédition</th>
            <th>Réception</th>
            <th>Action</th>


        </tr>
    </thead>
    <tbody>
        <?php
        $exp = new Parcourcourier();
        foreach ($parcourcouriers as $parcourcourier):
            $exp = $parcourcourier;
            ?>
            <tr>
                <td><?php echo $parcourcourier->getDatecreation() ?></td>
                <td><?php echo $parcourcourier->getMdreponse() ?></td>
                <td><?php echo $exp->getExpdest() ?></td>
                <td><?php echo $exp->getRecepteur() ?></td>
                <td><?php echo $exp->getActionparcour() ?></td>
                <td><a href="<?php echo url_for('PCourrier/show?id=' . $parcourcourier->getId()) ?>">Détail</a></td>

            </tr>
        <?php endforeach; ?>
    </tbody>
</table>




