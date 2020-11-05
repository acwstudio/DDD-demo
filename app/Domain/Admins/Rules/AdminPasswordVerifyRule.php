<?php


namespace Domain\Admins\Rules;


use Domain\Admins\Models\Admin;
use Illuminate\Contracts\Validation\Rule;

/**
 * Class AdminPasswordVerifyRule
 * @package Domain\Admins\Rules
 */
class AdminPasswordVerifyRule implements Rule
{
    public $adminId;

    /**
     * AdminPasswordVerifyRule constructor.
     * @param Admin $admin
     */
    public function __construct(int $adminId)
    {
        $this->adminId = $adminId;
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
        return \Hash::check($value, Admin::find($this->adminId)->password);
    }

    /**
     * Get the validation error message.
     *
     * @return string|array
     */
    public function message()
    {
        return "Given password is wrong!";
    }
}
