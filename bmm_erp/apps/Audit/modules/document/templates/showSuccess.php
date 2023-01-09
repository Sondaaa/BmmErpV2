<table>
  <tbody>
    <tr>
      <th>Id:</th>
      <td><?php echo $piecejoint->getId() ?></td>
    </tr>
    <tr>
      <th>Chemin:</th>
      <td><?php echo $piecejoint->getChemin() ?></td>
    </tr>
    <tr>
      <th>Objet:</th>
      <td><?php echo $piecejoint->getObjet() ?></td>
    </tr>
    <tr>
      <th>Sujet:</th>
      <td><?php echo $piecejoint->getSujet() ?></td>
    </tr>
    <tr>
      <th>Id typepiece:</th>
      <td><?php echo $piecejoint->getIdTypepiece() ?></td>
    </tr>
    <tr>
      <th>Id courrier:</th>
      <td><?php echo $piecejoint->getIdCourrier() ?></td>
    </tr>
    <tr>
      <th>Id parcour:</th>
      <td><?php echo $piecejoint->getIdParcour() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('document/edit?id='.$piecejoint->getId()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('document/index') ?>">List</a>
