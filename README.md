# eloquent-searchable

![Packagist Version](https://img.shields.io/packagist/v/dvsoftsrl/eloquent-searchable?label=Version&style=flat-square)
[![GitHub Workflow Status](https://img.shields.io/github/workflow/status/dvsoftsrl/eloquent-searchable/CI?style=flat-square)](https://github.com/dvsoftsrl/eloquent-searchable/actions)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Total Downloads](https://img.shields.io/packagist/dt/dvsoftsrl/eloquent-searchable.svg?style=flat-square)](https://packagist.org/packages/dvsoftsrl/eloquent-searchable)

## Install

```bash
composer require dvsoftsrl/eloquent-searchable
```

## Usage

### Eloquent Model

For using uuid in your Eloquent Model, just put `use EloquentSearchableTrait;`:

```php
<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DvSoft\EloquentSearchable\EloquentSearchableTrait;

class Post extends Model
{
    use EloquentSearchableTrait;
    
    // You can specify the columns to search on
    protected $searchable = ['tile', 'excerpt'];
}
```

### Search:

After that, you can search on your model:

```php
    $posts = Post::search($query)->get();
```

You can use it with every other eloquent methods

```php
    $posts = Post::where('published', true)->search($query)->paginate();
```

You can require that the search query match all fields by adding _true_ at second parameter:

```php
    $posts = Post::search($query, true)->get();
```

## Testing

Run the tests with:

```bash
vendor/bin/phpunit
```

## Security

If you discover any security-related issues, please email developers@dvsoft.it instead of using the issue tracker.

## Credits

- [DV Soft srl](https://github.com/dvsoftsrl)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](/LICENSE.md) for more information.