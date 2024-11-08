# Zoo-Website

The website can be accessed remotely at the link ~~https://zoo-project.azurewebsites.net/~~ **(Currently Not Available)**. Please note that because we are on the free Azure plan, there is a limit of 60 minutes of computation time daily before the website’s loading time becomes very slow. If this happens, then the website can be hosted locally by running the index.php file. In case the files in the email are corrupt, the github link to the repository of the project can be found at https://github.com/rala76/Zoo-Website.


DATABASE
The server is hosted on Azure and uses Microsoft SQL Server as its RDBMS. The server name is `SERVER_NAME` **(Original Server Name Removed For Security)**, and the authentication method is SQL Server Authentication. The database to connect to is `DATABASE_NAME` **(Original Database Name Removed For Security)**. The database credentials are stored in a hidden 'config.php' file available only to the development team.

LOGIN <br />
Admin Login: <br />
Username: `admin_username` <br />
Password: `admin_password` <br />

Customer Login: <br />
Username: `customer_username` <br />
Password: `customer_password` <br />

**NOTE: Login details were removed for security purposes.**

If the user attempts to login with an account that does not exist in the database, then they are automatically redirected to the registration page to register an account. A registered account cannot have the same username, password, or email as another account already existing in the database. If the user attempts to register an account that already exists, then the website will indicate this to them and allow them to navigate back to the login portal.

ADMIN PORTAL
The admin portal displays three header links: Tables, Departments, and Statistics. 

TABLES 
When pressed, the Tables hyperlink shows a sidebar that contains Employees, Customers, Products, Stores, Events, Animals, and Enclosures. When any of these hyperlinks are navigated to, dropdown options are displayed: the first option allows the admin to select by which column in the database they want to sort their table by, while the second option allows the admin to select the sort order. For select tables (such as that of Employees, Customers, and Products), there is another dropdown option contained between that of the sort column and order. This option allows the admin to choose a specific filter for that table:
For the Employees table, the filter allows the admin to select either all employees, only part time employees (employees who work 20 hours or less a week), or only full time employees (employees who work more than 20 hours a week).
For the Customers table, the filter allows the admin to select either all customers, only children (customers who are younger than 18), only adults (customers who are between the ages of 18 and 65), or only seniors (customers who are 65 years or older).
For the Products table, the filter allows the admin to select either all products, only food items, only tickets, or only souvenirs.
Two of the pages (Events and Products) also contain triggers in the database that are set off when specific conditions are met:
For the Events page, when the admin attempts to insert an event that has greater than 100 attendees, the website throws a popup message that indicates to them that this is not valid, and the event is not stored in the database.
For the Products page, when the admin attempts to insert a product that has a greater Amount Sold than Inventory Amount, the website throws a popup message that indicates to them that this is not valid, and the product is not stored in the database.
Each respective page also allows the admin to either insert a new record into the database, edit an already existing record, or delete a specific record of their choosing.

DEPARTMENTS
When pressed, this header displays similarly to the tables in the rest of the admin portal; however, the department table is meant only for visual reference and cannot be edited.

STATISTICS
When pressed, this header displays a list of statistics derived from the tables in the database. These statistics showcase the total number of employees, customers, products, stores, events, and animals found in the database, and changes according to any database alteration.


CUSTOMER PORTAL
Upon logging in to the customer portal, the user is taken to a home page that features some information about the zoo while showcasing some animal pictures. If the user wants to navigate back to the admin portal, they can simply log out of the customer one.
