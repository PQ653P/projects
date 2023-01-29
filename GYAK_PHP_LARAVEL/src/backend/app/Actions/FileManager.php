<?php

namespace App\Actions;

use Str;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class FileManager
{
    /**
     * Upload a file
     * @param string $fileInputName File input name as given in `name` HTML attribute. Default: "file"
     * @param string $path Target directory inside '~/public/uploads/' folder. Default: ""
     * @param bool $throwErrorOnMissingFile If set to false, the function returns false on error instead of throwing an error. Default: false
     * @return string|bool Path of uploaded file, false on error
     * @throws BadRequestHttpException if request doesn't have input named $fileInputName
     * @throws FileException if file couldn't be moved or created
     */
    public static function upload(string $fileInputName = 'file', string $path = '', bool $throwErrorOnMissingFile = false): string|bool {
        $hasFile = request()->hasFile($fileInputName);

        if (!$hasFile && $throwErrorOnMissingFile) throw new BadRequestHttpException("Request does not have input file named $fileInputName");

        if ($hasFile) {
            $uploadedFile = request()->file($fileInputName);
            return $uploadedFile->move(tenant('id') . "/uploads/$path", Str::random(8) . '.' . $uploadedFile->getClientOriginalExtension())->getFilename();
        }
        return false;
    }
}
