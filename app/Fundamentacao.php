<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fundamentacao extends Model
{
    protected $table = 'fundamentacao';

    protected $fillable = [
        'fundamentacao',
		'user_id',
    ];
}
