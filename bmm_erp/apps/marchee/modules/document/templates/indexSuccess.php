<h1>Piecejoints List</h1>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Chemin</th>
      <th>Objet</th>
      <th>Sujet</th>
      <th>Id typepiece</th>
      <th>Id courrier</th>
      <th>Id parcour</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($piecejoints as $piecejoint): ?>
    <tr>
      <td><a href="<?php echo url_for('document/show?id='.$piecejoint->getId()) ?>"><?php echo $piecejoint->getId() ?></a></td>
      <td><?php echo $piecejoint->getChemin() ?></td>
      <td><?php echo $piecejoint->getObjet() ?></td>
      <td><?php echo $piecejoint->getSujet() ?></td>
      <td><?php echo $piecejoint->getIdTypepiece() ?></td>
      <td><?php echo $piecejoint->getIdCourrier() ?></td>
      <td><?php echo $piecejoint->getIdParcour() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('document/new') ?>">New</a>
