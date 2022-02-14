# FauzanAldi Laravel Kirim.Email

# Laravel Kirim Email
## Plugin untuk Integrasi Laravel dan kirim.email


## Features

- Manage List
- Manage Broadcast
- Manage Subscriber
- Manage Form
- Manage Landing Form



## Installation

Laravel Kirim Email mewajibkan kita menginstal Guzzle HTTP client,.

```sh
composer require guzzlehttp/guzzle
```

Setelah Kita Berhasil Menginstal Laravel dan Guzzle HTTP Client. Kemudian kita instal plugin ini 

```sh
composer require aldif/laravel-kirimemail
```

Setelah Berhasil Menginstal kita tambahkan plugin ini pada file config/app.php. Pada bagian Providers dan Facade 

```sh
'providers' => [
        Aldif\LaravelKirimemail\LaravelKirimEmailProvider::class,
    ],
```

```sh
'aliases' => [

        
        'KirimEmail' => Aldif\LaravelKirimemail\Facades\LaravelKirimEmailFacade::class,
    ],
```

## Konfigurasi

Kemudian buatlah File config/kirimemail.php

```sh
<?php

return array(
    'username' => '', // username kirim.email
    'apitoken' => '', // apitoken kirim.email
    'baseURLApi' => 'https://api.kirim.email/',
    'CheckConnectionURL' => 'v3/list',
    'category' => [

        'list' => [
            'getall' => 'v3/list',
            'getbyid' => 'v3/list/{id}',
            'create' => 'v3/list',
            'update' => 'v3/list/{id}',
            'delete' => 'v3/list/{id}',
        ],

        'broadcast' => [
            'getall' => 'v3/broadcast',
            'getbyid' => 'v3/broadcast/{id}',
            'create' => 'v3/broadcast',
            'update' => 'v3/broadcast/{id}',
            'delete' => 'v3/broadcast/{id}',
        ],

        'subscriber' => [
            'getall' => 'v3/subscriber/',
            'getbyid' => 'v3/subscriber/{id}',
            'create' => 'v3/subscriber/',
            'update' => 'v3/subscriber/{id}',
            'delete' => 'v3/subscriber/{id}',
        ],

        'subscriber_field' => [
            'getall' => 'v3/subscriber_field',
            'getbyid' => 'v3/subscriber_field/{id}',
            'create' => 'v3/subscriber_field',
            'update' => 'v3/subscriber_field/{id}',
            'delete' => 'v3/subscriber_field/{id}',
        ],
    ],
    'sender' => 'notif@mail21.literasidigital.id'
); 
```


## Penggunaan

Get All:

```sh
Route::get('/', function () {

    \KirimEmail::getAll('list');
    
}
```

Get By ID:

```sh
\KirimEmail::getById('broadcast','id');
```

Create :

```sh
\KirimEmail::create('broadcast',[
        'title' => 'Testing Membuat broadcast',
        'sender' => config('kirimemail.sender'),
        'list' => 2,
        'messages'=> [
            'subject' => 'Testing Membuat Broadcast',
            'content' => '<h1>testing</h1>'
        ],
        'send_at' => '2022-02-14 11:10:10'
    ]);
```

Update :

```sh
\KirimEmail::create('list',[
        'name' => 'Update nama list'
    ]);
```

Delete:

```sh
\KirimEmail::delById('broadcast','id');
```



## License

MIT


