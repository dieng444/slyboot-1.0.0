<?php
namespace Slyboot\Main\Form;

use Slyboot\Main\Form\MainFormInterface;
use Slyboot\Util\Validator\FieldLengthValidator;
use Slyboot\Util\Validator\SelectListValidator;
use Slyboot\Util\Validator\EmptyFieldValidator;
use Slyboot\Request\HttpRequest;
use Slyboot\Request\Request;
use \Exception;

/**
 * Class MainForm : The main form class
 * all sub form classes inherit this class
 * @author Macky Dieng
 * @license MIT - http://opensource.org/licenses/MIT
 * @copyright 2015 the author
 */
abstract class MainForm implements MainFormInterface
{
    /**
     * Boolean who specify that the error mode is empty error
     * @var boolean
     */
    private $is_empty_error_mode;
    /**
     * Boolean who specify that the error mode is invalid data error
     * @var boolean
     */
    private $is_invalid_data_error_mode;
    /**
     * Errors container
     * @var array
     */
    private $errors;
    /**
     * HttpRequest object variable
     * @var Slyboot\Request\HttpRequest
     */
    private $http;
    /**
     * Request object variable
     * @var Slyboot\Request\Request
     */
    private $request;
    /**
     * Class constructor
     * @method __construct
     * @return void
     */
    public function __construct()
    {
        $this->is_empty_error_mode = false;
        $this->is_invalid_data_error_mode = false;
        $this->http = new HttpRequest();
        $this->request = new Request();
    }
    /**
     * Checks the validity of all the app form,
     * based on the configuration that developers
     * would specify in their form classes.
     * @method isValid
     * @return boolean
     */
    public function isValid()
    {
        /**
         * Obtaining validators that the developer wish to use
         */
        $validatorsToUse = static::validatorsToUse();
        $is_data_valid = true;
        $validators = array();
        /**
         * Verifying if the validators array is not empty,
         * otherwise, no validating will performed
         */
        if (sizeof($validatorsToUse) > 0) {
            /**
             * Empty field validation case
             */
            if (in_array('EmptyFieldValidator', $validatorsToUse)) {
                $empty_error_result = EmptyFieldValidator::validate(static::getFormEntity(), array());
                if ($empty_error_result!==true) {
                    $this->is_empty_error_mode = true;
                    $is_data_valid = false;
                    $this->errors = $empty_error_result;
                } else {
                    $this->is_empty_error_mode = false;
                }
            }
            /**
             * Verify if validator were specified by the developper
             * before adding them
             */
            if (in_array('FieldLengthValidator', $validatorsToUse)) {
                $validators[] = new FieldLengthValidator;
            }
            if (in_array('SelectListValidator', $validatorsToUse)) {
                $validators[] = new SelectListValidator;
            }
            /**
             * Invalid data validation case
             */
            if (!$this->is_empty_error_mode) {
                 $validate_error_result = static::validate(static::getFormEntity(), $validators);
                foreach ($validate_error_result as $value) {
                    if ($value!==true) {
                        $this->is_invalid_data_error_mode = true;
                        $is_data_valid = false;
                        foreach ($value as $key => $val) {
                            $this->errors[$key] = $val;
                        }
                    }
                }
            }
            return $is_data_valid;
        } else {
            return $is_data_valid;
        }

    }
    /**
     * Sends an error message depending on the
     * field where the error occurred
     * @method getError
     * @param string $field
     * @return string
     */
    public function getError($field)
    {
        if ($this->is_empty_error_mode) {
            if (array_key_exists($field, $this->errors)) {
                return $this->errors[$field];
            }
        } elseif ($this->is_invalid_data_error_mode)
        if (array_key_exists($field, $this->errors)) {
            return $this->errors[$field];
        }
    }
    /**
     * Returns the data entered by the user in the form
     * in case of error during submission.
     * @see Slyboot\Main\Form.MainFormInterface::getPost()
     */
    public function getPost($postFieldName)
    {
        if ($this->http->getPost() !==null) {
            return $this->request->getParam($postFieldName);
        }
    }
}
