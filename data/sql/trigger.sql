DROP TRIGGER IF EXISTS mailbot_test.MAILBOT_HISTORY //

CREATE TRIGGER mailbot_test.MAILBOT_HISTORY
AFTER UPDATE ON mailbot_test.mb_mail
FOR EACH ROW
BEGIN
IF ((OLD.state IS NULL OR OLD.state <> 'ok') AND NEW.state = 'ok') THEN
  INSERT INTO log_mail SELECT * FROM mb_mail WHERE id = OLD.id;
  INSERT INTO log_mailto SELECT * FROM mb_mailto WHERE mail_id = OLD.id;
  INSERT INTO log_mail_attachment SELECT * FROM mb_mail_attachment WHERE mail_id = OLD.id;
END IF;
END //