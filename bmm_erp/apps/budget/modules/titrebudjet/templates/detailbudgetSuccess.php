<div id="sf_admin_container">
    <h1 id="replacediv"> 
        Fiche Entête Budget  
    </h1>
    <div class="col-sm-12">
        <?php
        $html = str_replace('<h2>', '<h3>', html_entity_decode($titrebudjet->getHtmlBudget($sf_user->getAttribute('userB2m'))));
        $html = str_replace('</h2>', '</h3>', $html);
        $html = str_replace('<br><h3>', '<h3>', $html);
        ?>
        <?php //echo html_entity_decode($html); ?>
        <?php echo $html; ?>
        <fieldset style="margin-top: 20px;" class="col-md-6 pull-right">
            <legend>Action</legend>
            <a class="btn btn-white btn-primary" href="<?php echo url_for('Documents/Imprimerfichebudget?idfiche=') . $titrebudjet->getId() ?>" target="_blanc">Exporter PDF</a>
            <?php if (trim($titrebudjet->getTypebudget()) == "Prototype"): ?>
                <a class="btn btn-white btn-success" href="<?php echo url_for('titrebudjet/index?type=prototype') ?>">Retour à la Liste</a>
            <?php else: ?>
                <a class="btn btn-white btn-success" href="<?php echo url_for('@titrebudjet') ?>">Retour à la Liste</a>
            <?php endif; ?>
        </fieldset>
    </div>
</div>

<style>
    table{margin-bottom: 0px !important;}
    h3{margin-top: 0px !important; text-align: center; font-weight: bold;}
    h2{font-weight: bold; color: #5a985b;}
</style>