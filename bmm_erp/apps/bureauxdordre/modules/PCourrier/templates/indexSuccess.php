<h1>Parcourcouriers List</h1>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Datecreation</th>
      <th>Mdreponse</th>
      <th>Id exp</th>
      <th>Id rec</th>
      <th>Id action</th>
      <th>Description</th>
      <th>Id courier</th>
      <th>Id user</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($parcourcouriers as $parcourcourier): ?>
    <tr>
      <td><a href="<?php echo url_for('PCourrier/show?id='.$parcourcourier->getId()) ?>"><?php echo $parcourcourier->getId() ?></a></td>
      <td><?php echo $parcourcourier->getDatecreation() ?></td>
      <td><?php echo $parcourcourier->getMdreponse() ?></td>
      <td><?php echo $parcourcourier->getIdExp() ?></td>
      <td><?php echo $parcourcourier->getIdRec() ?></td>
      <td><?php echo $parcourcourier->getIdAction() ?></td>
      <td><?php echo $parcourcourier->getDescription() ?></td>
      <td><?php echo $parcourcourier->getIdCourier() ?></td>
      <td><?php echo $parcourcourier->getIdUser() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('PCourrier/new') ?>">New</a>
