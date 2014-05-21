kiosk-manager
=============

PHP web app for creating and managing xml files for KioskPro


Configuration Items:

/lib/functions/authUser.php -> active directory domain controllers
/lib/application.php -> add a case statement for your server to control DB connection (line 44)

Expected Environment:

Linux based web server (I think windows would work too, but not tested)
Apache2
MySQL
Available Active Directory for password authentication

Dependencies (included, but noted here):

adLDAP


Basic Installation Instructions:

1. execute the sql against a mysql database. Make sure you have a username that will work with the db.
2. You’ll need to insert a record into the authorized_users table with the role of ‘u’ to be able to log in
3. in authUser add your Active Directory domain controllers. This tool uses an integrated login with Active Directory
4. in application.php add the database connection details.
5. point your web server root to the public_html folder. The lib area is included through requires.
6. it should work, however your mileage may vary…

@mattbaylor
