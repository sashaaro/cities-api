The Cities API
==========================

Setup
~~~
    bin/console doctrine:schema:update --force
    bin/console fos:user:create
~~~

Make sure request returns 401
~~~
    curl -I -X GET --header 'Accept: application/json' 'http://localhost/app_dev.php/api/countries'
~~~

Add oauth client
~~~
    bin/console app:init
~~~

Example
~~~
    curl -X POST --data 'grant_type=password&username=alex&password=alex&client_id=2_2wdj2duqomeccwcksgws4wowgo88wokgw88k0sswccg88ws4cw&client_secret=46iis51qsh0kgo80o8cgg0cwsoo0wccgs4gocok0sgg0w0gwkw' --header 'Accept: application/json' 'http://localhost/app_dev.php/oauth/v2/token'
    curl -X GET --header 'Accept: application/json' --header 'Authorization: Bearer ZDQyNzVjNDU1N2ZiYmNmMDM5ZDU0N2NiN2UwNTZhMzFmNzI5NDljZDU3MWM4MzI4ODdjN2YyMjYyODU2ZWU1OQ' 'http://localhost/app_dev.php/api/countries'
~~~

Add `ROLE_ADMIN` for user
~~~
    bin/console fos:user:promote
~~~

Open browser `http://localhost/app_dev.php/admin`