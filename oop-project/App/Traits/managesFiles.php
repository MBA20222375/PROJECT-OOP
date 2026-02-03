<?php
namespace Oop\Project\Traits;

trait ManagesFiles
{
    private static $uploadDir = "public/uploads/";
    
    public static function uploadFile(array $file, ?string $uploadFile = null, $allowedExt = ['jpg', 'png', 'jpeg', 'gif'])  
    {
        $fileName = $file['name'];
        $extfile = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        
        if (!in_array($extfile, $allowedExt)) {
            return null;
        }
        
        $realPath = realpath(__DIR__ . "/../../") . "/" . self::$uploadDir;
        
        if (isset($uploadFile)) {
            $pathFolder = $realPath . $uploadFile;
        } else {
            $pathFolder = $realPath;
        }
        
        if (!is_dir($pathFolder)) {
            mkdir($pathFolder, 0777, true);
        }
        
        $fullPath = $pathFolder . '/' . $fileName;
        
        if (move_uploaded_file($file['tmp_name'], $fullPath)) {
            return $uploadFile . '/' . $fileName;
        }
        
        return null;
    }
}