yii2-dohclient
==============



การติดตั้ง
------------

สามารถติดตั้งผ่าน composer โดยรันคำสั่ง
```
php composer require --prefer-dist departmentofhealth/yii2-dohclient "*"
```

หรือเพิ่มคำสั่งนี้

```
"departmentofhealth/yii2-dohclient": "*"
```

ที่ไฟล์  `composer.json` ในส่วนของ require


การใช้งานร่วมกับ [yii2-user](https://github.com/dektrium/yii2-user)
-----

ตั้งค่า authClientCollection ที่ main.php ใสส่วนของ components

```php
...

        'authClientCollection' => [
            'class'   => \yii\authclient\Collection::className(),
            'httpClient' => [
                'transport' => 'yii\httpclient\CurlTransport',
            ],
            'clients' => [
               'doh' => [
                    'class' => 'departmentofhealth\yii2\dohclient\DohClientDektrium',
                    'clientId' => '<clientID>',
                    'clientSecret' => '<ClientSecret>',
                ],
            ],
        ],
...
```

ทำการ override view [yii2-user](https://github.com/dektrium/yii2-user/blob/0.9.12/docs/overriding-views.md) และเรียกใช้งาน widget ที่หน้า login

```php
<?php
    $authAuthChoice = AuthChoice::begin([
        'baseAuthUrl' => ['/user/security/auth'],
        'popupMode' => false,
        'options'=>[
            'class'=>'auth-clients text-center',
        ]
    ]);
    echo 'Login with: ';
    foreach ($authAuthChoice->getClients() as $key => $client): ?>
<?= $authAuthChoice->clientLink($client,strtoupper($key));?>
<?php endforeach; ?>
<?php AuthChoice::end(); ?>

```


