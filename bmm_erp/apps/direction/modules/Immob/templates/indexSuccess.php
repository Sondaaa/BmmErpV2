<h1>Immobilisations List</h1>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Numéro</th>
      <th>Référence</th>
      <th>Date création</th>
      <th>Date mise à jour</th>
      <th>Id user</th>
      <th>Id nature</th>
      <th>Id fabricant</th>
      <th>Désignation</th>
      <th>Id marque</th>
      <th>Id type</th>
      <th>Id fournisseur</th>
      <th>Numéro facture</th>
      <th>Date acquisition</th>
      <th>Prixhtva</th>
      <th>Tva</th>
      <th>Mntttc</th>
      <th>Durée</th>
      <th>Id categorie</th>
      <th>Id famille</th>
      <th>Id sousfamille</th>
      <th>Id pays</th>
      <th>Id gouvernera</th>
      <th>Id site</th>
      <th>Id etage</th>
      <th>Id bureaux</th>
      <th>Id agent</th>
      <th>Adresse</th>
      <th>Compte comptable</th>
      <th>Taux amortissement</th>
      <th>Mode amortissement</th>
      <th>Source financement</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($immobilisations as $immobilisation): ?>
    <tr>
      <td><a href="<?php echo url_for('Immob/show?id='.$immobilisation->getId()) ?>"><?php echo $immobilisation->getId() ?></a></td>
      <td><?php echo $immobilisation->getNumero() ?></td>
      <td><?php echo $immobilisation->getReference() ?></td>
      <td><?php echo $immobilisation->getDatecreation() ?></td>
      <td><?php echo $immobilisation->getDatemisajour() ?></td>
      <td><?php echo $immobilisation->getIdUser() ?></td>
      <td><?php echo $immobilisation->getIdNature() ?></td>
      <td><?php echo $immobilisation->getIdFabricant() ?></td>
      <td><?php echo $immobilisation->getDesignation() ?></td>
      <td><?php echo $immobilisation->getIdMarque() ?></td>
      <td><?php echo $immobilisation->getIdType() ?></td>
      <td><?php echo $immobilisation->getIdFournisseur() ?></td>
      <td><?php echo $immobilisation->getNumerofacture() ?></td>
      <td><?php echo $immobilisation->getDateacquisition() ?></td>
      <td><?php echo $immobilisation->getPrixhtva() ?></td>
      <td><?php echo $immobilisation->getTva() ?></td>
      <td><?php echo $immobilisation->getMntttc() ?></td>
      <td><?php echo $immobilisation->getDuree() ?></td>
      <td><?php echo $immobilisation->getIdCategorie() ?></td>
      <td><?php echo $immobilisation->getIdFamille() ?></td>
      <td><?php echo $immobilisation->getIdSousfamille() ?></td>
      <td><?php echo $immobilisation->getIdPays() ?></td>
      <td><?php echo $immobilisation->getIdGouvernera() ?></td>
      <td><?php echo $immobilisation->getIdSite() ?></td>
      <td><?php echo $immobilisation->getIdEtage() ?></td>
      <td><?php echo $immobilisation->getIdBureaux() ?></td>
      <td><?php echo $immobilisation->getIdAgent() ?></td>
      <td><?php echo $immobilisation->getAdresse() ?></td>
      <td><?php echo $immobilisation->getComptecomptabel() ?></td>
      <td><?php echo $immobilisation->getTauxammortisement() ?></td>
      <td><?php echo $immobilisation->getModeamortisement() ?></td>
      <td><?php echo $immobilisation->getSourcefinancement() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('Immob/new') ?>">New</a>
