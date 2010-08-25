<td colspan="6">
  <?php echo __('%%id%% - %%mail_id%% - %%mailto%% - %%state%% - %%error%% - %%sent_at%%', array('%%id%%' => link_to($LogMailto->getId(), 'log_mailto_edit', $LogMailto), '%%mail_id%%' => $LogMailto->getMailId(), '%%mailto%%' => $LogMailto->getMailto(), '%%state%%' => $LogMailto->getState(), '%%error%%' => $LogMailto->getError(), '%%sent_at%%' => false !== strtotime($LogMailto->getSentAt()) ? format_date($LogMailto->getSentAt(), "f") : '&nbsp;'), 'messages') ?>
</td>
