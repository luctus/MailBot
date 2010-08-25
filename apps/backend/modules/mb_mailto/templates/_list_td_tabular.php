<?php $active = MbWorker::getActiveRecipient() == $MbMailto->getId() ? 'active' : ''; ?>
<td class="sf_admin_text sf_admin_list_td_id">
  <?php echo link_to($MbMailto->getId(), 'mb_mailto_edit', $MbMailto) ?>
</td>
<td class="sf_admin_foreignkey sf_admin_list_td_mail_id <?php echo $active ?>">
  <?php echo $MbMailto->getMailId() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_mailto <?php echo $active ?>">
  <?php echo $MbMailto->getMailto() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_state <?php echo $active ?>">
  <?php echo $MbMailto->getState() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_error <?php echo $active ?>">
  <?php echo $MbMailto->getError() ?>
</td>
<td class="sf_admin_date sf_admin_list_td_sent_at <?php echo $active ?>">
  <?php echo false !== strtotime($MbMailto->getSentAt()) ? format_date($MbMailto->getSentAt(), "f") : '&nbsp;' ?>
</td>
