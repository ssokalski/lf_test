# lf_test
  # Preperation
    Apache must listen on port 23456.
      1) Edit apache2.conf (normally in /etc/apache2) and add: 
        Listen 23456
      2) Restart Apache:
        service apache2 restart
    Create folder for git clone
      1) in /var/www create the subfolder fl_projects 
      2) change folder owner and group to a low level use
      3) su to the low level user
      4) in the folder fl_projects run:
        git clone https://github.com/ssokalski/lf_test.git .
    Apache configuration file
      1) Copy file projects.conf from /var/www/fl_projects to the Apache sites directory (normally /etc/apache2/sites-available)
      2) Edit the settings for IP address and ServerName for your server
      3) Enable the site:
        a2ensite projects.conf
      4) Reload sites:
        service apache2 reload
