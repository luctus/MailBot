<td width="100px;">
  
    <?php if($MbMail->getState() == 'stop'): ?>
      <?php echo link_to(image_tag('/images/control_play_blue.png'), 'mb_mail/ListResume?id='.$MbMail->getId(), array('title'=>'Resume', 'alt'=>'Resume')) ?>
    <?php elseif($MbMail->isPending()): ?>
      <?php echo link_to(image_tag('/images/control_pause_blue.png'), 'mb_mail/ListStop?id='.$MbMail->getId(), array('title'=>'Stop', 'alt'=>'Stop')) ?>
    <?php endif; ?>

    <?php if($MbMail->isPending()): ?>
      <?php if($MbMail->getBatchSize() != 50): ?>
        <?php echo link_to(image_tag('/images/lightning.png'), 'mb_mail/ListFast?id='.$MbMail->getId(), array('title'=>'Set as fast!', 'alt'=>'Set as fast!')) ?>
      <?php endif; ?>
      <?php if($MbMail->getBatchSize() != 5): ?>
        <?php echo link_to(image_tag('/images/cup.png'), 'mb_mail/ListSlow?id='.$MbMail->getId(), array('title'=>'Set as slow', 'alt'=>'Set as slow')) ?>
      <?php endif; ?>
    <?php endif; ?>

    <?php echo link_to(image_tag('/images/group.png'), 'mb_mailto/recipients?mail_id='.$MbMail->getId(), array('title'=>'See recipients', 'alt'=>'See recipients')) ?>
    <?php echo link_to(image_tag('/images/email_open.png'), 'mb_mail/show?id='.$MbMail->getId(), array('title'=>'See Mail', 'alt'=>'See Mail')) ?>
</td>

