<fieldset id="sf_fieldset_<?php echo preg_replace('/[^a-z0-9_]/', '_', strtolower($fieldset)) ?>">
    <?php if ('NONE' != $fieldset): ?>
        <h2><?php echo __($fieldset, array(), 'messages') ?></h2>
    <?php endif; ?>
    <div class="col-lg-12">
        <table class="table table-bordered table-hover" style="margin-bottom: 0px;">
            <thead>
                <tr>
                    <th style="width: 20%"></th>
                    <th style="width: 30%"><h3> Fiche D'identité bancaire</h3></th>
            <th style="width: 30%"><h3 style="float: right">كشف الهوية البنكية</h3></th>
            <th style="width: 20%"></th>
            </tr>
            </thead>
            <tbody>
                <tr>
                    <td><h4>Date d'ouverture du compte</h4></td>
                    <td colspan="2">
                        <?php echo $form['dateouvert']->renderError() ?>
                        <?php echo $form['dateouvert'] ?>
                    </td>
                    <td><h4 style="float: right">تاريخ فتح الحساب</h4></td>
                </tr>
                <tr>
                    <td><h4>Nom du compte</h4></td>
                    <td colspan="2">
                        <?php echo $form['libelle']->renderError() ?>
                        <?php echo $form['libelle']->render(array('placeholder' => "CCP ou STB A.Comp SS...!!!")) ?>
                    </td>
                    <td><h4 style="float: right">اسم الحساب</h4></td>
                </tr>
                <tr>
                    <td><h4>Nature du compte</h4></td>
                    <td colspan="2">
                        <?php echo $form['id_nature']->renderError() ?>
                        <?php echo $form['id_nature'] ?>
                    </td>
                    <td><h4 style="float: right">طبيعة الحساب</h4></td>
                </tr>
                <tr>
                    <td><h4>Identifiant bancaire</h4></td>
                    <td colspan="2">
                        <?php echo $form['codecb']->renderError() ?>
                        <?php echo $form['codecb']->render(array('placeholder' => "188526......")) ?>
                    </td>
                    <td><h4 style="float: right">المعرف البنكي</h4></td>
                </tr>
                <tr>
                    <td><h4>RIB</h4></td>
                    <td colspan="2">
                        <?php echo $form['rib']->renderError() ?>
                        <?php echo $form['rib'] ?>
                    </td>
                    <td><h4 style="float: right">كشف الهوية البنكية</h4></td>
                </tr>
                <tr>
                    <td><h4>IBAN</h4></td>
                    <td colspan="2">
                        <?php echo $form['iban']->renderError() ?>
                        <?php echo $form['iban'] ?>
                    </td>
                    <td><h4 style="float: right">رقم الحساب المصرفي البنكي</h4></td>
                </tr>
                <tr>
                    <td><h4>Code BIC</h4></td>
                    <td colspan="2">
                        <?php echo $form['codebic']->renderError() ?>
                        <?php echo $form['codebic'] ?>
                    </td>
                    <td><h4 style="float: right">رمز السويفت</h4></td>
                </tr>
            </tbody>
        </table>
    </div>
</fieldset>