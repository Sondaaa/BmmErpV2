<?php if ($field->isPartial()): ?>
    <?php include_partial('lignebanquecaisse/' . $name, array('type' => 'filter', 'form' => $form, 'attributes' => $attributes instanceof sfOutputEscaper ? $attributes->getRawValue() : $attributes)) ?>
<?php elseif ($field->isComponent()): ?>
    <?php include_component('lignebanquecaisse', $name, array('type' => 'filter', 'form' => $form, 'attributes' => $attributes instanceof sfOutputEscaper ? $attributes->getRawValue() : $attributes)) ?>
<?php else: ?>
    <tr class="<?php echo $class ?>">
        <td>
            <?php
            if ($name != "id_budget") {
                echo 'Caisse';
            }
            ?>            
        </td>
        <td>
            <?php echo $form[$name]->renderError() ?>
            <?php if ($name != "id_caissebanque" && $name != "id_budget") { ?>
                <?php echo $form[$name]->render($attributes instanceof sfOutputEscaper ? $attributes->getRawValue() : $attributes) ?>
                <?php
            } else {
                if ($name == "id_caissebanque") {
                    $caisses = Doctrine_Core::getTable('caissesbanques')->findByIdTypecb(1);
                    ?>
                    <select name="lignebanquecaisse_filters[<?php echo $name ?>]" id="id_caissebanque">                        
                        <option value="">Tout</option>
                        <?php foreach ($caisses as $c) { ?>
                            <option value="<?php echo $c->getId() ?>"
                            <?php
                            if ($id_caissebanque) {
                                if ($c->getId() == $id_caissebanque):
                                    ?>
                                            selected="true"<?php
                                        endif;
                                    }
                                    ?>><?php echo $c ?></option>
                                <?php } ?> 
                    </select>
                    <?php
                }
                if ($name == "id_budget") {
                    ?>
                    <fieldset ng-controller="CtrlFormEngagement">
                        <legend>Informations sur le Budget</legend>
                        <table style="margin-bottom: 0px;">
                            <tbody>
                                <tr>
                                    <td>
                                        <table style="margin-bottom: 0px;">
                                            <tr>
                                                <!--<th>Exercice</th>-->
                                                <th>Budget</th>
                                            </tr>
                                            <?php //  $date = $_SESSION['exercice_budget'];?>
                                            <tr>
                                                <!--<td><?php // echo $_SESSION['exercice_budget'];    ?></td>-->
                                                <td>
                                                    <?php
                                                    $ligne = new Ligprotitrub();
//                                                    $annees = $date; 
                                                    //$_SESSION['exercice_budget'];
//                                                    $budgets = Doctrine_Query::create()
//                                                                    ->select("*")
//                                                                    ->from('titrebudjet')
//                                                                    ->where("Etatbudget=2")
//                                                                    ->andwhere("trim(typebudget) not like trim('Prototype')  ")
//                                                                    ->andwhere("trim(typebudget) like trim('Exercice:" . $date . "')  ")
//                                                            //$_SESSION['exercice_budget'];
//                                                                    ->orderBy('id asc')->execute();
                                                    $budgets = Doctrine_Query::create()
                                                                    ->select("*")
                                                                    ->from('titrebudjet')
                                                                    ->where("Etatbudget=2")
                                                                    ->andwhere("trim(typebudget) not like trim('Prototype')  ")
                                                                    ->andWhere("trim(typebudget) not like trim('%Budget Pr??visionnel / Direction & Projet%') ")
                                                                    ->andWhere("trim(typebudget) not like trim('%Budget Pr??visionnel Global%') ")
//                                                                    ->andWhere("trim(typebudget) like trim('Exercice:" . $_SESSION['exercice_budget'] . "') ")
                                                                    ->orderBy('id asc')->execute();
                                                    ?>

                                                    <select id="budget_param_compte">
                                                        <option value="0">S??lectionnez</option>
                                                        <?php foreach ($budgets as $budget) { ?>
                                                            <option  value="<?php echo $budget->getId() ?>" <?php if ($ligne && $ligne->getIdTitre() == $budget->getId()) echo 'selected="selected"' ?> >
                                                                <?php echo $budget->getLibelle() ?>
                                                            </option>
                                                        <?php } ?>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2">
                                                    Rubriques
                                                    <input type="hidden" id="id_budget" name="lignebanquecaisse_filters[<?php echo $name ?>]" value="">
                                                    <select id="numeroengaement" name="numeroengaement">

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
                    <?php
                }
            }
            ?>
            <?php if ($help || $help = $form[$name]->renderHelp()): ?>
                <div class="help"><?php echo __($help, array(), 'messages') ?></div>
            <?php endif; ?>
        </td>
    </tr>
<?php endif; ?>