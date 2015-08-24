<?php
namespace Slyboot\Templater;
/**
 *
 * @author dieng444
 *
 */
Interface TemplaterInterface
{
    public static function render($view,array $data);
}