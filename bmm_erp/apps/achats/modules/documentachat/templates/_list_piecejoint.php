<?php if (sizeof($pager) == 0): ?>
    <tr>
        <td style="text-align:center; font-weight: bold; font-size: 16px !important;" colspan="7">
            Liste des Pièces Joints
        </td>
    </tr>
<?php endif;?>
<?php $i = 1;?>
<?php foreach ($pager as $docs): ?>

    <tr>
        <td><?php
echo $docs->getDocumentachat()->getTypedoc()->getLibelle() . " N° : "
. $docs->getDocumentachat()->getNumero();
?></td>
        <td style="text-align: left;">
            <a type="button" target="_blanc"
             href="<?php echo '/uploads/scanner/' . $docs->getChemin() ?>"
            ><?php echo $docs->getChemin() ; ?></a>
        </td>
        
    </tr>

<?php endforeach;?>