<div class="page-header">
    <h1>Fiche Compératif des fournisseur du DA : <?php echo $documentachat->getNumerodocachat() ?></h1>
</div>

    <?php $doc = DocumentachatTable::getInstance()->find($iddoc);
$offres_prix = DocumentachatTable::getInstance()->findByIdDocparentAndIdTypedoc($iddoc, 24);
// $ligne_ofr=$offres_prix->getId
$ligne_doc_achat = LignedocachatTable::getInstance()->findByIdDoc($iddoc);
$ligness = Doctrine_Core::getTable('Lignedocachat')
    ->createQuery('a')
  ->where('id_doc ='.$doc->getId())
    ->orderBy('id asc')->execute();
?>
<div class="row">
<div class="col-md-12">
        <div class="col-md-8">
    <table class="table table-bordered table-hover" style="width: 100%">
                <thead>
                    <tr>
                <th>Article/Fournisseur</th>
                        <?php foreach ($offres_prix as $offre): ?>
    <th><?php echo $offre->getFournisseur()->getRs(); ?></th>
       <?php endforeach;?>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($ligness as $ligne): ?>
                    <tr>
                  <td> 
                     <?php echo $ligne->getCodearticle().' '
                      .$ligne->getDesignationarticle();
                        ?>
                  </td>
                  <td>
                  <?php foreach ($offres_prix as $offre): ?>

                  </td>
                 </tr>                    
                    <?php endforeach;?>
                    <?php endforeach;?>

                </tbody>

    </table>
 </div>
</div>
</div>

<style>
    .etat_valide {
        background-color: #9f9;
    }

    .etat_non_valide {
        background-color: #ffa6a6;
    }
</style>