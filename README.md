#TALL FLUXO


#EXEMPLOS
#CONFIG DATABASES

#DEFAULT COMMANDS
```

./vendor/bin/sail artisan vendor:publish --tag=tall-fluxo-migrations

./vendor/bin/sail artisan migrate --database=landlord --path=/database/migrations/landlord
./vendor/bin/sail artisan migrate:fresh --database=landlord --path=/database/migrations/landlord
 
```

```
 ./vendor/bin/sail artisan migrate --database=mysql
 ./vendor/bin/sail artisan migrate:fresh --database=mysql

```` 