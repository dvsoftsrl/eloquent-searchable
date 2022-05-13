<?php

namespace DvSoft\EloquentSearchable\Tests\Models;

use DvSoft\EloquentSearchable\EloquentSearchableTrait;
use Illuminate\Database\Eloquent\Model;

class EloquentUserModel extends Model
{
    use EloquentSearchableTrait;

    protected $table = 'users';

    protected $fillable = ['name', 'surname', 'email'];

    protected $searchable = ['name', 'email'];
}
