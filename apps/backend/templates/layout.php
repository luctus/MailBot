<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <?php include_http_metas() ?>
    <?php include_metas() ?>
    <link rel="shortcut icon" href="/favicon.ico" />
    <?php include_stylesheets() ?>
    <?php include_javascripts() ?>
    <title>
      <?php if (!include_slot('title')): ?>
          Mailbot Portal
      <?php endif; ?>
    </title>
  </head>
  <body>
    <?php include_component('sfAdminDash','header'); ?>
	<?php echo $sf_content ?>
    <?php include_partial('sfAdminDash/footer'); ?>
  </body>
</html>
