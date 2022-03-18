# Admin User API boilerplate project
This is a sample learning project to create admin and user login and their separate functionality based on who is logged in

In this project we have used multiple guards and separated those on basis of loged in as admin or user


## OpenAPI documentation
We have used darkaonline/l5-swagger(8.x)

##Specifications


- PHP : 7.2

- Laravel : 7

- Darkaonline/l5-swagger : 8.0.2 
    - https://quickadminpanel.com/blog/laravel-api-documentation-with-openapiswagger/

- PHP-CS-Fixer
    - https://ddmler.github.io/laravel/linter/2018/03/12/using-php-cs-fixer-in-laravel.html
   
  

##Create Roles and permission
- php artisan permission:create-role influencer users "create-content|edit-content|view-content|delete-content"
##Reset premission cache
- php artisan cache:forget spatie.permission.cache
##Restricting access based on role or permission
- $this->middleware('permission:edit articles')->only('testmiddleware');
- $this->middleware('role:admin|writer')->only('testmiddleware');

##Roles permissions document 
- https://spatie.be/docs/laravel-permission/v5/basic-usage/basic-usage

