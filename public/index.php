<?php

use App\Examples\ContactForm;

require('../vendor/autoload.php');

$form = new ContactForm();
echo $form->getHtml();
