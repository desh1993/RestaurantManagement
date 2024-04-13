# RESTAURANT MANAGEMENT SYSTEM

FINAL YEAR PROJECT ECOMMERCE STORE

1. Git clone it to htdocs(if on windows) and name the folder RestaurantManagementSystem (important to follow this name)

2. Create config Folder in root directory

3. In config/index.php
   <?php
   define('DB_HOST', 'localhost'); <br>
   define('DB_USERNAME', 'dbusername');  //your phpmyadmin username <br>
   define('DB_PASSWORD', 'dbpassword'); //your phpmyadmin password <br>
   define('DB_NAME', 'restaurant-management-system'); //set this to db name  <br>


4. In config/site-settings.php
   <?php
   define('BASE_URL', '/RestaurantManagementSystem');  <br>
   define('API_URL', '/RestaurantManagementSystem/api');  <br>
   define('ORDER_GENERATE_KEY', 'f5c12ffc46104589b3e0a889448bf8ce'); //some random string  <br>


5. In Js folder create module/config.js file

   const baseUrl = "/RestaurantManagementSystem"; // Replace with your actual base URL <br>
   const apiUrl = "/RestaurantManagementSystem/api"; // Replace with your actual api URL <br>
   export { baseUrl, apiUrl};

6. Screenshot of the folders https://ibb.co/sJXCZtW

7. Go to PHPMYADMIN and create a database by the name of restaurant-management-system

8. Import Sql/Final.sql into PHPMYADMIN.

9. Admin login
   Username: admin1<br>
   Password: defaultpassword<br>
   URL: /RestaurantManagementSystem/admin<br>
