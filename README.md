#TALL STATUS


#EXEMPLOS
#RPPS
#CONFIG DATABASES

```

        'landlord' => [
            'driver' => 'mysql',
            'url' => env('DATABASE_URL_LANDLORD'),
            'host' => env('DB_HOST_LANDLORD', '127.0.0.1'),
            'port' => env('DB_PORT_LANDLORD', '3306'),
            'database' => env('DB_DATABASE_LANDLORD', 'forge'),
            'username' => env('DB_USERNAME_LANDLORD', 'forge'),
            'password' => env('DB_PASSWORD_LANDLORD', ''),
            'unix_socket' => env('DB_SOCKET_LANDLORD', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'prefix_indexes' => true,
            'strict' => true,
            'engine' => null,
            'options' => extension_loaded('pdo_mysql') ? array_filter([
                PDO::MYSQL_ATTR_SSL_CA => env('MYSQL_ATTR_SSL_CA'),
            ]) : [],
        ],
        'backup' => [
            'driver' => 'mysql',
            'url' => env('DATABASE_URL_BACKUP'),
            'host' => env('DB_HOST_BACKUP', '127.0.0.1'),
            'port' => env('DB_PORT_BACKUP', '3306'),
            'database' => env('DB_DATABASE_BACKUP', 'forge'),
            'username' => env('DB_USERNAME_BACKUP', 'forge'),
            'password' => env('DB_PASSWORD_BACKUP', ''),
            'unix_socket' => env('DB_SOCKET_BACKUP', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'prefix_indexes' => true,
            'strict' => true,
            'engine' => null,
            'options' => extension_loaded('pdo_mysql') ? array_filter([
                PDO::MYSQL_ATTR_SSL_CA => env('MYSQL_ATTR_SSL_CA'),
            ]) : [],
        ],

```
#DEFAULT COMMANDS
```
./vendor/bin/sail artisan migrate --database=landlord --path=/database/migrations/landlord
./vendor/bin/sail artisan migrate:fresh --database=landlord --path=/database/migrations/landlord

 ./vendor/bin/sail artisan db:seed --class=LandlordSeeder

 ./vendor/bin/sail artisan db:seed --class=RoleAndPermissionsSeeder
 
```

```
 ./vendor/bin/sail artisan migrate --database=mysql
 ./vendor/bin/sail artisan migrate:fresh --database=mysql

./vendor/bin/sail artisan db:seed --class=TenantSeeder

./vendor/bin/sail artisan db:seed --class=MenusSeeder
```` 

#COMMANDS

```
... artisan make:crud path-do-component Model 

Exemplo artisan make:crud posts Post

vai gerar 5 components
/Http/Livewire/Admin/Pots/ListComponent.php
/Http/Livewire/Admin/Pots/CreateComponent.php
/Http/Livewire/Admin/Pots/EditComponent.php
/Http/Livewire/Admin/Pots/ShowComponent.php
/Http/Livewire/Admin/Pots/DeleteComponent.php
ou
... artisan make:crud posts.categorias Post
/Http/Livewire/Admin/Pots/Categorias/ListComponent.php
....

#CRIAR PAGINAS E MAIS COMPLEXO

https://www.youtube.com/watch?v=sbCFQygJKE8

```
#FILTROS API CONTROLLER

```
<?php
/**
* Created by Bengs.
* User: contato@bengs.com.br
* https://www.bengs.com.br
*/
namespace App\Http\Controllers\Api\Categories\Filters;

use App\Http\Controllers\Controller;

use App\Models\Category;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class Index extends Controller
{
    public function __invoke(Request $request): Collection
    {
        return Category::query()
            ->select('id', 'name')
            ->orderBy('name')
            ->when($request->search,fn (Builder $query) => $query->where('name', 'like', "%{$request->search}%")
            )
            ->when($request->exists('selected'),fn (Builder $query) => $query->orWhereIn('id', $request->input('selected', [])),
                fn (Builder $query) => $query->limit(10)
            )
            ->get();
    }
}

```