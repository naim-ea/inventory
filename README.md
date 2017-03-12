# Inventory Manager

I did an inventory for people to manage their business stocks from the inside. They can also create new users, change currency, delete items, view some stats..

* PASSWORD AND USERNAME ARE EITHER ROOT AND ROOT OR ADMIN AND ADMIN

### Features
* Products with quantity, price, description
* Users with one administrator level
* Currency linked to the user
* Dashboard with stats and important data


### Installations
* Google Maps Javascript API

### WHAT ARE THE DIFFERENT FILES HERE FOR ?

* index.php = connection
* dashboard.php = home page, stats, important data
* inventory.php = products management
* settings.php = user management, currency management
* modify-user.php = password check of the user to modify its info
* user-change.php = page where there is a form for user info modification
* delete-user.php = password check of the admin to delete an user
* src/php_scripts = other php scripts that are not pages :
    * add_product.php = add a product
    * add_user.php = add an user
    * admin-password-check.php = check the admin password
    * change.php = modify an item
    * connect.php = test username and password for connection
    * currency.php = change user's currency
    * db_connect.php = connection to the database and specification of the document root
    * delete.php = delete an item
    * logout.php = session destroy for logging out
    * password-check.php = check the user password


### HOW TO CONNECT TO THE DATABASE

* Go to your phpmyadmin interface
* Create a new database called "inventory"
* Import the SQL file named "inventory.sql"
* In a PHP file, connect to the database using localhost for host, inventory for database name, and root for both username and password


### TO DO
* [ ] More stats
* [ ] Flash notifications
* [ ] Website editable settings
* [ ] Basic front-end interface