## Laravel Blog with AdminLTE3 Dashboard

1. Clone the repository with git clone

2. Run cp .env.example .env file to copy example file to .env
Then edit your .env file with DB credentials and other settings.

3. Run composer install command

4. Run php artisan migrate --seed command.
Notice: seed is important, because it will create the first admin user for you.

5. Run php artisan key:generate command.

6. Run php artisan storage:link

<p>And that's it, go to your domain and login:</p>

<ul>
<li>Username:	admin@admin.com</li>
<li>Password:	password</li>
</ul>

## License

Basically, feel free to use and re-use any way you want.
