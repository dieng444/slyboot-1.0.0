<?php

namespace Slyboot\Util\Upload;

use Minijournal\Image\Entity\Image;
/**
 * Class UploadManager : Allows to supload file securely
 * on the server
 * @author Macky Dieng
 * @license MIT - http://opensource.org/licenses/MIT
 * @copyright 2015 the author
 **/
class UploadManager
{

    public static function upload($data, $file)
    {
        $info  = new \finfo();
        $tab = $info->file($file['tmp_name'], FILEINFO_MIME);
        $word = explode(';', $tab);
        $mime = $word[0];
        if ($mime=='image/png') {
            $mime = "image/jpeg";
        }
        switch($mime)
        {
            case "image/jpeg":
                $realName = $file['name'];
                $ext = pathinfo($realName, PATHINFO_EXTENSION);
                $tmp_name = $file['tmp_name'];
                $name = sha1(uniqid(mt_rand(), true)).'.'.$ext;

                if (move_uploaded_file($tmp_name, 'resources/public/uploads/images/articles/'.$name)) {
                    $data = array("articleId" => $data['articleId'],
                           "name" => $name,
                           "titre" => $data['titre'],
                           "photographe" => $data['photographe'],
                           "droit" => $data['droit']);

                    $fichier = new Image($data);
                } else {
                    echo "Error";
                }
                break;
        }

        return $fichier;
    }
}
