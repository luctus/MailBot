<?php $active = MbWorker::getActive() == $MbMail->getId() ? 'active' : ''; ?>
<td class="sf_admin_text sf_admin_list_td_id <?php echo $active ?>">
  <?php echo link_to($MbMail->getId(), 'mb_mail_edit', $MbMail) ?>
</td>
<td class="sf_admin_text sf_admin_list_td_platform <?php echo $active ?>">
  <?php echo $MbMail->getPlatform() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_subject <?php echo $active ?>">
  <?php echo $MbMail->getSubject() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_progress <?php echo $active ?>">
  <?php echo $MbMail->getProgress() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_nb_errors <?php echo $active ?>">
  <a href="<?php echo url_for('mb_mailto/recipients?mail_id='.$MbMail->getId().'&state=error') ?>"><?php echo $MbMail->getNbErrors()?></a>
</td>
<td class="sf_admin_text sf_admin_list_td_batch_size <?php echo $active ?>">
  <?php echo $MbMail->getBatchSize() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_state <?php echo $active ?>">
  <?php echo $MbMail->getState() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_error <?php echo $active ?>">
  <?php echo $MbMail->getError() ?>
</td>
<td class="sf_admin_date sf_admin_list_td_created_at <?php echo $active ?>">
  <?php echo false !== strtotime($MbMail->getCreatedAt()) ? format_date($MbMail->getCreatedAt(), "f") : '&nbsp;' ?>
</td>