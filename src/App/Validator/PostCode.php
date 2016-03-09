<?php
namespace App\Validator;

use Zend\Validator\AbstractValidator;

/**
 * UK PostCode Validator
 * 
 * @author Vasil Dakov <vasildakov@gmail.com>
 */

class PostCode extends AbstractValidator
{
    const ERROR = 'error';

    protected $messageTemplates = [
        self::ERROR => "'%value%' must be a valid uk post code",
    ];


    /**
     * @param array $options
     */
    public function __construct(array $options = [])
    {
       parent::__construct($options);
    }

    /**
     * @param  string  $value
     * @return boolean
     */
    public function isValid($value)
    {
        $this->setValue($value);

        $isValid = true;

        // The following is the UK Postcode Regular Expression
        if (!preg_match("/^([Gg][Ii][Rr] 0[Aa]{2})|((([A-Za-z][0-9]{1,2})|(([A-Za-z][A-Ha-hJ-Yj-y][0-9]{1,2})|(([AZa-z][0-9][A-Za-z])|([A-Za-z][A-Ha-hJ-Yj-y][0-9]?[A-Za-z]))))[0-9][A-Za-z]{2})$/", $value)) {
            $this->error(self::ERROR);
            return false;
        }

        return $isValid;
    }
}
