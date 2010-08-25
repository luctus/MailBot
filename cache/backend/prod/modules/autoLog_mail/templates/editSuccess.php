<?php use_helper('I18N', 'Date') ?>
<?php include_partial('log_mail/assets') ?>

<div id="sf_admin_container">
  <h1><?php echo __('Edit Log mail', array(), 'messages') ?></h1>

  <?php include_partial('log_mail/flashes') ?>

  <div id="sf_admin_header">
    <?php include_partial('log_mail/form_header', array('LogMail' => $LogMail, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>

  <div id="sf_admin_content">
    <?php include_partial('log_mail/form', array('LogMail' => $LogMail, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>
  </div>

  <div id="sf_admin_footer">
    <?php include_partial('log_mail/form_footer', array('LogMail' => $LogMail, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>
</div>
