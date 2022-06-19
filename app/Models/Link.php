<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    use HasFactory;

    /** @var array */
    protected $guarded = ['id'];

    /** @var array */
    protected $casts = [
        'open_in_new_tab' => 'boolean',
    ];
}
