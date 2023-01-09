<table>
  <tbody>
    <tr>
      <th>Id:</th>
      <td><?php echo $parcourcourier->getId() ?></td>
    </tr>
    <tr>
      <th>Datecreation:</th>
      <td><?php echo $parcourcourier->getDatecreation() ?></td>
    </tr>
    <tr>
      <th>Mdreponse:</th>
      <td><?php echo $parcourcourier->getMdreponse() ?></td>
    </tr>
    <tr>
      <th>Id exp:</th>
      <td><?php echo $parcourcourier->getIdExp() ?></td>
    </tr>
    <tr>
      <th>Id rec:</th>
      <td><?php echo $parcourcourier->getIdRec() ?></td>
    </tr>
    <tr>
      <th>Id action:</th>
      <td><?php echo $parcourcourier->getIdAction() ?></td>
    </tr>
    <tr>
      <th>Description:</th>
      <td><?php echo $parcourcourier->getDescription() ?></td>
    </tr>
    <tr>
      <th>Id courier:</th>
      <td><?php echo $parcourcourier->getIdCourier() ?></td>
    </tr>
    <tr>
      <th>Id user:</th>
      <td><?php echo $parcourcourier->getIdUser() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('PCourrier/edit?id='.$parcourcourier->getId()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('PCourrier/index') ?>">List</a>
