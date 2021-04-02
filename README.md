# Forum Discussion Project

All Real Forum's Features included in this project.You Should Try This out

## What Features Include in this project
- Authentication (email verification included)
- View user profile
- Thread create,update,delete
- Reply and Favorite on a thread
- Thread Subscription and Notifications
- Filter threads by Popularity,Channels,Trending threads(using viewers count of a thread)
- Activities Tracking(publish thread,reply on thread,favorite on reply) and show on their Profile
## Mainly Built With
- [Laravel](www.laravel.com) (Laravel is a free, open-source PHP web framework.This framework is what i mainly use in this project)
- [vuejs](https://vuejs.org/v2/guide/) (Vue is a progressive framework for building user interfaces.I used it for reactivity For some component like no refresh ajax favorite button component)

## Installation
1. Clone This Repo

2. Run This Command
```
    composer install
    npm install
    npm run dev
```
3. Create **.env** file in project directory and move .env_example codes to created .env file and run this  command
```
    php artisan key:generate
```
4. Create New Empty Database and connect in .env file
```
    DB_DATABASE=your_db_name
    DB_USERNAME=your_db_username
    DB_PASSWORD=your_db_password // if no password ,u can leave as blank
```
5. Run this command
```
    php artisan migrate
```
6. U can Add Sample Data To Database with This Command
```
    php artisan db:seed
```
7. U need to connect mailtrap for email verification in this project. So connect in **.env** file of your project. Get credentials keys from your mailtrap new project and fill this out.
```
    MAIL_HOST=smtp.mailtrap.io
    MAIL_PORT=2525
    MAIL_USERNAME=your_mailtrap_project_username
    MAIL_PASSWORD=your_mailtrap_project_password
    MAIL_ENCRYPTION=null
    MAIL_FROM_ADDRESS=your_mailtrap_project_address
```
8. Now U are good to go. Now u can test this project by run this command.
```
    php artisan serve
```