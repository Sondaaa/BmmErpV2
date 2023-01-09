
<div class="col-lg-12" >
    <div id="" class="panel panel-green">
        <div id="replacediv" class="panel-heading">Nouveaux fiche scanner</div>



        <div id="sf_admin_header">
        </div>

        <div id="sf_admin_bar">


        </div>

        <div id="sf_admin_content" ng-controller="CtrlScan">
            <div class="row ">
                <div  class="col-md-8">
                    <div class="panel panel-default">

                        <!-- /.panel-heading -->
                        <div class="panel-body" id="imgmodel" style="height: 800px">

                        </div>
                        <!-- /.panel-body -->
                    </div>

                </div>
                <div class="col-md-4">


                    <div class="panel panel-default">

                        <!-- /.panel-heading -->
                        <div class="panel-body">

                           
                            <fieldset>
                                <legend>Attaché fiche scanner</legend>
                                <div class="col-lg-12">
                                <div class="content">
                                    <input type="button" value="SCAN NOUVEAUX DOCUMENT" ng-click="ScanDoc('<?php echo url_for('Scan/Lancerscan') ?>');"  class="btn btn-info">
                                </div>
                            </div>
                                <div class="col-lg-12  <?php if (isset($id)) echo 'disabledbutton' ?>" >

                                    <div class="content">
                                        <div class="form-group">

                                            <label class="radio-inline">
                                                <input ng-model="ch_coa" ng-click="CourrierArrive('courrier/Courriersarrive',<?php echo $sf_user->getAttribute('userB2m')->getId() ?>)" type="radio" name="optionsRadiosInline" id="optionsRadiosInline1" value="1" checked="">Courrier arrivée
                                            </label>
                                            <label class="radio-inline" >
                                                <input ng-model="ch_com" ng-click="CourrierDepart('courrier/Courriersdepart',<?php echo $sf_user->getAttribute('userB2m')->getId() ?>)" type="radio" name="optionsRadiosInline" id="optionsRadiosInline2" value="2">Courrier départ
                                            </label>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 <?php if (isset($id)) echo 'disabledbutton' ?>" >
                                    <label>Courrier Arrivé</label>
                                    <div class="content">
                                        <select id="sltca" ng-model="sltca" ng-change="Onselect()">
                                            <option ng-repeat="coar in CourriersArrives" value="{{coar.id}}" >{{coar.object}}</option>
                                        </select>
                                    </div>

                                </div>
                                <div class="col-lg-12 <?php if (isset($id)) echo 'disabledbutton' ?>">
                                    <label>Courrier Départ</label>
                                    <div class="content">
                                        <select id="sltcd" ng-model="sltcd" ng-change="Onselect()">
                                            <option ng-repeat="coar in CourriersDeparts" value="coar.id" >{{coar.object}}</option>
                                        </select>
                                    </div>
                                </div>
                            </fieldset>
                            <fieldset>
                                <legend>Courrier Sélectionez</legend>
                                   <div style="margin-top: 5%" class="col-lg-12 <?php if (isset($id)) echo 'disabledbutton' ?>">
                                       <label id="courrierselectionner"><?php if (isset($courrier)) {
    echo "Courrier:" ?>
                                    <span>Numéro:</span><?php echo $courrier->getTitre(); ?><br>
                                    <span>Date Création:</span><?php echo $courrier->getDatecreation(); ?><br>
                                    <span>Objet:</span><?php echo $courrier->getObject(); ?>
<?php } ?>
                                </label>

                            </div>
                            </fieldset>
                        
                            <div class="col-lg-12" style="margin-top: 5%">
                                <div class="content">
                                    <input ng-click="ValiderAttachement('courrier/Validerattachement',<?php if(isset($id)) echo $id; else echo "0" ?>)" type="button" value="VALIDER ATTACHEMENT" ng-click=""  class="btn btn-info">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div id="sf_admin_footer">
            </div>
        </div>

    </div>

</div>