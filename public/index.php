<?php

require('../vendor/autoload.php');

echo '<h1>Example contact form</h1>';
echo (new App\Examples\ContactForm())->getHtml();

echo '<h1>Example login form</h1>';
echo (new App\Examples\LoginForm())->getHtml();
