<?php


namespace Domain\Customers\Rules;


use Domain\Customers\Models\Customer;
use Illuminate\Contracts\Validation\Rule;

/**
 * Class CustomerPasswordVerifyRule
 * @package Domain\Customers\Rules
 */
class CustomerPasswordVerifyRule implements Rule
{
    public $customerId;

    /**
     * AdminPasswordVerifyRule constructor.
     * @param Customer $admin
     */
    public function __construct(int $customerId)
    {
        $this->customerId = $customerId;
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
        return \Hash::check($value, Customer::find($this->customerId)->password);
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
