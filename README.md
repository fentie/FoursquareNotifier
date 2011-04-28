Set this up as a cronjob on a server you control to run at a specified 
interval. The script expects 15 minutes, so if you choose a different
one, change the DateTime->modify() call on line 7 to your preferred 
interval. 

Before scheduling this, change all 4 instances of "Use Your Own" to 
real values. Currently they're on lines 2, 3, 4, and 33.

notifier.php is written for PHP 5.3, and notifier52.php is compatible
with PHP 5.2. I'm sure it'll work with lower versions than that, but
I haven't tested them, so use at your own risk. The only real difference
between the two at this point is the syntax for defining constants.

Security note: Currently I'm disabling the cert verification for this
curl script. This is a bad security practice, but there's no way that
I could fix it where it would be portable to other computers, so just
go here and sort it out for your own environment: [http://unitstep.net/blog/2009/05/05/using-curl-in-php-to-access-https-ssltls-protected-sites/](http://unitstep.net/blog/2009/05/05/using-curl-in-php-to-access-https-ssltls-protected-sites/)