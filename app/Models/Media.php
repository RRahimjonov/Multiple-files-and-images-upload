<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Media extends Model
{
    protected $fillable = ['filename', 'mime_type', 'size', 'path'];

    protected $appends = ['original_url'];

    protected function originalUrl(): Attribute
    {
        return Attribute::make(
            get: fn() => Storage::url($this->path)
        );
    }
}
