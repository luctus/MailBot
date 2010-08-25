<h1>Email detail</h1>
<table>
  <tbody>
    <tr>
      <th>Subject</th>
      <td><?php echo $mb_mail->getSubject()?></td>
    </tr>
    <tr>
      <th>Created At</th>
      <td><?php echo $mb_mail->getCreatedAt("d/m/Y H:i:s")?></td>
    </tr>
    <tr>
      <th>Total recipients</th>
      <td><?php echo $mb_mail->getNbRecipients()?>
      (<a href="<?php echo url_for('mb_mailto/recipients?mail_id='.$mb_mail->getId())?>">See online progress</a>)</td>
    </tr>
    <tr>
      <th>Progress</th>
      <td><?php echo $mb_mail->getProgress()?>
      (<a href="<?php echo url_for('mb_mailto/recipients?mail_id='.$mb_mail->getId())?>">See online progress</a>)</td>
    </tr>
    <tr>
      <th>Body HTML</th>
      <td><?php echo $mb_mail->getBodyHtml()?></td>
    </tr>
    <tr>
      <th>Body Text</th>
      <td><?php echo $mb_mail->getBodyText()?></td>
    </tr>
  </tbody>
</table>