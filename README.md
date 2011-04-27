Set this up as a cronjob on a server you control to run at a specified 
interval. The script expects 15 minutes, so if you choose a different
one, change the DateTime->modify() call to your preferred interval. 

Before scheduling this, change all 4 instances of "Use Your Own" to 
real values.