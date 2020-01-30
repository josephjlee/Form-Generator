<?php

namespace App\Field;

use App\Field;

/**
 * Class Password
 *
 * @package App\Field
 */
class Password extends Text
{

    /**
     * @var string
     */
    protected string $type = 'password';

    protected array $attributes = [
        'autocomplete' => 'off',
    ];

    protected bool $sensitiveContents = true;
}
