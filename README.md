# RESTAURANT MANAGEMENT SYSTEM

FINAL YEAR PROJECT ECOMMERCE STORE

1. Git clone it to htdocs(if on windows) and name the folder RestaurantManagementSystem (important to follow this name)

2. Create config Folder in root directory

3. In config/index.php
   <?php
   define('DB_HOST', 'localhost'); <br>
   define('DB_USERNAME', 'dbusername');  <br> //your phpmyadmin username
   define('DB_PASSWORD', 'dbpassword');  <br> //your phpmyadmin password
   define('DB_NAME', 'restaurant-management-system'); //set this to db name  <br>

5. In config/site-settings.php
   <?php
   define('BASE_URL', '/RestaurantManagementSystem');  <br>
   define('API_URL', '/RestaurantManagementSystem/api');  <br>
   define('ORDER_GENERATE_KEY', 'f5c12ffc46104589b3e0a889448bf8ce'); //some random string  <br>

7. In Js folder create module/config.js file
   
   const baseUrl = "/RestaurantManagementSystem"; // Replace with your actual base URL  <br>
   const apiUrl = "/RestaurantManagementSystem/api"; // Replace with your actual api URL  <br>
   export { baseUrl, apiUrl};

9. Screenshot of the folders https://ibb.co/hHYg2xC

10. Go to PHPMYADMIN and create a database by the name of restaurant-management-system

11. Import Sql/Final.sql into PHPMYADMIN.
