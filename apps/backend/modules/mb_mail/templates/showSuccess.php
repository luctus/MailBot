<?php use_helper('I18N', 'Date') ?>
<?php include_partial('mb_mail/assets') ?>

<div id="sf_admin_container">
  <h1>Email detail</h1>
  <div id="sf_admin_header">
    <a href="<?php echo url_for('@mb_mail')?>">Back to Today's Mails</a>
  </div>
  <table>
    <tbody>
      <tr>
        <th>Subject</th>
        <td><?php echo $mb_mail->getSubject()?></td>
      </tr>
      <tr>
        <th>From</th>
        <td><?php echo $mb_mail->getStrfrom()?></td>
      </tr>
      <?php if($mb_mail->getNotifyTo()): ?>
        <tr>
          <th>Notify to</th>
          <td><?php echo $mb_mail->getNotifyTo()?></td>
        </tr>
      <?php endif; ?>
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
        <th>Attachments</th>
        <td>
          <?php if($mb_mail->getMbMailAttachments()): ?>
            <ul>
              <?php foreach($mb_mail->getMbMailAttachments() as $mb_attachment): ?>
                <li><a href="<?php echo url_for('mb_mail/downloadAttach?mb_mail_attachment_id='.$mb_attachment->getId())?>">
                        <?php echo $mb_attachment->getUrl()?>
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
        <td><?php echo $mb_mail->getBodyHtml()?></td>
      </tr>
      <tr>
        <th>Body Text</th>
        <td><?php echo $mb_mail->getBodyText()?></td>
      </tr>
    </tbody>
  </table>

<?php include_partial('mb_mail/list_footer')?>
</div>

