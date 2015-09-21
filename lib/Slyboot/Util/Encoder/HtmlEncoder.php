<?php

namespace Slyboot\Util\Encoder;

use Slyboot\Util\Encoder\EncoderInterface;

/**
 * Class HtmlEncoder : Encodeur HTML
 * permettant d'encoder les entités html
 * @author Elhadj Macky Dieng
 * @copyright   M1DNR2I - 2015
 * @license : Académique
 */
class HtmlEncoder implements EncoderInterface
{
    /**
     * @method cette méthode permet d'encoder les caractères
     * spéciaux (entités html) lors de l'affichage des données
     * @param array $data donnée à encoder
     */
    public static function encode($data)
    {
        $clearValue = htmlspecialchars($data, ENT_COMPAT|ENT_HTML5, 'UTF-8');
        return $clearValue;
    }
}
