<?php
use Slim\Http\UploadedFile;

class Util
{
    public static function addMinutesToDate($date,$minutesToAdd = 0)
    {
        $time = new DateTime($date);
        $time->add(new DateInterval('PT' . $minutesToAdd . 'M'));
        return $time->format('Y-m-d H:i:s');
    }
    public static function generateRandomNumber()
    {
        $r = "";
        for ($i = 0; $i < 9; $i++) {
            $r .= rand(9, $i);
        }
        return $r;
    }
    public static function moveUploadedFile($directory, UploadedFile $uploadedFile)
    {
        $uploadedFile->moveTo($directory . DIRECTORY_SEPARATOR . $uploadedFile->getClientFilename());
        return $uploadedFile->getClientFilename();
    }
    public static function boolval($var) {
        return $var == "true" ? true : false;
    }
}