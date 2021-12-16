<?php

namespace App\Actions;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

class UploadFile
{
    private $file;
    private $uploadPath;

    public function execute(): ?string
    {
        if (!$this->file) {
            return null;
        }
        $imgName = Str::of($this->file)->beforeLast('.')->slug()->append('.')->append($this->file->getClientOriginalExtension());
        $this->file->storeAs($this->uploadPath, $imgName);

        return $imgName;
    }

    public static function uploadImgFile(UploadedFile $file, string $uploadPath): ?string
    {
        return (new UploadFile)
        ->setFile($file)
        ->setUploadPath($uploadPath)
        ->execute();
    }


    /**
     * @return mixed
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * @param mixed $file
     * @return UploadFile
     */
    public function setFile(?UploadedFile $file)
    {
        $this->file = $file;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getUploadPath()
    {
        return $this->uploadPath;
    }

    /**
     * @param mixed $uploadPath
     * @return UploadFile
     */
    public function setUploadPath(string $uploadPath)
    {
        $this->uploadPath = $uploadPath;
        return $this;
    }


}
