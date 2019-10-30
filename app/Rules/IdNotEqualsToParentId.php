<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class IdNotEqualsToParentId implements Rule
{
    protected $id;
    protected $parent_id;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($id, $parent_id)
    {
        $this->id = $id;
        $this->parent_id = $parent_id;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return $this->id != $this->parent_id;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'O assunto não pode ser salvo dentro do próprio assunto.';
    }
}
