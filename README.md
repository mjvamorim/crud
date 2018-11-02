#Tenant  1.0.1
This package provider a database tenant soluction which database connection is choice based on company/user select on login;

Add to your composer.json
 "repositories": [
        {
            "type": "path",
            "url": "packages/mjvamorim/crud",
            "options": {
                "symlink": true
            }
        },

cd packages
git clone https://github.com/mjvamorim/crud.git

composer require mjvamorim/crud
composer update

php artisan config:cache
php artisan vendor:publish --provider="Amorim\Crud\CrudServiceProvider"

Edit "/config/crud.php" and put your modelName and full_Qualifier_Class
ex:
return [
    'doctor' => 'App\Models\Doctor',
    'user' => 'App\User',
    'yourmodel' => 'App\YourModel',
];

Run your app and call this route
http://your_site/crud/yourmodel