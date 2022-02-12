# How to setup web application on local
To set up the application please follow this steps:
* open the application root folder in the terminal and run this command `cp .env.example .env`
* then cd into the frontend folder and run this command `cp .env.example .env`
* then cd into the backend folder and run this command `cp .env.example .env`
* then cd into the application root folder and run this command if you are on windows and Mac OS run `docker-compose up -d`. If you are  on linux run `sudo docker-compose up -d`;
* the containers for the web application should be up and running;
* Now we need to install packages for our web application, to do this; run this command `sudo bash composer-install.sh`;
* Then visit http://localhost:8080/ to test the application