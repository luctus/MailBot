<?php if($sf_user->getAttribute('refresh') == 'on'): ?>

  <script type="text/JavaScript">
    function timedRefresh(timeoutPeriod) {
	    setTimeout("location.reload(true);",timeoutPeriod);
    }
    timedRefresh(5000);
  </script>

  <a href="<?php echo url_for('mb_mail/refresh?mode=off')?>">Stop refreshing</a>
<?php else: ?>
  <a href="<?php echo url_for('mb_mail/refresh?mode=on')?>">Start refreshing</a> (every 5 secs)
<?php endif; ?>