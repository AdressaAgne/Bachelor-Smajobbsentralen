
## Laravel Blade example:

```html
<div class="row">
    <h1>Hva kan vi hjelpe deg med?</h1>
    @foreach($cats as $cat)
    <div class="col-4 col-m-6">
        <a href="/smajobbere/{{$cat['id']}}">
            <div class="col-12 brick brick--big">
                <div>{{ucfirst($cat['name'])}}</div>
                <i class="fa fa-{{$cat['icon']}}"></i> 
            </div>
        </a>
    </div>
    @endforeach
</div>
```


## Controllers example:

```php
public function index(){
    return View::make('index', [
        'cats' => $this->all('kategorier'),
    ]);
}
```


## Controllers Request Method Injection example:

```php
public function login(Request $data){
    if($info = Account::login($data->post->username, $data->post->password, isset($data->post->rememberme))){
        Direct::re('/admin');
    } else {
        View::make('login', ['info' => $info]);
    }
}
```


## Route Setup Example:

```php

Direct::get('/test', function(){
    return '<h1>Denne siden er cachet</h1>'
})->cache();

Direct::post('/test', 'TestController@test');

Direct::put('/test', function(Request $request){
    return ['API' => $request];
});

```

## SQL injection example:

```php
DB::query("SELECT name, username FROM users WHERE id = :id", ['id' => 3])->fetchAll();
DB::select(['name', 'username'], 'users', ['id' => 3])->fetchAll();
```


## Froms and CSRF token example:

```html
@form('/login', 'put', ['class' => 'login'])
   <input type="text" placeholder="username">   
   <input type="password" placeholder="password"> 
@formend()
```



```html
<form action="/login" method="POST" class="login">
   <input type="hidden" name="_method" value="PUT">
   <input type="hidden" name="_token" value="ujbf23kd872niw9">
   <input type="text" placeholder="username">   
   <input type="password" placeholder="password"> 
</form>
```


```html
@csrf()
```


## SASS loop example:


```sass
@for $i from 1 to $iron-grid-columns+1
	.#{$iron-grid-col-name}-#{$i}
		width: (100% / $iron-grid-columns) * $i
```



## Dialog Module Example:

```js
showDialog('Er du sikker på at du vil fjerne denne arbeidstypen?', {
    Ja : function(){
            $.post({
                method : 'post',
                url: "",
                data: {
                    '_method' : 'DELETE',
                    '_token'  : '@csrf()',
                    'id' 	  : id
                },
                success : function(){
                    _this.slideUp();
                },
                error : function(){
                    showDialog('noe gikk dessverre galt under fjerning av arbeidstype. Prøv igjen senere', {ok : ''})
                    console.log("fail");
                }
            });//ajax
    },
    Nei : function(){

    }
});
```


## Javascript RegEx Example:

```js
/^[a-zA-Z- æøåÆØÅ]+$/;

```

## Grid Framework Example:

```sass
// Large
@media (min-width: $iron-grid-breakpoint-large)
	@for $i from 1 to $iron-grid-columns+1
		.#{$iron-grid-col-name}-#{$iron-grid-breakpoint-large-name}-#{$i}
			width: (100% / $iron-grid-columns) * $i


// Normal
@for $i from 1 to $iron-grid-columns+1
	.#{$iron-grid-col-name}-#{$i}
		width: (100% / $iron-grid-columns) * $i


// Tablet
@media (max-width: $iron-grid-breakpoint-medium)
	@for $i from 1 to $iron-grid-columns+1
		.#{$iron-grid-col-name}-#{$iron-grid-breakpoint-medium-name}-#{$i}
			width: (100% / $iron-grid-columns) * $i

// Phone
@media (max-width: $iron-grid-breakpoint-small)
	@for $i from 1 to $iron-grid-columns+1
		.#{$iron-grid-col-name}-#{$i}
			width: 100%

		.#{$iron-grid-col-name}-#{$iron-grid-breakpoint-small-name}-#{$i}
			width: (100% / $iron-grid-columns) * $i

	.#{$iron-grid-col-name}--center
		padding-left: 0px

```


