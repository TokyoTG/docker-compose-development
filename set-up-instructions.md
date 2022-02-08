# How to setup web application on local
To set up the application please follow this steps:
* open the application folder in the terminal and run this command `cp .env.example .env`
* then edit the .env file and set the database root password and database user to your preference;
* then run this command if you are on windows and Mac OS run `docker-compose up -d`. If you are  on linux run `sudo docker-compose up -d`;
* the containers for the web application should be up and running;
* Now we need to install packages for our web application, to do this; run this command `sudo bash composer-install.sh`;
* After installing packages we need to create mysql user for our database and grant the user access to the database;
* To do the above we run this command `sudo docker exec -it app.mysql bash`, this will take us into the the database container where we can login to mysql;
* To login we type this command `mysql -u root -p` then input the specified root password in the .env file;
* After login, then we create a user with this command `CREATE USER '${pefered_username}'@'%' IDENTIFIED with mysql_native_password BY '${preferred_password}';`;
* Afterwards we Grant the user created above access to the database specified in the .env file using this command `GRANT ALL ON '${env file database name}'.* TO '${name of user created above}'@'%';`; Then exit out of the container by typing this command `EXIT`;
* Then cd into the backend directory and run this command `cp .env.example .env`;
* Then update the backend service .env file with the user credentials created above like:
`
DB_CONNECTION=mysql
DB_HOST=app.mysql
DB_PORT=3306
DB_DATABASE=${database base name specified at step 2}
DB_USERNAME=${name of the user created in database container}
DB_PASSWORD=${password of the user created in database container}
`;
* After updating the backend .env file then run `sudo docker-compose up -d` to update the container then run `sudo docker exec -it app.backend bash` to enter into the backend container;
* Then run this command `php artisan migrate` to create the table for the backend container. Then exit the container and visit http://localhost:8080/ to test the application