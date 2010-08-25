MailBot 
=======

MailBot is a symfony (v 1.4) project created to be integrated with multi projects 
that need to send massive emails to their users (for example, a newsletter).

It has no logic about user lists or group lists. You need to have your own logic.
When you need to send massive email, all you have to do is to save the data in the 
MailBot Database.

MailBot knows how to send thousand of emails.

MailBot has a web interface where you can see online how much emails are being sent and
do some usefull actions.


Included Plugins
----------------

The whole project uses five symfony plugins:

  * sfPropel15Plugin
  * sfGuardPlugin
  * sfErrorNotifierPlugin
  * sfAdminDashPlugin
  * sfJqueryReloadedPlugin
  And the great library Switf Mailer (http://swiftmailer.org)


Installation
------------

  * Download the application to your own server, let's assume it will be downloaded
    to /www/mailbot

  * Configure the database configuration at config/databases.yml, then run 

      $ php symfony propel:insert-sql

  * Enable some domain in order to launch the MailBot Portal site, let's assume it will be 
    http://mailbot.mydomain.com

  * Create your first user in order to access to MailBot Portal:

      $ php symfony guard:create-user luctus $ecret

  * Edit config/app.yml:

      [yml]
       all:
         server: devel
         url: 'http://mailbot.mydomain.com'         
         smtp:
           host: 'smtp.mydomain.com'
           port: 25
         batch_size:
           fast: 50
           slow: 5
         
  * Clear cache:

      $ php symfony cc

  * Edit send($mb_mail, $rand) function in lib/task/mailbotTestTask.class.php 
    and put some real email addresses in order to test the application

  * Schedule a cron job for every 1 minute (or whatever you want/need) for this command:

      $ php symfony mailbot:main

  * Run the tests:

      $ php symfony mailbot:test


Integration to your application
-------------------------------

Every time you need to send a massive email, you need to write the info into the
MailBot database. See the lib/task/mailbotTestTask.class.php in order to understand
what data you need to write.


The Algorithm
-------------

The principal algorithm is based on the Round-Robin algorithm: MailBot looks at the database
and knows how many e-mails need to be delivered. Every e-mail may have of course different 
recipients.

It iterates on every e-mail and, for each one, it sends the e-mail to 5 (configurable in app.yml,
batch_size_slow) recipients and then go to the next. At the end of the loop, it starts again. 

If there are too many e-mails to be delivered, you can go to the MailBot Portal and set one or 
more as "Fast Delivery". The main process will then send 50 (configurable in app.yml, batch_size_fast)
recipients in every iteration for the selected e-mail.  

When all the recipients for an e-mail are delivered, it can send a notification e-mail
with a resume of the operation to the sender (if the 'notify_to' field is filled with a
valid e-mail address).


Thanks to
---------

Claudio Fuentes (claudio at diablazza dot cl), for the great MailBot logo!


TODO
----

  * Transform mailbotTestTask into real functional tests

If you need help or want to collaborate to the MailBot project, do not hesitate in
contact me at luctus at gmail dot com

Sorry for my poor bad english
