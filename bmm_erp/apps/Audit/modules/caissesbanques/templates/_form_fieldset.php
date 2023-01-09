<fieldset id="sf_fieldset_<?php echo preg_replace('/[^a-z0-9_]/', '_', strtolower($fieldset)) ?>">
    <?php if ('NONE' != $fieldset): ?>
        <h2><?php echo __($fieldset, array(), 'messages') ?></h2>
    <?php endif; ?>
    <div class="col-lg-12">
        <table class="table table-bordered table-hover" style="margin-bottom: 0px;">
            <thead>
                <tr>
                    <th style="width: 20%"></th>
                    <th style="width: 30%"><h3>Fiche Caisse</h3></th>
            <th style="width: 30%"><h3 style="float: right">الخزينة</h3></th>
            <th style="width: 20%"></th>
            </tr>
            </thead>
            <tbody>
                <tr>
                    <td><h4>Date d'ouverture</h4></td>
                    <td colspan="2">
                        <?php echo $form['dateouvert']->renderError() ?>
                        <?php echo $form['dateouvert']->render(array('placeholder' => "Nom de la caisse...!!!")) ?>
                    </td>
                    <td><h4 style="float: right">تاريخ فتح الخزينة</h4></td>
                </tr>
                <tr>
                    <td><h4>Nom caisse</h4></td>
                    <td colspan="2">
                        <?php echo $form['libelle']->renderError() ?>
                        <?php echo $form['libelle']->render(array('placeholder' => "Nom de la caisse...!!!")) ?>
                    </td>
                    <td><h4 style="float: right">اسم الخزينة</h4></td>
                </tr>
                <tr>
                    <td><h4>Code caisse</h4></td>
                    <td colspan="2">
                        <?php echo $form['codecb']->renderError() ?>
                        <?php echo $form['codecb']->render(array('placeholder' => "Code de la caisse...!!!")) ?>
                    </td>
                    <td><h4 style="float: right">رقم الخزينة</h4></td>
                </tr>
                <tr>
                    <td><h4>Référence caisse</h4></td>
                    <td colspan="2">
                        <?php echo $form['referencecb']->renderError() ?>
                        <?php echo $form['referencecb']->render(array('placeholder' => "Référence de la caisse...!!!")) ?>
                    </td>
                    <td><h4 style="float: right">رمز الخزينة</h4></td>
                </tr>
                <tr>
                    <td><h4>Montant</h4></td>
                    <td colspan="2">
                        <input onchange="setMontants()" type="text" name="caissesbanques[mntouverture]" placeholder="Montant global de la caisse...!!!" id="caissesbanques_mntouverture">
                    </td>
                    <td><h4 style="float: right">المبلغ </h4></td>
                </tr>
                <tr>
                    <td><h4>Description</h4></td>
                    <td colspan="2">
                        <?php echo $form['description']->renderError() ?>
                        <?php echo $form['description']->render(array('placeholder' => "Description...!!!")) ?>
                    </td>
                    <td><h4 style="float: right">ملاحظات</h4></td>
                </tr>
            </tbody>
        </table>
    </div>
</fieldset>