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
    protected $appends = ['url', 'download_url'];

    public function location(): Attribute
    {
        return new Attribute(
            set: fn($value) => $this->trimSlash($value)
        );
    }

    public function path(): Attribute
    {
        return Attribute::get(fn() => $this->location. '/' .$this->unique_name. '.' .$this->extension);
    }

    public function url(): Attribute
    {
        return Attribute::get(fn() => Storage::url($this->path));
    }

    public function downloadUrl(): Attribute
    {
        return Attribute::get(fn() => route('pdfs.download', $this->id));
    }

    function trimSlash(string $string): string
    {
        // Replace multiple slash from string
        $string = preg_replace('#/+#', '/', $string);

        return trim($string, '/');   // Remove slash from front and end
    }
}
