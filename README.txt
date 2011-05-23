INSTALL

First install Mysql and Apache with the mod_php and the Mysql extension. Then run these bash commands 
using whatever paths make sense for your Apache and Mysql installs.


# Set a bash variable to your ajax_chat root directory. You need to change the value 
# to be the directory of the ajax_chat working copy)...
export AJAX_CHAT_HOME=/path/to/ajax_chat

# Copy an Include in to your Apache config by running this...
sudo -E bash -c "echo \"Include $AJAX_CHAT_HOME/apache_includes/local.httpd.conf\" >> /etc/apache2/httpd.conf"

# Symlink /var/www/ajaxchat.brenttheisen.com to your local working copy dir. You can skip 
# this if you just make your root dir /var/www/ajaxchat.brenttheisen.com.
sudo -E ln -s $AJAX_CHAT_HOME /var/www/ajaxchat.brenttheisen.com

# Bounce Apache...
sudo -E apachectl restart

# Add the local hostname for the site to your hosts file...
sudo bash -c 'echo "127.0.0.1  local.ajaxchat.brenttheisen.com" >> /etc/hosts'

# Create the Mysql database. This needs to be run by a user that can create schemas...
mysql < $AJAX_CHAT_HOME/ajax_chat.sql
