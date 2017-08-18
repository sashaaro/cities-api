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
bin/console app:oauth2:create-client
bin/console app:fixtures:load
~~~

Get token
~~~
curl -X POST --data 'grant_type=password&username=alex&password=alex&client_id=2_2wdj2duqomeccwcksgws4wowgo88wokgw88k0sswccg88ws4cw&client_secret=46iis51qsh0kgo80o8cgg0cwsoo0wccgs4gocok0sgg0w0gwkw' --header 'Accept: application/json' 'http://localhost/app_dev.php/oauth/v2/token'
~~~

Get list
~~~
curl -X GET --header 'Accept: application/json' --header 'Authorization: Bearer ZDQyNzVjNDU1N2ZiYmNmMDM5ZDU0N2NiN2UwNTZhMzFmNzI5NDljZDU3MWM4MzI4ODdjN2YyMjYyODU2ZWU1OQ' 'http://localhost/app_dev.php/api/countries'
~~~

Create city
~~~
curl -X POST --header 'Content-Type: application/json' --header 'Accept: application/json' --header 'Authorization: Bearer ZDQyNzVjNDU1N2ZiYmNmMDM5ZDU0N2NiN2UwNTZhMzFmNzI5NDljZDU3MWM4MzI4ODdjN2YyMjYyODU2ZWU1OQ' -d '{"name": "Люберцы", "region": "/api/regions/1" }' 'http://localhost/app_dev.php/api/cities'
~~~

Update city
~~~
curl -X PUT --header 'Content-Type: application/json' --header 'Accept: application/json' -d '{ "name": "Балашиха"}' --header 'Authorization: Bearer ZDQyNzVjNDU1N2ZiYmNmMDM5ZDU0N2NiN2UwNTZhMzFmNzI5NDljZDU3MWM4MzI4ODdjN2YyMjYyODU2ZWU1OQ' 'http://localhost/app_dev.php/api/cities/7'
~~~

Check location
~~~
curl -X GET --header 'Accept: application/json' http://localhost/app_dev.php/api/check_location?lat=37.356805&lng=-121.998269&address=1600%20Amphitheatre%20Parkway,%20Mountain+View,%20CA&radius=6
~~~

Add `ROLE_ADMIN` for user
~~~
bin/console fos:user:promote
~~~

Open browser `http://localhost/app_dev.php/admin`