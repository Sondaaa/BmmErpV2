<div id="sf_admin_container" ng-controller="myCtrlPaysVille">
    <h1 id="replacediv">Etat du Bilan - Exercice : <?php echo $_SESSION['exercice']; ?></h1>
</div>

<div class="row">
    <div class="col-sm-12">
        <div id="tabs">
            <ul>
                <li><a href="#parametre_actif">Etat Actif</a></li>
                <li><a href="#parametre_passif">Etat Capital Propre et Passif</a></li>
            </ul>

            <div id="parametre_actif" class="ui-tabs-panel ui-widget-content ui-corner-bottom ui-tabs-hide">
                <?php if ($_SESSION['dossier_id'] == 1): ?>                  

                    <?php include_partial("fiche_Bilan/parametre_actif_etat", array("parametre_actif" => $parametre_actif, "actif" => $actif)) ?>
                <?php else: ?>    
                    <?php include_partial("fiche_Bilan/parametre_actif_etat", array("parametre_actif" => $parametre_actif, "actif" => $actif)) ?>

                <?php endif; ?>
            </div>

            <div id="parametre_passif" class="ui-tabs-panel ui-widget-content ui-corner-bottom ui-tabs-hide">
                <?php if ($_SESSION['dossier_id'] == 1): ?>                  
                    <?php include_partial("fiche_Bilan/parametre_passif_etat", array("parametre_passif" => $parametre_passif, "passif" => $passif)) ?>
                <?php else: ?>
                    <?php include_partial("fiche_Bilan/passif_general_etat", array("parametre_passif" => $parametre_passif, "passif" => $passif)) ?>
                <?php endif; ?>
            </div>
        </div>
    </div><!-- ./col -->
</div>

<style type="text/css">
    .header_table th {
        font-weight: bold;
        font-size: 13px;
    }
    .tab_filter tbody td { 
        border-right-color: #ffffff !important;
        border-right-style: solid;
        border-right-width: 2px;
        padding: 5px ;
    }
</style>
