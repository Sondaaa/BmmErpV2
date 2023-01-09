<fieldset id="sf_fieldset_<?php echo preg_replace('/[^a-z0-9_]/', '_', strtolower($fieldset)) ?>">
    <?php if ('NONE' != $fieldset) : ?>
        <h2><?php echo __($fieldset, array(), 'messages') ?></h2>
    <?php endif; ?>
</fieldset>

<div class="row">
    <div class="col-md-12" dir="rtl">

        <div class="col-md-4">
            <div class="col-xs-12">
                <label class="control-label"> آجال الإنجاز </label>
                <?php echo $form['nbre_jour']->renderError() ?>
                <?php echo $form['nbre_jour'] ?>
                <span class="help-block col-xs-12 col-sm-reset inline">
                    <?php echo $form['nbre_jour']->renderError() ?>
                </span>
            </div>
            <div class="col-xs-12">

                <label class="control-label"> طريقة الابرام </label>
                <?php echo $form['id_methode']->renderError() ?>
                <?php echo $form['id_methode'] ?>
                <span class="help-block col-xs-12 col-sm-reset inline">
                    <?php echo $form['id_methode']->renderError() ?>
                </span>

            </div>
            <div class="col-xs-12">

                <label class="control-label"> الإجراءات </label>
                <?php echo $form['id_procedure']->renderError() ?>
                <?php echo $form['id_procedure'] ?>
                <span class="help-block col-xs-12 col-sm-reset inline">
                    <?php echo $form['id_procedure']->renderError() ?>
                </span>
            </div>
            <div class="col-xs-12">

                <label class="control-label"> مصدر التمويل </label>
                <?php echo $form['id_sources']->renderError() ?>
                <?php echo $form['id_sources'] ?>
                <span class="help-block col-xs-12 col-sm-reset inline">
                    <?php echo $form['id_sources']->renderError() ?>
                </span>
            </div>
        </div>
        <div class="col-md-8">
        <label class="control-label"> السنة</label>
            <?php echo $form['id_exercice']->renderError() ?>
            <?php echo $form['id_exercice'] ?>
            <span class="help-block col-xs-12 col-sm-reset inline">
                <?php echo $form['id_exercice']->renderError() ?>
            </span>
            <label class="control-label">موضوع الصفقة</label>
            <?php echo $form['name']->renderError() ?>
            <?php echo $form['name'] ?>
            <span class="help-block col-xs-12 col-sm-reset inline">
                <?php echo $form['name']->renderError() ?>
            </span>
        </div>

        <div class="col-md-12">
            <br>
            <label> التاريخ تقديري
            </label>
            <hr>
            <table>

                <tr>
                    <td colspan="4">
                        <table>
                            <tr>
                                <td>
                                    <label class="control-label"> إعداد كراس الشروط</label>
                                    <?php echo $form['created_cahier']->renderError() ?>
                                    <?php echo $form['created_cahier'] ?>
                                    <span class="help-block col-xs-12 col-sm-reset inline">
                                        <?php echo $form['created_cahier']->renderError() ?>
                                    </span>
                                </td>
                                <td>
                                    <label class="control-label">الإعلان عن المنافسة</label>
                                    <?php echo $form['date_annonce']->renderError() ?>
                                    <?php echo $form['date_annonce'] ?>
                                    <span class="help-block col-xs-12 col-sm-reset inline">
                                        <?php echo $form['date_annonce']->renderError() ?>
                                    </span>
                                </td>
                                <td>
                                    <label class="control-label"> فتح العروض</label>
                                    <?php echo $form['date_overture']->renderError() ?>
                                    <?php echo $form['date_overture'] ?>
                                    <span class="help-block col-xs-12 col-sm-reset inline">
                                        <?php echo $form['date_overture']->renderError() ?>
                                    </span>
                                </td>
                                <td>
                                    <label class="control-label"> تعين لجنة الشراءات بالملف </label>
                                    <?php echo $form['date_nomination']->renderError() ?>
                                    <?php echo $form['date_nomination'] ?>
                                    <span class="help-block col-xs-12 col-sm-reset inline">
                                        <?php echo $form['date_nomination']->renderError() ?>
                                    </span>
                                </td>

                                <td>
                                    <label class="control-label"> إحالة الملف على لجنة الصفقات </label>
                                    <?php echo $form['date_transmission']->renderError() ?>
                                    <?php echo $form['date_transmission'] ?>
                                    <span class="help-block col-xs-12 col-sm-reset inline">
                                        <?php echo $form['date_transmission']->renderError() ?>
                                    </span>
                                </td>
                                <td>
                                    <label class="control-label"> الإجابة لجنة الصفقات </label>
                                    <?php echo $form['date_reponse']->renderError() ?>
                                    <?php echo $form['date_reponse'] ?>
                                    <span class="help-block col-xs-12 col-sm-reset inline">
                                        <?php echo $form['date_reponse']->renderError() ?>
                                    </span>
                                </td>
                                <td>
                                    <label class="control-label"> النشر نتائج المنافسة </label>
                                    <?php echo $form['date_edition']->renderError() ?>
                                    <?php echo $form['date_edition'] ?>
                                    <span class="help-block col-xs-12 col-sm-reset inline">
                                        <?php echo $form['date_edition']->renderError() ?>
                                    </span>
                                </td>
                                <td>
                                    <label class="control-label"> تبليغ الصفقة </label>
                                    <?php echo $form['date_notifier']->renderError() ?>
                                    <?php echo $form['date_notifier'] ?>
                                    <span class="help-block col-xs-12 col-sm-reset inline">
                                        <?php echo $form['date_notifier']->renderError() ?>
                                    </span>
                                </td>
                                <td>
                                    <label class="control-label"> بداية الإنجاز </label>
                                    <?php echo $form['date_commencement']->renderError() ?>
                                    <?php echo $form['date_commencement'] ?>
                                    <span class="help-block col-xs-12 col-sm-reset inline">
                                        <?php echo $form['date_commencement']->renderError() ?>
                                    </span>
                                </td>
                            </tr>
                          
                        </table>

                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>