<?php

namespace App\Interfaces;

/**
 * Interface FieldInterface
 *
 * @package App\Interfaces
 */
interface FieldInterface
{

    /**
     * @return string
     */
    public function getHtml(): string;

    /**
     * @return string
     */
    public function getValue(): string;

    /**
     * @param string $value
     *
     * @return self
     */
    public function setValue(string $value): self;

    /**
     * @return bool
     */
    public function isValid(): bool;

    /**
     * @return string
     */
    public function getLabel(): string;

    /**
     * @param string $label
     *
     * @return self
     */
    public function setLabel(string $label): self;

    /**
     * @return bool
     */
    public function getRequired(): bool;

    /**
     * @param bool $required
     *
     * @return self
     */
    public function setRequired(bool $required): self;
}
