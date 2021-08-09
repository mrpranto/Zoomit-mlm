<?php


namespace App\HelperTrait;


use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

trait FileHandler
{
    protected $storage_prefix = 'public';

    public function storeFile(UploadedFile $file, $folder = 'avatar'): string
    {
        $name = Str::random(40) . "." . $file->getClientOriginalExtension();
        $file->storeAs("{$this->storage_prefix}/{$folder}", $name);
        return Storage::url($folder . '/' . $name);
    }

    public function uploadImage(UploadedFile $uploadedFile = null, $folder = "logo"): ?string
    {
        if (is_null($uploadedFile))
            return null;
        $file = $this->saveImage($uploadedFile, $folder);
        if ($file->success)
            return Storage::url($file->path);
        return null;
    }

    public function saveImage(UploadedFile $file, $subdirectory = 'logo'): object
    {
        $file_name = uniqid() . '.' . $file->getClientOriginalExtension();
        $file->storeAs($this->storage_prefix . '/' . $subdirectory, $file_name);
        return (object)["success" => true, "message" => "File has been uploaded successfully", "path" => $subdirectory . '/' . $file_name];
    }

    public function isFile(string $path = null): bool
    {
        return Storage::exists("{$this->storage_prefix}/{$path}");
    }

    public function deleteImage(string $path = null)
    {
        return $this->deleteFile($path);
    }

    public function removeStorage($path)
    {
        return str_replace('/storage', '', $path);
    }

    public function deleteFile(string $path = null)
    {
        $path = $this->removeStorage($path);
        if ($this->isFile($path))
            return Storage::delete("{$this->storage_prefix}/{$path}");
        return false;
    }

    public function deleteMultipleFile(array $paths): bool
    {
        foreach ($paths as $path) {
            $this->deleteFile($path);
        }

        return true;
    }

    public function filePath(string $path = null): ?string
    {
        $path = $this->removeStorage($path);
        if ($this->isFile($path))
            return Storage::url("{$this->storage_prefix}/{$path}");
        return null;
    }

}
