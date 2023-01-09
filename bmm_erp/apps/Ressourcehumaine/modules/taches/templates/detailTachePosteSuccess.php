
<div id="sf_admin_container">
    <h1 id="replacediv"> 
        Fiche Entête Tache  
    </h1>
    <div class="col-sm-12" >
        <?php
//        echo html_entity_decode($taches->getHtmlTaches());
        ?>
        <fieldset>
            <legend>Action</legend>
             <a class="btn btn-white btn-default" href="<?php echo url_for('sfTCPDF/Imprimerfichetachet?idfiche=') . $taches->getId() ?>"    target="_blanc">Exporter PDF</a>
        </fieldset>
    </div>

</div>

