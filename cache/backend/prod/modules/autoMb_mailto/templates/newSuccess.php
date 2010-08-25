<?php use_helper('I18N', 'Date') ?>
<?php include_partial('mb_mailto/assets') ?>

<div id="sf_admin_container">
  <h1><?php echo __('New Mb mailto', array(), 'messages') ?></h1>

  <?php include_partial('mb_mailto/flashes') ?>

  <div id="sf_admin_header">
    <?php include_partial('mb_mailto/form_header', array('MbMailto' => $MbMailto, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>

  <div id="sf_admin_content">
    <?php include_partial('mb_mailto/form', array('MbMailto' => $MbMailto, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>
  </div>

  <div id="sf_admin_footer">
    <?php include_partial('mb_mailto/form_footer', array('MbMailto' => $MbMailto, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>
</div>
