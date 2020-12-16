<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class AtLeastOneKeyIs implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     *
     */
    protected string $key;
    protected $value;

    public function __construct(string $key, $value)
    {
        $this->key = $key;
        $this->value = $value;

    }

    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value)
    {

        return in_array($this->value, array_column($value, $this->key));
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'At least one key'.' ('.$this->key.') '. 'should be equal to';
    }
}
