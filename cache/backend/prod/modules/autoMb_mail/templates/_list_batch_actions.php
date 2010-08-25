<li class="sf_admin_batch_actions_choice">
  <select name="batch_action">
    <option value=""><?php echo __('Choose an action', array(), 'sf_admin') ?></option>
    <option value="batchStop"><?php echo __('Stop', array(), 'sf_admin') ?></option>
    <option value="batchResume"><?php echo __('Resume', array(), 'sf_admin') ?></option>
    <option value="batchFast"><?php echo __('Fast', array(), 'sf_admin') ?></option>
    <option value="batchSlow"><?php echo __('Slow', array(), 'sf_admin') ?></option>
  </select>
  <?php $form = new BaseForm(); if ($form->isCSRFProtected()): ?>
    <input type="hidden" name="<?php echo $form->getCSRFFieldName() ?>" value="<?php echo $form->getCSRFToken() ?>" />
  <?php endif; ?>
  <input type="submit" value="<?php echo __('go', array(), 'sf_admin') ?>" />
</li>
