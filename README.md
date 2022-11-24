# How to

## Install nodejs if you don't have it already <br>
https://nodejs.org/en/download/

## Where ever your php installation is <br>
uncomment `extension=pdo_mysql` in `php.ini` 

## First time setup
run xampp apache & mysql <br>
in the project directory run, <br>
`php artisan migrate:fresh --seed` *<- this should ask you to create a new database* <br>
`npm install`

## To run
`php artisan serve` <br>
`npm run dev` <br>
run xampp apache & mysql

Everything should work hopefully now

Main files <br>
```
STANCE  
├── app  
│   └── Http
│       ├── Controllers
│       │   └── AuthController.php
│       │   └── ProductController.php
│       └── Middlware
│           └── AuthCheck.php
├── resources
│   └── views
│       └── *.php
└── routes
    └── web.php
```
