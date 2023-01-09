
<div class="col-lg-12 container" id="divsalaire"  >  

    <fieldset>
        <table>
            <tbody>
                <tr>
                    <td><label> Date d'ouverture</label></td>

                    <td> <?php date('d/m/Y', strtotime($salairedebase->getDate())); ?>
                        <?php //echo $form['dateouverture']->renderError() ?>
                        <?php //echo $form['dateouverture'] ?>
                    </td> 

                    <td><label> Date de fermeture</label></td>
                    <td>
                        <?php echo $form['datefermeture']->renderError() ?>
                        <?php echo $form['datefermeture'] ?>
                    </td> 
                </tr>
            </tbody>
        </table>
        <?php
        $corps = Doctrine_Core::getTable('corps')->findAll();
        $echelon = Doctrine_Core::getTable('echelon')->findAll();
        $echelle = Doctrine_Core::getTable('echelle')->findAll();
        ?>
        <?php
        foreach ($corps as $c):
            if ($c->getId() == 2) {
                ?>
                <legend><?php echo $c->getlibelle(); ?></legend>
                <!--<div style="overflow: auto; width: 100%;" ng-init="AfficheSalairedebsae()">-->
                <div id="table-scroll-1" class="table-scroll" style="margin-bottom: 10px;">
                    <div class="table-wrap" ng-init="AfficheSalairedebsae()">
                        <table id="fonctionnaire" class="main-table">

                            <thead>
                                <tr>
                                    <th class="fixed-side" scope="col">Categorie</th>
                                    <th class="fixed-side" scope="col">Echelle</th>
                                    <?php foreach ($echelon as $e): ?>
                                        <th><?php echo $e->getlibelle(); ?></th>
                                    <?php endforeach; ?>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <?php $test = 0; ?>
                                    <?php $categories = CategorieRHTable::getInstance()->findByCorpsOrderByLibelle($c->getId()); ?>
                                    <?php foreach ($categories as $cat): ?>
                                        <?php if ($test != 0): ?>
                                        <tr>
                                        <?php endif; ?>
                                        <td  class="fixed-side" scope="col" style="background: repeat-x #F2F2F2; background-image: linear-gradient(to bottom,#F8F8F8 0,#ECECEC 100%);" rowspan="<?php echo $echelle->count(); ?>">
                                            <?php echo $cat->getlibelle(); ?>
                                        </td>
                                        <?php $test_2 = 0; ?>
                                        <?php foreach ($echelle as $echel): ?>
                                            <?php if ($test_2 != 0): ?>
                                            <tr>
                                            <?php endif; ?>
                                            <td   class="fixed-side" scope="col" style="background: repeat-x #F2F2F2; background-image: linear-gradient(to bottom,#F8F8F8 0,#ECECEC 100%);" rowspan="1"><?php echo $echel->getlibelle(); ?></td>
                                            <?php foreach ($echelon as $e): ?>
                                                <td rowspan="1"style="padding: 3px;">
                                                    <input  style="width: 65px;" type="text" data="fonctionnaire" id="<?php echo $cat->getId() . '_' . $echel->getId() . '_' . $e->getId() ?>"></td>
                                            <?php endforeach; ?>
                                            <?php if ($test_2 != 0): ?>
                                            </tr>
                                        <?php endif; ?>
                                        <?php $test_2++; ?>
                                    <?php endforeach; ?>
                                    <?php if ($test != 0): ?>
                                        </tr>
                                    <?php endif; ?>
                                    <?php $test++; ?>
                                <?php endforeach; ?>
                                </tr>

                            </tbody>
                        <?php } ?> 
                    <?php endforeach; ?>
                </table>
            </div>
        </div>

        <?php
        foreach ($corps as $c):
            if ($c->getId() == 1) {
                ?>
                <legend ><?php echo $c->getlibelle(); ?></legend>

                <div id="table-scroll-2" class="table-scroll">
                    <div class="table-wrap">
                        <table id="ouvrier">

                            <thead>
                                <tr>
                                    <th class="fixed-side" scope="col">Categorie</th>
                                    <th class="fixed-side" scope="col">Grade</th>
                                    <th class="fixed-side" scope="col">Echelle</th>
                                    <?php foreach ($echelon as $e): ?>
                                        <th><?php echo $e->getlibelle(); ?></th>
                                    <?php endforeach; ?>
                                </tr>
                            </thead>
                            <?php foreach ($c->getSouscorps() as $sc): ?>

                                <?php foreach ($sc->getCategorierh() as $cat): ?>
                                    <tr>
                                        <td class="fixed-side" scope="col" style="background: repeat-x #F2F2F2; background-image: linear-gradient(to bottom,#F8F8F8 0,#ECECEC 100%);" rowspan="<?php echo $echelle->count() * $cat->getGrade()->count(); ?>"><?php echo $cat->getlibelle(); ?></td>
                                        <?php $test = 0; ?>
                                        <?php $grades = GradeTable::getInstance()->findByCategorieOrderByLibelle($cat->getId()); ?>
                                        <?php foreach ($grades as $grade): ?>
                                            <?php if ($test != 0): ?>
                                            <tr>
                                            <?php endif; ?>

                                            <td class="fixed-side" scope="col" style="background: repeat-x #F2F2F2; background-image: linear-gradient(to bottom,#F8F8F8 0,#ECECEC 100%);" rowspan="<?php echo $echelle->count(); ?>"><?php echo $grade->getlibelle(); ?></td>
                                            <?php $test_2 = 0; ?>
                                            <?php foreach ($echelle as $echel): ?>
                                                <?php if ($test_2 != 0): ?>
                                                <tr>
                                                <?php endif; ?>

                                                <td  class="fixed-side" scope="col" style="background: repeat-x #F2F2F2; background-image: linear-gradient(to bottom,#F8F8F8 0,#ECECEC 100%);" rowspan="1"><?php echo $echel->getlibelle(); ?></td>
                                                <?php $test_3 = 0; ?>
                                                <?php foreach ($echelon as $e): ?>
                                                    <?php if ($test_3 != 0): ?>
                                                    <tr>
                                                    <?php endif; ?>
                                                    <td rowspan="1"style="padding: 3px;">
                                                        <input type="text" style="width: 65px;"  data="ouvrier" id="<?php echo $cat->getId() . '_' . $grade->getId() . '_' . $echel->getId() . '_' . $e->getId() ?>"></td>
                                                <?php endforeach; ?>
                                                <?php if ($test_3 != 0): ?>
                                                </tr>
                                            <?php endif; ?>
                                            <?php $test_3++; ?>

                                            <?php if ($test_2 != 0): ?>
                                                </tr>
                                            <?php endif; ?>
                                            <?php $test_2++; ?>
                                        <?php endforeach; ?>

                                        <?php if ($test != 0): ?>
                                            </tr>
                                        <?php endif; ?>
                                        <?php $test ++; ?>
                                    <?php endforeach; ?>

                                <?php endforeach; ?>
                                </tr>

                            <?php endforeach; ?>  
                        <?php } ?>
                    </table>
                </div>
            </div>
        <?php endforeach; ?>

    </fieldset>
</div>
<style>

    .table-scroll {
        position:relative;
        max-width:100%;
        margin:auto;
        overflow:hidden;
        width: 100%;
        /*border:1px solid #fff;*/
    }
    .table-wrap {
        width:100%;
        overflow:auto;
    }
    .table-scroll table {
        width:100%;
        margin:auto;
        border-collapse:separate;
        border-spacing:0;
    }
    .table-scroll th, .table-scroll td {
        padding:5px 10px;
        /*border:1px solid #000;*/
        /*white-space:nowrap;*/
        vertical-align:top;
    }
    .clone {
        position:absolute;
        top:0;
        left:0;
        pointer-events:none;
    }
    .clone th, .clone td {
        visibility:hidden
    }
    .clone td, .clone th {
        border-color:transparent
    }
    .clone tbody th {
        visibility:visible;
    }
    .clone .fixed-side {
        visibility:visible;
        /*background-color: #fff;*/
        background: repeat-x #F2F2F2;
    }
    .clone thead, .clone tfoot{background:transparent;}

</style>

<script  type="text/javascript">

    // requires jquery library
    jQuery(document).ready(function () {
        jQuery("#fonctionnaire").clone(true).appendTo('#table-scroll-1').addClass('clone');
        jQuery("#ouvrier").clone(true).appendTo('#table-scroll-2').addClass('clone');
    });

</script>