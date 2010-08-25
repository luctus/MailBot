<td colspan="6">
  <?php echo __('%%id%% - %%mail_id%% - %%mailto%% - %%state%% - %%error%% - %%sent_at%%', array('%%id%%' => link_to($MbMailto->getId(), 'mb_mailto_edit', $MbMailto), '%%mail_id%%' => $MbMailto->getMailId(), '%%mailto%%' => $MbMailto->getMailto(), '%%state%%' => $MbMailto->getState(), '%%error%%' => $MbMailto->getError(), '%%sent_at%%' => false !== strtotime($MbMailto->getSentAt()) ? format_date($MbMailto->getSentAt(), "f") : '&nbsp;'), 'messages') ?>
</td>
