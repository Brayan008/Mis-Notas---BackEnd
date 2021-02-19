<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;

class Nota extends Model
{
    protected $primaryKey = '_id';
    protected $fillable = ['_id', 'autor', 'lenguage', 'title', 'content'];

    protected $collection = 'notas';

}
