MVC and CMS made by Agne Ødegaard


# Backend Documentation

## Logic and Basic Template - App/Controllers

View Logic is run here then passed as variables to the views.
```php
namespace App\Controllers;

use View;

class MainController extends Controller {
   public function index($params){
      $username = $params['username'];
      return View::make('index', [
         'var' => $username,
      ]);
   }
}
```
$params is _$_GET_ and _$_POST_ merged together
To make a JSON API just return an array insted of a View.

## Setup a view - App/Routing/RouteSetup.php
### Get Requests
This wil run the index method in the MainController class.
```php
Direct::get("/", 'MainController@index');
```

### Post Requests
This wil run the submit method in the MainController class when a post request is made to /submit
it will set two get variables _$_GET['mail']_ and _$_GET['text']_ to whatever the url says.
```php
Direct::post("/submit/{mail}/{text}", 'MainController@submit');
```
Or you could just use normal _$_POST_ variables
```php
Direct::post("/submit", 'MainController@submit');
```

_Note:_ put, post, patch, delete requires a csrf token. 

### Other HTTP requests
```php
Direct::put("/page", 'controller@method');
Direct::delete("/page", 'controller@method');
Direct::patch("/page", 'controller@method');
Direct::err("404", 'controller@method');
```

### Auth for HTTP requests
By using ->Auth() this will require a user to be logged inn. ->admin() requeris the logged inn user to be an admin
```php
Direct::get("/profile", 'controller@method')->auth($callback);
Direct::get("/admin", 'controller@method')->admin($callback);
```

## Database (App/Database/Database)

### Init
Use the App/Config.php to enter your database login information
All Controllers extend DB, so you can do $this->query() instead.
### Queries
```php
// Basic query
DB::query($SQL, [$params], $class);
DB::query("SELECT name, username FROM users WHERE id = :id", ['id' => 3]);
DB::query("SELECT name, username FROM users WHERE id = :id", ['id' => 3], 'User');
DB::query("SELECT name, username FROM users", 'User']);

//Select
DB::select($table, [$rows...], [$where], $join = 'AND');
DB::select($table, [$rows...], [$where], $class = null);
DB::select('users', ['name', 'username'], ['id' => 3, 'id' => 4], 'OR');
DB::select('users', ['name', 'username'], 'users', ['id' => 3, 'id' => 4], 'Recipe');

// Select everything
DB::all($table, [$rows]);
DB::all('users', ['name', 'username']);

//Insert rows
DB::insert($table, [[$row => $value]]);
DB::insert('users', [['name' => 'Frank'],['name' => 'George']]);

//Update rows
DB::update($table, [$rows], [$where], $rowsjoin = '=', $wherejoin = 'AND');
DB::update('users', ['name' => 'ron'], ['name' => 'Frank']);

//Delete a row
DB::deleteWhere($table, $col = 'id', $val = 0);
DB::deleteWhere('users', 'id', 10);
```

### Creating a table / Migrations (App/Database/Migration)
```php
$db = new DB();

$db->createTable('users', [
   new PID(), // Primary Key ID
   new Row('username', 'varchar'),
   new Row('password', 'varchar'),
   new Row('mail', 'varchar'),
   new Timestamp(),
]);

new Row($name, $type, $default = null, $not_null = true, $auto_increment = false);
```

## Caching
The framework will cache all pages and store them as html files in _/assets/cache/_ with name cached_url_path.html, the cache time can be changed in config.php, defaults to 3600s/1h.


## Security
###  SQL injection & Secondary SQL injection
By using the DB class everything is escaped, so you dont need to worry about SQL injection, if you use this all the time you will be safe.
```php
DB::query("SELECT name, username FROM users WHERE id = :id", ['id' => 3])->fetchAll();
DB::select(['name', 'username'], 'users', ['id' => 3])->fetchAll();
```
### XSS Injection
Using {{ }} to echo out will add a htmlspecialchars() function around
```html
{{ $variable }}
```
Using {! !} will echo a raw string, without htmlspecialchars(). Be carefull with this one.
```html
{! $variable !}
```

### CSRF token
Cross-site Request Forgery token are added to prevent people from spamming post requests from other sites.
This will echo out a form with both _method and _token
```html
@form('/login', 'put', ['class' => 'login'])
   <input type="text" placeholder="username">   
   <input type="password" placeholder="password"> 
@formend()
```

Will output:

```html
<form action="/login" method="POST" class="login">
   <input type="hidden" name="_method" value="PUT">
   <input type="hidden" name="_token" value="ujbf23kd872niw9">
   <input type="text" placeholder="username">   
   <input type="password" placeholder="password"> 
</form>
```

This will echo out the csrf token
```html
   @csrf()
```

## Views and HTML
Views are stores in view/<theme>/view
Please don't write any logic in a view, use the controller and pas data to the view as variables.

All files in the current theme is accesable with @layout('file', [vars]), for an admin page use @panel('file', [vars])

```html
@layout('layout.head')

<h1>Basic intruction; how to use this.</h1>


<h2>Echo php stuff</h2>
{{ $var }}

<h2>Echo Raw Code</h2>
{!  $user !}

<h2>if</h2>

@if(1 == 1)

<h3>yay 1 = 1</h3>

@else

<h3>boo 1 != 1</h3>

@endif

<h2>foreach loop</h2>

@foreach($arr as $key => $value)

<div>
    <h3>{{ $key }}</h3>
    <p>{{ $value }}</p>
</div>

@endforeach


<h2>for loop</h2>

@for($i = 0; $i > count($arr); $i++)

<div>
    <h3>{{ $i }}</h3>
    <p>{{ $arr[$i] }}</p>
</div>

@endfor


@layout('layout.foot')
```

### Global Variables

$assets is a global var that outputs the themes assets directory
```html
{{$assets}}
```

*others:*

* assets (string)
* menu (array)
* user (User Object, currently logged in user)
* settings (array, all the page settings)


# Content Management System

The admin panel is located at /admin.

* Media uploader
* create and manage different types of pages
* create and manage posts in different styles for blogs or other pages
* Theme support!
* stand alone admin panel
* You can still make custome pages with the MVC backend.

## posts

A post is a simple version of a page, all pages can have a parent page, if they have a parent they are a post. all the post php files are located in the view/posts folder.

adding a post to a page can be done on the admin panel under posts.

## Pages

In a theme there is a view/pages folder where all the different types of pages are stored.
To add a new page, go to the page panel on the admin site an create a new page. 

If you want other options of pages you can simple create a new file in view/pages, to your own liking.



## Custome theme Controllers

to add a controller for a page in your theme, add a file with the same name to themefolder/Controllers/name.php

the file should look like this:
```php
<?php

class frontpage {
    private $db;
    
    function __construct($db) {
        $this->db = $db;
    }
}

```
the constructor takes one parameter that is the database class, where you can access the db.


## Theme Migration

In your controller folder add a Migrate folder with a migrate.php file, it should look something like this:
```php
<?php

class migrate {
    
    public function install(){
        $db->createTable('tablename', [
            new PID(), // Primary ID
            new Timestamp(),
            new Row('name', 'varchar'),
            new Row('icon', 'varchar'),
        ]);
    }
    
    public function populate(){
        
        $db->insert('opningstider', [
			[
				'day' => 2, // tirsdag
				'from_time' => '10:00',
				'to_time' => '12:00',
			],
			[
				'day' => 4, // torsdag
				'from_time' => '10:00',
				'to_time' => '12:00',
			],
		]);
        
    }
    
}


```

This file will run when you run the MigrateTrait on /migrate

todo: 

* [ ] Admin pages should have a standalone css, that is not depended on the theme.