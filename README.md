## Server Installation

**1)** Server file structure should be like below. `public_html` folder is alread exist in your server. Create new folder `spotoffers_backend` and add all files of backend to that folder. All public files add to `public_html` folder.
```
..
..
spotoffers_backend/
public_html/
..
..
```
- **public_html** https://github.com/chamara96/seo-public
- **spotoffers_backend** https://github.com/chamara96/seo-backend-new

---

**2)** Create a MySQL database in your host. Then Import the SQL file `spotoffers_database.sql` inside `spotoffers_backend/database` folder to your recently created database. After the succussfully import, Then chanage the specific lines in `.env` file inside the `spotoffers_backend` folder as below:
database name,
databse user username
databse user password
```
12. DB_DATABASE=spotoffers_database
13. DB_USERNAME=root
14. DB_PASSWORD=
```

---

**3)** Change the `APP_URL` in line 5, to your web domain in the `.env` file inside the `spotoffers_backend` folder as below:
```
5. APP_URL=http://spotoffers.com
```

---

**4)** Go to the therminal of your server. locate to inside the `spotoffers_backend` folder.
```sh
composer install
```

then type below two commands:
```sh
php artisan key:generate
```
```sh
php artisan storage:link
```

---

**5)** To Check type below command in the terminal, this command will not be an error. This command shoud return *Laravel development server started: http://127.0.0.1:8000*
```sh
php artisan serve
```

---

**6)** http://www.your-domain.com/admin
Default login credentials:

```sh
User: super@admin.com
Pass: 1234
```

---

**7)** Change the all settings under the `/admin/settings`

- **Email for Contact us (email_contact_us)** `email address for receive emails from contact us response`
- **Email (email)** `Admin email address`
- **MAIL_HOST (mail_host)** `Admin email host`
- **MAIL_PORT (mail_port)** `Admin email port`
- **MAIL_USERNAME (mail_username)** `Admin email username`
- **MAIL_PASSWORD (mail_password)** `Admin email password`
- **MAIL_ENCRYPTION (mail_encryption)** `Admin email encryption type`

- **Awaiting Subject (awaiting_subject)** `Subject of Awaiting job response`
- **Reviewed Subject (reviewed_subject)** `Subject of Reviewd job response`
- **Rejected Subject (rejected_subject)**   `Subject of Rejected job response`

- **Email Template (email_temp)**   `Body of job response`

---

### Custom Routes

Clear All Cache
```sh
http://your-domain/clear-cache
```
```sh
http://your-domain/cache
```

this is a shortcut route clear all cache including config, route and more
