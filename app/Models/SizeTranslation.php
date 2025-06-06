<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SizeTranslation extends Model
{
    use SoftDeletes;
    protected $table='size_translations';
    protected $fillable = ['name','locale'];
}
