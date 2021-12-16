<?php

namespace App\Models;

use App\Contracts\ImageableContract;
use App\Traits\Imageable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;

class Setting extends Model implements ImageableContract
{
    use HasFactory;
    use Imageable;

    protected $guarded = ['id'];

    protected $casts = [
        'data' => 'array',
    ];

    public function uploadFolder():string
    {
        return 'settings';
    }

    public function heroDescription(): ?string
    {
        // look for the key in model data, return null if not found
        return Arr::get($this->data, 'hero_description');
    }


    public function aboutDescription(): ?string
    {
        // look for the key in model data, return null if not found
        return Arr::get($this->data, 'about_description');
    }

    public function address(): ?string
    {
        return Arr::get($this->data, 'address');
    }

    public function googleMapUrl(): ?string
    {
        return Arr::get($this->data, 'google_map_url');
    }

    public function email(): ?string
    {
        return Arr::get($this->data, 'email');
    }

    public function phone(): ?string
    {
        return Arr::get($this->data, 'phone');
    }



}
