# Interview Resolution

## Requirements
- **php7** (with mongodb, curl extension)
- **phpunit** (for tests)
- **mongodb server**

#### Command to install requirements (Ubuntu/Debian)
>sudo apt-get -y install git composer apache2 apache2-utils php php-mongodb mongodb mongodb-clients mongodb-server libapache2-mod-php php-opcache php-calendar php-curl php-json php-mbstring php-readline php-xml php-xsl php php7.0-bcmath php7.0-dev php7.0-json php7.0-opcache php7.0-soap php7.0-bz2 php7.0-enchant php7.0-ldap php7.0-pgsql php7.0-sqlite3 php7.0-cgi php7.0-mapi php7.0-sybase php7.0-cli php7.0-gd php7.0-mbstring php7.0-pspell php7.0-tidy php7.0-common php7.0-mcrypt php7.0-readline php7.0-xml php7.0-curl php7.0-imap php7.0-recode php7.0-xmlrpc php7.0-dba php7.0-interbase php7.0-mysql php7.0-intl php7.0-odbc php7.0-zip phpunit



## Initialize MongoDB

>sudo service mongodb start


Open Mongo shell
>mongo

Create Neos database
>use neos_data

Populate with a simple data to create files and persist neos_data creation
>v = { Version : "0.1" }
>db.testData.insert( v );

CTRL + C to exit

## Install Neos
>git clone https://github.com/leonmbj/basic-backend-interview-test.git

>cd basic-backend-interview-test/

>composer update

You may give permission to writes on cache folder

>sudo chmod -R 777 var/cache/ && sudo chmod -R 777 var/logs/

## Using Neos

Command to request the data from the last 3 days from NASA API
>php bin/console neos:fetch-data 

This will save documents on MongoDB with info about the asteroids from latest 3 days 

"Hello World" from neos

>http://localhost/basic-backend-interview-test/web/app_dev.php/

To display all DB entries which contain potentially hazardous asteroids

>http://localhost/basic-backend-interview-test/web/app_dev.php<b>/neo/hazardous</b>


To analyze all data, calculate and return the the fastest hazardous asteroid. Use <b>hazardous=false</b> to show the fastest non-hazardous asteroid.

>http://localhost/basic-backend-interview-test/web/app_dev.php<b>/neo/fastest?hazardous=true</b>

To analyze all data, calculate and return the year with most hazardous asteroids. Use <b>hazardous=false</b> to show the year with most non-hazardous asteroids.

>http://localhost/basic-backend-interview-test/web/app_dev.php<b>/neo/best-year?hazardous=true</b>

To analyze all data, calculate and return the month with most hazardous asteroids. Use <b>hazardous=false</b> to show the month with most non-hazardous asteroids.

>http://localhost/basic-backend-interview-test/web/app_dev.php<b>/neo/best-month?hazardous=true</b>

### Testing

To run phpunit tests, do the command:

>./vendor/phpunit/phpunit/phpunit --debug src/

### Start Project with Simphony's own web server

The urls above are to normal apache install. If you want to use Simphony's own web server, enter on project's root folder, and do:

>php bin/console server:start

Then, open browser at http://localhost:8000


## More ...

#### About Symfony
Symfony is the required/recommended framework for this interview. It is a good framework, many inprovements were made since Symfony 2, but I had less dificulties with Yii2 or Laravel. I've already worked with Symfony 2 at iTriad (Alcatel outsource)  for almos 2 years and we had bad moments with it, especially because of Doctrine's bad performance, ORM, losing it, cache issues, etc. But, It was with Symfony 2, not 3, tha looks a lot simplier.


#### About MongoDB
MongoDB, which is better than MySQL when you are working with simpler, more difuse and non-relational data. This gives you more speed on some applications.


<hr>


# Basic Backend Developer Interview

Dear candidate, please follow this readme and solve all questions.

> Before you can start, you should prepare your development environment.

**This test requires:**
- access to the internet
- your favourite IDE
- (PHP) working dev environment with PHP 7 and symfony 3.x
- (Node) working dev environment with Node.js LTS
- database (MongoDB, Postgres, MySQL)
- nginx or alternative simple dev web server

**Good luck!**


--------


## Test tasks:

**NOTE:** You are free to use any framework you wish. Bonus points for an explanation of your choice.

1. Specify a default controller
  - for route `/`
  - with a proper json return `{"hello":"world!"}`

2. Use the api.nasa.gov
  - the API-KEY is `N7LkblDsc5aen05FJqBQ8wU4qSdmsftwJagVK7UD`
  - documentation: https://api.nasa.gov/api.html#neows-feed
  
3. Write a command
  - to request the data from the last 3 days from nasa api
  - response contains count of Near-Earth Objects (NEOs)
  - persist the values in your DB
  - Define the model as follows:
    - date
    - reference (neo_reference_id)
    - name
    - speed (kilometers_per_hour)
    - is hazardous (is_potentially_hazardous_asteroid)

4. Create a route `/neo/hazardous`
  - display all DB entries which contain potentially hazardous asteroids
  - format JSON

5. Create a route `/neo/fastest?hazardous=(true|false)`
  - analyze all data
  - calculate and return the model of the fastest asteroid
  - with a hazardous parameter, where `true` means `is hazardous`
  - default hazardous value is `false`
  - format JSON

6. Create a route `/neo/best-year?hazardous=(true|false)`
  - analyze all data
  - calculate and return a year with most asteroids
  - with a hazardous parameter, where `true` means `is hazardous`
  - default hazardous value is `false`
  - format JSON

7. Create a route `/neo/best-month?hazardous=(true|false)`
  - analyze all data
  - calculate and return a month with most asteroids (not a month in a year)
  - with a hazardous parameter, where `true` means `is hazardous`
  - default hazardous value is `false`
  - format JSON
   
## Additional Instructions

- Fork this repository
- Tests are not optional
- (PHP) Symfony is the expected framework
- After you're done, provide us the link to your repository.
- Leave comments where you were not sure how to properly proceed.
- Implementations without a README will be automatically rejected.

## Bonus Points

- Clean code!
- Knowledge of application flow.
- Knowledge of modern best practices/coding patterns.
- Componential thinking.
- Knowledge of Docker.
- Usage of MongoDB as persistance storage.
