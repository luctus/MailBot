<?php use_helper('I18N', 'Date') ?>
<?php include_partial('log_mailto/assets') ?>

<div id="sf_admin_container">
  <h1><?php echo __('Edit Log mailto', array(), 'messages') ?></h1>

  <?php include_partial('log_mailto/flashes') ?>

  <div id="sf_admin_header">
    <?php include_partial('log_mailto/form_header', array('LogMailto' => $LogMailto, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>

  <div id="sf_admin_content">
    <?php include_partial('log_mailto/form', array('LogMailto' => $LogMailto, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>
  </div>

  <div id="sf_admin_footer">
    <?php include_partial('log_mailto/form_footer', array('LogMailto' => $LogMailto, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>
</div>
