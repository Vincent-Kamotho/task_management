Installation:
1. For the installation, clone the project by:
   https://github.com/Vincent-Kamotho/task_management.git
2. Navigate to the project directory
3. Install PHP dependencies by running composer install
4. Create a .env file by copying '.env.example'
5. Generate an application key by running php artisan key:generate
6. Configure the env file with the database name which is task_management
7. Migrate the database by runnning php artisan migrate
8. Run the project by running the php artisan serve command

To deploy, follow the following steps:
1. SSH into your server by running: ssh username@your_server_ip
2. Update the server using the following commands
    sudo apt update
    sudo apt upgrade
3. Install Apache web server by running: sudo apt install apache2
4. Install PHP and required extensions:
       sudo apt install php php-cli php-mbstring php-xml php-zip php-curl php-mysql php-pgsql php-sqlite3
5. Configure Apache for the Laravel application
       sudo nano /etc/apache2/sites-available/your_project.conf
6. Upload the Laravel application
7. Restart the web server
       sudo systemctl restart nginx
       sudo systemctl restart php7.4-fpm 

