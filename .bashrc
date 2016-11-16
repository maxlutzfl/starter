# .bashrc

# Source global definitions
if [ -f /etc/bashrc ]; then
    . /etc/bashrc
fi

# User specific aliases and functions

function bcore-new-project() {
  # Variables
  BIG_MOMMA_REPO="/Volumes/BrandCo/CustomSiteRepos"
  LOCAL_REPO="/Users/maxlutz/Documents/BrandCo/CustomSiteRepos"

  # Start 
  echo -e "\033[0;34m🚀  Starting new project, what should we name the directory? \033[0m"
  read project_name
  
  # Go to BigMomma CustomSiteRepos directory
  # and create a new directory
  cd $BIG_MOMMA_REPO
  mkdir $project_name.git
  cd $BIG_MOMMA_REPO/$project_name.git
  
  # Init git
  git --bare init
  
  # Clone repo to local directory
  git clone $BIG_MOMMA_REPO/$project_name.git $LOCAL_REPO/$project_name
  
  # Download Wordpress
  # Unzip, copy from the wordpress directory to main git directory
  # and delete the wordpress directory and zip file
  cd $LOCAL_REPO/$project_name
  wget http://wordpress.org/latest.tar.gz --no-check-certificate
  tar -zxvf latest.tar.gz
  cp -rvf wordpress/* .
  rm -R wordpress
  rm latest.tar.gz

  # Create database
  echo -e "\033[0;34m🚀  Creating database, what should we name it? \033[0m"
  read database_name
  /Applications/MAMP/Library/bin/mysql -uroot -proot -e "create database $database_name;"
  
  # Finished
  echo -e "\033[0;34m🚀  All done! \033[0m"
}
 
function bcore-setup() {
  # Initialize
  echo -e "\033[0;34m🚀  Setting up theme and plugins, standby... \033[0m"

  # Variables
  STARTER_THEME_DIR="/Users/maxlutz/Documents/Max/starter/wp-content/themes/bcore"
  CHILD_THEME_DIR="/Users/maxlutz/Documents/Max/starter/wp-content/themes/childtheme"
  PLUGINS_DIR="/Users/maxlutz/Documents/Max/starter/wp-content/plugins"

  # Get gitignore
  cp ../.gitignore .

  # Get theme
  cp -r $STARTER_THEME_DIR wp-content/themes/
  cp -r $CHILD_THEME_DIR wp-content/themes/

  # Get plugins
  cp -r $PLUGINS_DIR/wordpress-seo wp-content/plugins/
  cp -r $PLUGINS_DIR/search-and-replace wp-content/plugins/
  cp -r $PLUGINS_DIR/advanced-custom-fields-pro wp-content/plugins/
  cp -r $PLUGINS_DIR/gravityforms wp-content/plugins/
  cp -r $PLUGINS_DIR/easy-wp-smtp wp-content/plugins/
  cp -r $PLUGINS_DIR/my-eyes-are-up-here wp-content/plugins/
  cp -r $PLUGINS_DIR/wolfnet-idx-for-wordpress wp-content/plugins/
  cp -r $PLUGINS_DIR/acf-gravityforms-picker wp-content/plugins/
  cp -r $PLUGINS_DIR/wp-smushit wp-content/plugins/

  # Install WordPress
  echo -e "\033[0;34m🚀  What is the MAMP url? \033[0m"
  read local_url

  # Open Chrome
  /usr/bin/open -a "/Applications/Google Chrome.app" "http://$local_url/wp-admin/"
}




















