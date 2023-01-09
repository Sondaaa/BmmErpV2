<div class="row">
    <div class="col-xs-12">
        <div class="clearfix">
            <div class="pull-right tableTools-container"></div>
        </div>
        <div class="table-header">
            Résultat de recherche
            <a target="_blanc" href="<?php echo url_for('mouvementbanciare/ImprimerJournalMouvementCaisse?date_debut=' . $date_debut . '&date_fin=' . $date_fin . '&id_banque=' . $id_banque . '&type=' . $type) ?>" class="btn btn-sm btn-success" style="float: right; padding: 5px 9px;">
                <i class="ace-icon fa fa-print bigger-110"></i>
                <span class="bigger-110 no-text-shadow">Imprimer</span>
            </a>
        </div>
        <div>
            <form>
                <div class="sf_admin_list">
                    <table id="list_mouvements" class="table table-bordered table-hover" cellspacing="0">
                        <thead>
                            <tr>
                                <th style="width: 15%">Code</th>
                                <th style="width: 25%">Nom de la caisse</th>
                                <th style="width: 20%">Date d'ouverture</th>
                                <th style="width: 20%">Mnt. global</th>
                                <th style="width: 20%">Action</th>
                            </tr>
                        </thead>
                        <tfoot></tfoot>
                        <tbody>
                            <?php foreach ($caisses as $caisse): ?>
                                <tr>
                                    <td><?php echo $caisse->getCodecb(); ?></td>
                                    <td style="text-align: left;"><?php echo $caisse->getLibelle(); ?></td>
                                    <td style="text-align: center;">
                                        
                                        <?php if($caisse->getDateouvert()) echo date('d/m/Y', strtotime($caisse->getDateouvert())); ?></td>
                                    <td style="text-align: center;">
                                        <?php echo $caisse->getMntouverture(); ?>   
                                    </td>
                                    <td>
<!--                                        <div class="btn-group" id="btnaction">
                                            <button data-toggle="dropdown" class="btn btn-primary btn-white dropdown-toggle">
                                                Action
                                                <i class="ace-icon fa fa-angle-down icon-on-right"></i>
                                            </button>
                                            <ul class="dropdown-menu" role="menu">
                                                 <li>-->
                                                    <a target="_blanc" class="btn btn-outline btn-success width-fixed"
                                                       href="<?php echo url_for('mouvementbanciare/suivisoldeCaisseParCaisse?id=' . $caisse->getId()) ?>">
                                                        <i class="ace-icon fa fa-credit-card bigger-110"></i>Suivi Solde Caisse</a>
<!--                                                </li>
                                            </ul>
                                        </div>-->
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </form>
        </div>
    </div>
</div>