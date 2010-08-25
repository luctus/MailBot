<td>
  <?php echo link_to(image_tag('/images/group.png'), 'log_mailto/recipients?mail_id='.$LogMail->getId(), array('title'=>'See recipients', 'alt'=>'See recipients')) ?>
  <?php echo link_to(image_tag('/images/email_open.png'), 'log_mail/show?id='.$LogMail->getId(), array('title'=>'See Mail', 'alt'=>'See Mail')) ?>
</td>
