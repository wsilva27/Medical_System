1. api
    - contains 36 php files
    - communication between front-end(js) and back-end(db connection in php)
    
2. commons
    - contains 4 folders
    - 3rd party open source css, js, webfont files

3. conf
    - contains 2 files
    - database.php: set url, database, username, password, etc...
    - url.php: set your physical path. default $base_URL .= "/";
4. js
    - contains 19 js files
    - front-end controller, these files are used to control the front page
5. lib
    - contains 26 php files
    - communication to database, These are the smallest model that gets values from the database.
6. views
    - contains 8 folders
    - The name of the folder matches the item in the menu
7. 4 files in root folder
    - default page and mune related
    
How to install
1. Download all files and copy them to the xampp\htdocs root.
2. Drop the existing database and execute database_tables_creation.sql, stored_procedures_creation.sql, insert_basic_data.sql in the workbench in order.
3. Modify the database.php file in the conf folder to match your database environment.
4. Open the web browser and put in localhost:[port]. Port is configured differently depending on your environment.
5. The default admin account ID/password is admin/1234.

***The manual for how to use will be immediately completed and uploaded to the pptx file.
