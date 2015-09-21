<?php
namespace Slyboot\Templater;

/**
 *
 * @author dieng444
 *
 */
interface TemplaterInterface
{
    public static function render($view, array $data);
}
