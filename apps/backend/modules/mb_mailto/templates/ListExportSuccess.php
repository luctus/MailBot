<?php if($mb_mail): ?>
<h1>Recipients list for "<?php echo $mb_mail->getSubject() ?>"</h1>
<?php else: ?>
<h1>Recipients list</h1>
<?php endif; ?>
<table>
  <thead>
    <tr>
      <th>Id</th>
      <?php if(!$mb_mail): ?>
        <th>MbMail Id</th>
        <th>Subject</th>
      <?php endif; ?>
      <th>Mail</th>
      <th>Estado</th>
      <th>Error</th>
      <th>Fecha envio</th>
      <th>Hora envio</th>
    </tr>
  </thead>
  <tbody>
  <?php foreach ($mb_mailto_list as $mb_mailto): ?>
    <tr>
      <td><?php echo $mb_mailto->getId()?></td>
      <?php if(!$mb_mail): ?>
        <th><?php echo $mb_mailto->getMailId()?></th>
        <th><?php echo $mb_mailto->getMbMail()->getSubject()?></th>
      <?php endif; ?>
      <td><?php echo $mb_mailto->getMailto()?></td>
      <td><?php echo $mb_mailto->getState()?></td>
      <td><?php echo $mb_mailto->getError()?></td>
      <td><?php echo $mb_mailto->getSentAt("d/m/Y")?></td>
      <td><?php echo $mb_mailto->getSentAt("H:i:s")?></td>
    </tr>
  <?php endforeach; ?>
  </tbody>
</table>