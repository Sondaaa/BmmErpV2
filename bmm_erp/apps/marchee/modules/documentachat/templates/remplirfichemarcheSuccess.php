<div id="sf_admin_container">

    <h1>Bon de commande Interne MP N°:<?php echo $documentachat->getNumerodocachat() ?></h1>
    <?php
    $societe = Doctrine_Core::getTable('societe')->findOneById(1);
    ?>
    <div id="sf_admin_content">  


         <div class="panel-body">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs">
                <li class="active"><a href="#home" data-toggle="tab" aria-expanded="true">Détail </a>
                </li>
                <li class=""><a href="#profile" data-toggle="tab" aria-expanded="false">Fiche Marches</a>
                </li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div class="tab-pane fade active in" id="home">
                    <div style="margin-top: 10px;">
                    <object style="width: 100%;height: 900px;" data="<?php echo url_for('documentachat/Imprimerdocachat?iddoc=' . $documentachat->getId()) ?>" type="application/pdf">
                        <embed src="<?php echo url_for('documentachat/Imprimerdocachat?iddoc=' . $documentachat->getId()) ?>" type="application/pdf" />
                    </object>
                    </div>
                </div>
                <div class="tab-pane" id="profile" ng-controller="CtrlFichemarche">
                    
                    <fieldset>
                        <legend>Identification du responsable des marchés Publics</legend>
                        <table>
                            <tr>
                                <td><label>Acheteur Public </label></td>
                                <td><?php $form[''] ?></td>
                            </tr>
                        </table>
                    </fieldset>
                </div>
            </div>
        </div>


    </div>
</div>

