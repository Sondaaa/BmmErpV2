
<?php $caissepiecemonnaie=CaiseepiecemonnaieTable::getInstance()->findByIdMouvement($id_mvt);?>
<div id="sf_admin_container" ng-controller="CtrlCaisse" >
    <input type="hidden" id="id_user" value="<?php echo $sf_user->getAttribute('userB2m')->getId() ?>">

    <h1 id="replacediv"> 
       Détail Du Mouvement 
    </h1>
    <div class="panel-body">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs">
               <li class="active"  ><a href="#detail" data-toggle="tab" aria-expanded="false">
                Fiche Détail </a></li>
        </ul>
        <div class="tab-content">
            
            <div class="tab-pane  active in"  id="detail" >
               
                <fieldset>
                    <legend>Mouvement </legend>
                    <table><tr><td>Nom Opération:</td><td><?php $mvt->getNomoperation()?></td></tr>
                    <tr><td>Date Opération:</td><td><?php $mvt->getDateoperation()?></td></tr>
                    <tr><td>Montant</td><td>
                  <?php if($mvt->getCredit()){?> Credit <?php } ?> 
                    <?php if($mvt->getDebit()){?>Debit<?php } ?> :
                        <?php if($mvt->getCredit()){?> <?php echo number_format($mvt->getCredit(),3,'.',' ');?> <?php } ?> 
                    <?php if($mvt->getDebit()){?> <?php echo number_format($mvt->getDebit(),3,'.',' ')?> <?php } ?>
                    </td> </tr>
                    </table>
                  <table>
                    <thead>
                        <th>Piece</th>
                        <th>Quantité</th>
                    </thead>
                    <tbody>
                        <?php foreach($caissepiecemonnaie as $piece):?>
                        <tr>
                            <td><?php echo  $piece->getPiecemonnaie()->getValeur();?></td>
                            <td><?php echo $piece->getQte();?></td>
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                  </table>
                </fieldset>
            </div>


        </div>
    </div>
</div>

<script>
    function printDiv()
    {
        var divToPrint = document.getElementById('engagement');
        var newWin = window.open('', 'Print-Window');
        newWin.document.open();
        newWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</body></html>');
        newWin.document.close();
        setTimeout(function () {
            newWin.close();
        }, 10);
    }

</script>