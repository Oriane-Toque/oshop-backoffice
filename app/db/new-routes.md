# Routes

## Route category edit

```php
$router->map(
    'GET',
    '/category-edit/[i:id]',
    [
        'method' => 'categoryEdit',
        'controller' => '\App\Controllers\EditController'
    ],
    'edit-category'
);
```

## Route product edit

```php
$router->map(
    'GET',
    '/product-edit/[i:id]',
    [
        'method' => 'productEdit',
        'controller' => '\App\Controllers\EditController'
    ],
    'edit-product'
);
```

## Route type edit

```php
$router->map(
    'GET',
    '/type-edit/[i:id]',
    [
        'method' => 'typeEdit',
        'controller' => '\App\Controllers\EditController'
    ],
    'edit-type'
);
```

## Route brand edit

```php
$router->map(
    'GET',
    '/brand-edit/[i:id]',
    [
        'method' => 'brandEdit',
        'controller' => '\App\Controllers\EditController'
    ],
    'edit-brand'
);
```


## Route category add

```php
$router->map(
    'GET',
    '/category-add/[i:id]',
    [
        'method' => 'categoryAdd',
        'controller' => '\App\Controllers\AddController'
    ],
    'add-category'
);
```

## Route product add

```php
$router->map(
    'GET',
    '/product-add/[i:id]',
    [
        'method' => 'productAdd',
        'controller' => '\App\Controllers\AddController'
    ],
    'add-product'
);
```

## Route type add

```php
$router->map(
    'GET',
    '/type-add/[i:id]',
    [
        'method' => 'typeAdd',
        'controller' => '\App\Controllers\AddController'
    ],
    'add-type'
);
```

## Route brand add

```php
$router->map(
    'GET',
    '/brand-add/[i:id]',
    [
        'method' => 'brandAdd',
        'controller' => '\App\Controllers\AddController'
    ],
    'add-brand'
);
```

## Route category delete

```php
$router->map(
    'GET',
    '/category-delete/[i:id]',
    [
        'method' => 'categoryDelete',
        'controller' => '\App\Controllers\DeleteController'
    ],
    'delete-category'
);
```

## Route product delete

```php
$router->map(
    'GET',
    '/product-delete/[i:id]',
    [
        'method' => 'productDelete',
        'controller' => '\App\Controllers\DeleteController'
    ],
    'delete-product'
);
```

## Route type delete

```php
$router->map(
    'GET',
    '/type-delete/[i:id]',
    [
        'method' => 'typeDelete',
        'controller' => '\App\Controllers\DeleteController'
    ],
    'delete-type'
);
```

## Route brand delete

```php
$router->map(
    'GET',
    '/brand-delete/[i:id]',
    [
        'method' => 'brandDelete',
        'controller' => '\App\Controllers\DeleteController'
    ],
    'delete-brand'
);
```

## Route brand list

```php
$router->map(
    'GET',
    '/brands',
    [
        'method' => 'brands',
        'controller' => '\App\Controllers\CatalogController'
    ],
    'catalog-brands'
);
```

## Route type list

```php
$router->map(
    'GET',
    '/types',
    [
        'method' => 'types',
        'controller' => '\App\Controllers\CatalogController'
    ],
    'catalog-types'
);
```
