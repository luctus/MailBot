<td class="sf_admin_text sf_admin_list_td_id">
  <?php echo link_to($LogMailto->getId(), 'log_mailto_edit', $LogMailto) ?>
</td>
<td class="sf_admin_foreignkey sf_admin_list_td_mail_id">
  <?php echo $LogMailto->getMailId() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_mailto">
  <?php echo $LogMailto->getMailto() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_state">
  <?php echo $LogMailto->getState() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_error">
  <?php echo $LogMailto->getError() ?>
</td>
<td class="sf_admin_date sf_admin_list_td_sent_at">
  <?php echo false !== strtotime($LogMailto->getSentAt()) ? format_date($LogMailto->getSentAt(), "f") : '&nbsp;' ?>
</td>
