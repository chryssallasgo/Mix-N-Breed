Mix N' Breed

Getting Started:

1. Clone the repo first
2. open vs code and go to that folder where u extracted  or cloned the repo
3. run these commands to ensure it works properly:

    composer install
    npm install
    npm run dev
    php artisan key:generate
    php artisan migrate

5. Open MySQL Workbench and follow the settings i used (install MySQL Workbench if you dont have it yet):
![image](https://github.com/user-attachments/assets/64e62d0f-4865-4ab8-b276-cbf293877a14)

connection name: mixnbreed
db name: mixnbreed_db
password: (use your password that you set when you installed MySQL Workbench)

6. Adjust .env file:
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=mixnbreed_db
    DB_USERNAME=root
    DB_PASSWORD= (use your password that you set when you installed MySQL Workbench)
