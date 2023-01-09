<span class="titre_chèque_modal">Détruire chèque N° </span><span class="titre_chèque_modal"><?php echo $cheque->getRefpapier() ?></span> ?
<?php $mvt = $cheque->getMouvementbanciare()->getFirst(); ?>
<br>
<div style="margin-left: 10%;width: 80%;padding: 15px;font-size: 14px;line-height: 25px;text-align: justify;">
    Pour détruire ce chèque, le mouvement du date <?php echo $mvt->getDateoperation() ?> va prendre le chèque N° 
    <span style="color: #0069A2;"><?php echo $liste_cheque->getFirst()->getRefpapier() ?></span> comme instrument de règlement.
</div>
<input type="hidden" id="next_cheque" value="<?php echo $liste_cheque->getFirst()->getId(); ?>" />

<style>

    .titre_chèque_modal{font-size: 16px;}
    .modal-dialog {width: 600px;}

</style>