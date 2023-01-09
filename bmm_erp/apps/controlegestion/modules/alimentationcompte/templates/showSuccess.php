<div id="sf_admin_container">
    <h1 id="replacediv"> Budget 
        <small>
            <i class="ace-icon fa fa-angle-double-right"></i>
            Alimentation Compte Bancaire/CCP
        </small>
    </h1>
</div>

<div class="widget-box">
    <div class="widget-header widget-header-blue widget-header-flat">
        <h4 class="widget-title lighter">Alimentation Compte Bancaire/CCP</h4>
    </div>

    <div class="widget-body">
        <div class="widget-main">
            <table style="margin-bottom: 20px;">
                <tbody>
                    <tr>
                        <td style="width: 25%;">
                            Date<br>
                            <input type="date" class="disabledbutton" value="<?php echo $alimentation->getDate() ?>" />
                        </td>
                        <td style="width: 50%;">
                            Banque / CCP
                            <input type="text" class="disabledbutton" value="<?php echo $alimentation->getCaissesbanques() ?>" />
                        </td>
                        <td style="width: 25%;">
                            Montant
                            <input type="text" class="disabledbutton" value="<?php echo $alimentation->getMontant() ?>" />
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="row">
                <a style="float: right; margin-right: 1%;" href="<?php echo url_for('@alimentationcompte'); ?>" class="btn btn-white btn-success">Retour à la Liste</a>
            </div>
        </div>
    </div>
</div>