<?php

namespace App\Examples;

use App\Field\{Text, Email, Textarea};
use App\Form;

/**
 * Class ContactForm
 *
 * @package App\Examples
 */
class ContactForm extends Form
{

    /**
     * ContactForm constructor.
     */
    public function __construct()
    {
        parent::__construct('Contact Form', [
            new Text('first_name'),
            new Text('last_name'),
            new Email('email_address'),
            new Textarea('enquiry'),
        ]);
    }
}
