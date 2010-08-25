<td class="sf_admin_text sf_admin_list_td_id">
  <?php echo link_to($LogMail->getId(), 'log_mail_edit', $LogMail) ?>
</td>
<td class="sf_admin_text sf_admin_list_td_platform">
  <?php echo $LogMail->getPlatform() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_subject">
  <?php echo $LogMail->getSubject() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_progress">
  <?php echo $LogMail->getProgress() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_nb_errors">
  <?php echo $LogMail->getNbErrors() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_batch_size">
  <?php echo $LogMail->getBatchSize() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_state">
  <?php echo $LogMail->getState() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_error">
  <?php echo $LogMail->getError() ?>
</td>
<td class="sf_admin_date sf_admin_list_td_created_at">
  <?php echo false !== strtotime($LogMail->getCreatedAt()) ? format_date($LogMail->getCreatedAt(), "f") : '&nbsp;' ?>
</td>
