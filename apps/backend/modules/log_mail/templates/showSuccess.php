<?php use_helper('I18N', 'Date') ?>
<?php include_partial('log_mail/assets') ?>

<div id="sf_admin_container">
  <h1>Detalle de Email</h1>
  <div id="sf_admin_header">
    <a href="<?php echo url_for('@log_mail')?>">Back to Past Mails</a>
  </div>
  <table>
    <tbody>
      <tr>
        <th>Subject</th>
        <td><?php echo $log_mail->getSubjectClean()?></td>
      </tr>
      <tr>
        <th>From</th>
        <td><?php echo $log_mail->getStrfrom()?></td>
      </tr>
      <?php if($log_mail->getNotifyTo()): ?>
        <tr>
          <th>Notify to</th>
          <td><?php echo $log_mail->getNotifyTo()?></td>
        </tr>
      <?php endif; ?>
      <tr>
        <th>Created At</th>
        <td><?php echo $log_mail->getCreatedAt("d/m/Y H:i:s")?></td>
      </tr>
      <tr>
        <th>Total recipients</th>
        <td><?php echo $log_mail->getNbRecipients()?>
        (<a href="<?php echo url_for('log_mailto/recipients?mail_id='.$log_mail->getId())?>">See online progress</a>)</td>
      </tr>
      <tr>
        <th>Progress</th>
        <td><?php echo $log_mail->getProgress()?>
        (<a href="<?php echo url_for('log_mailto/recipients?mail_id='.$log_mail->getId())?>">See online progress</a>)</td>
      </tr>
      <tr>
        <th>Attachments</th>
        <td>
          <?php if($log_mail->getLogMailAttachments()): ?>
            <ul>
              <?php foreach($log_mail->getLogMailAttachments() as $log_attachment): ?>
                <li><a href="<?php echo url_for('log_mail/downloadAttach?log_mail_attachment_id='.$log_attachment->getId())?>">
                        <?php echo $log_attachment->getUrl()?>
                </a></li>
              <?php endforeach; ?>
            </ul>
          <?php else: ?>
            None
          <?php endif; ?>
        </td>
      </tr>
      <tr>
        <th>Body HTML</th>
        <td><?php echo $log_mail->getBodyHtml()?></td>
      </tr>
      <tr>
        <th>Body Text</th>
        <td><?php echo $log_mail->getBodyText()?></td>
      </tr>
    </tbody>
  </table>

</div>