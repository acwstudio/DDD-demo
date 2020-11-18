<?php


namespace App\Console\Customers;


use Domain\Customers\Models\Customer;
use Illuminate\Database\Eloquent\Collection;
use Spatie\Permission\Models\Role;

/**
 * Class CustomerDataValidate
 * @package App\Console\Customers
 */
class CustomerDataValidate
{
    /** @var array  */
    private array $name;

    /** @var array  */
    private array $email;

    /** @var array  */
    private array $password;

    /** @var Customer | Collection */
    private Customer $customers;

    /** @var array  */
    private array $ban;

    /**
     * CustomerDataValidate constructor.
     * @param Customer $customers
     */
    public function __construct(Customer $customers)
    {
        $this->customers = $customers;
    }

    /**
     * @return array
     */
    public function askName()
    {
        $this->name = [
            'ask' => "What's his/her name?",
            'field' => 'Name',
            'rules' => ['required', 'string', 'max:20'],
            'choice' => [],
            'message' => [],
        ];

        return $this->name;
    }

    /**
     * @return array
     */
    public function askEmail()
    {
        $this->email = [
            'ask' => "What's his/her email?",
            'field' => 'Email',
            'rules' => ['required', 'string', 'email', 'max:255', 'unique:customers'],
            'choice' => [],
            'message' => [],
        ];

        return $this->email;
    }

    /**
     * @param Customer $customer
     * @return array
     */
    public function choiceEmail()
    {
        $this->email = [
            'ask' => "What's his/her email?",
            'field' => 'Email',
            'rules' => ['required', 'string', 'email', 'max:255'],
            'choice' => $this->customers->pluck('email')->toArray(),
            'message' => [],
        ];

        return $this->email;
    }

    /**
     * @return array
     */
    public function askPassword()
    {
        $this->password = [
            'ask' => "What's password?",
            'field' => 'Password',
            'rules' => ['required', 'string', 'min:8'],
            'choice' => [],
            'message' => [],
        ];

        return $this->password;
    }

    /**
     * @return array
     */
    public function  askBan()
    {
        $this->ban = [
            'ask' => 'Do you want ban?',
            'field' => 'Ban',
            'rules' => ['string'],
            'choice' => ['unset ban', 'set ban'],
            'message' => []
        ];

        return $this->ban;
    }
}

