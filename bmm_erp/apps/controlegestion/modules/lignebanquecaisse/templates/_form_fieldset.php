<fieldset id="sf_fieldset_<?php echo preg_replace('/[^a-z0-9_]/', '_', strtolower($fieldset)) ?>">
    <?php if ('NONE' != $fieldset): ?>
        <h2><?php echo __($fieldset, array(), 'messages') ?></h2>
    <?php endif; ?>

    <div class="col-lg-10">
        <table>
            <tr>
                <td>
                    <?php
                     echo $form['id_caissebanque']->render();
                    echo $form['id_caissebanque']->render();
//                    echo $form['id_caissebanque']->renderError();
//                    $banques = Doctrine_Core::getTable('caissesbanques')->findByIdTypecb(2);
//                    ?>
                    <!--Banque-->
<!--                    <select name="id_caissebanque">
                        <option value="0"></option>
                        <?php // foreach ($banques as $bn) { ?>
                            <option value="//<?php // echo $bn->getId() ?>"><?php // echo $bn ?></option>
                        <?php // } ?> 
                    </select>-->
                </td>
            </tr>
            <tr>
                <td>
                    <fieldset ng-controller="CtrlFormEngagement">
                        <legend>Informations sur le Budget</legend>
                        <table>
                            <tbody>
                                <tr>
                                    <td>
                                        <table>
                                            <tr>
                                                <th>Exercice</th>
                                                <th>Budget</th>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <?php
                                                    $date = date('Y');
                                                    echo $date;
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    $ligne = new Ligprotitrub();
                                                    $annees = date('Y');
                                                    $budgets = Doctrine_Query::create()
                                                                    ->select("*")
                                                                    ->from('titrebudjet')
                                                                    ->where("Etatbudget=2")
                                                                    ->andWhere("trim(typebudget) not like trim('Prototype') ")
                                                                    ->orWhere("trim(typebudget) like trim('Exercice:" . 2018 . "') ")
                                                                    ->orderBy('id asc')->execute();
                                                    //Doctrine_Core::getTable('titrebudjet')->findByEtatbudget(2);
                                                    ?>
                                                    <select id="budget">
                                                        <option value="0">Sélectionnez</option>
                                                        <?php foreach ($budgets as $budget) { ?>
                                                            <option value="<?php echo $budget->getId() ?>" <?php if ($ligne && $ligne->getIdTitre() == $budget->getId()) echo 'selected="selected"' ?> >
                                                                <?php echo $budget->getLibelle() ?>
                                                            </option>
                                                        <?php } ?>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2">
                                                    N°D'engagement
                                                    <select id="numeroengaement" name="id_budget">

                                                    </select>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr class="disabledbutton">
                                    <td>
                                        <label>Rubrique</label>
                                        <input type="text" class="form-control" id="rubrique" value="<?php if ($ligne && $ligne->getIdTitre()) echo $ligne->getRubrique() ?>">
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </fieldset>   
                </td>
            </tr>
        </table>
    </div>
</fieldset>