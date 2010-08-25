<?php if($log_mail): ?>
<h1>Recipients list for "<?php echo $log_mail->getSubject() ?>"</h1>
<?php else: ?>
<h1>Recipients list</h1>
<?php endif; ?>
<table>
  <thead>
    <tr>
      <th>Id</th>
      <?php if(!$log_mail): ?>
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
  <?php foreach ($log_mailto_list as $log_mailto): ?>
    <tr>
      <td><?php echo $log_mailto->getId()?></td>
      <?php if(!$log_mail): ?>
        <th><?php echo $log_mailto->getMailId()?></th>
        <th><?php echo $log_mailto->getMbMail()->getSubject()?></th>
      <?php endif; ?>
      <td><?php echo $log_mailto->getMailto()?></td>
      <td><?php echo $log_mailto->getState()?></td>
      <td><?php echo $log_mailto->getError()?></td>
      <td><?php echo $log_mailto->getSentAt("d/m/Y")?></td>
      <td><?php echo $log_mailto->getSentAt("H:i:s")?></td>
    </tr>
  <?php endforeach; ?>
  </tbody>
</table>