<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Data\Models\OpinionSubject;

class NotInSubtree implements Rule
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

    public function assertParentNotInCurrentSubtree(
        OpinionSubject $current,
        OpinionSubject $parent
    ) {
        return !(
            $current->id == $parent->id || $parent->isDescendantOf($current)
        );
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
        $current = OpinionSubject::find($this->id);
        $parentAttempt = OpinionSubject::find($this->parent_id);

        return $this->assertParentNotInCurrentSubtree($current, $parentAttempt);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'O assunto não pode ser salvo dentro do próprio assunto ou em um assunto que já é filho.';
    }
}
