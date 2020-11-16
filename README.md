# Server Installation

> 1) Server file structure should be like below. `public_html` folder is alread exist in your server. Create new folder `spotoffers_backend` and add all files of backend to that folder. All public files add to `public_html` folder.
```
..
..
spotoffers_backend/
public_html/
..
..
```
- public_html https://github.com/chamara96/seo-public
- spotoffers_backend https://github.com/chamara96/seo-backend-new

> 2) Create a MySQL database in your host. Then Import the SQL file `spotoffers_database.sql` inside `spotoffers_backend/database` folder to your recently created database. After the succussfully import, Then chanage the specific lines in `.env` file inside the `spotoffers_backend` folder as below:
database name,
databse user username
databse user password
```
12. DB_DATABASE=spotoffers_database
13. DB_USERNAME=root
14. DB_PASSWORD=
```

> 3) Change the `APP_URL` in line 5, to your web domain in the `.env` file inside the `spotoffers_backend` folder as below:
```
5. APP_URL=http://spotoffers.com
```

> 4) Go to the therminal of your server. locate to inside the `spotoffers_backend` folder.
`composer install`

then type below two commands:
`php artisan key:generate`
`php artisan storage:link`

> 5) To Check type below command in the terminal, this command will not be an error. It shoud *Laravel development server started: http://127.0.0.1:8000*
`php artisan serve`

> 6) http://www.your-domain.com/admin
Default login credentials:

```
User: super@admin.com
Pass: 1234
```


### Custom Routes

Clear All Cache
`http://your-domain/clear-cache`
`http://your-domain/cache`

this is a shortcut route clear all cache including config, route and more
