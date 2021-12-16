<?php

namespace App\Traits;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

trait Imageable
{
    public function deleteImage(string $column = 'image')
    {
        $imageName = $this->getImageNameFromColumn($column);
        $imageName !== null && Storage::delete("{$this->uploadFolder()}/{$imageName}");
    }

    public function imageUrl(string $column = 'image'): string
    {
        $imageName = $this->getImageNameFromColumn($column);
        if (Str::startsWith($imageName, 'http')) {
            return $imageName;
        }
        return $imageName === null ? "https://ui-avatars.com/api/?name={$column}&color=7f9cf5&background=EBF4ff" : Storage::url("{$this->uploadFolder()}/{$imageName}");
    }

    private function getImageNameFromColumn(string $column): ?string
    {
        if (!Str::contains($column, '->')) {
            return $this->{$column};
        }

        $jsonColumn = Str::before($column, '->');
        $columnKey = Str::after($column, '->');

        return Arr::get($this->{$jsonColumn}, $columnKey);
    }
}
