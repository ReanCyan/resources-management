<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pdf extends Model
{
    use HasFactory;

    /** @var array */
    protected $guarded = ['id'];

    /** @var array */
    protected $appends = ['url'];

    public function path(): Attribute
    {
        return Attribute::get(fn() => $this->location. '/' .$this->unique_name. '.' .$this->extension);
    }

    public function url(): Attribute
    {
        return Attribute::get(fn() => Storage::url($this->path));
    }
}
