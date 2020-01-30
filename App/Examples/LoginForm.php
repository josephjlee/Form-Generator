<?php

namespace App\Examples;

use App\Field\{Password, Email};
use App\Form;

/**
 * Class LoginForm
 *
 * @package App\Examples
 */
class LoginForm extends Form
{

    /**
     * ContactForm constructor.
     */
    public function __construct()
    {
        parent::__construct('Login form', [
            new Email('email_address'),
            new Password('password'),
        ]);
    }
}
