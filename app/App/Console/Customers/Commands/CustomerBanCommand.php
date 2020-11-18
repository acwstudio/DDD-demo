<?php


namespace App\Console\Customers\Commands;


use App\Console\Customers\CustomerDataValidate;
use Domain\Customers\Actions\CustomerBanAction;
use Domain\Customers\Models\Customer;
use Illuminate\Console\Command;
use Illuminate\Http\Request;
use Validator;

/**
 * Class CustomerBanCommand
 * @package App\Console\Customers\Commands
 */
class CustomerBanCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'customer:ban-customer';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Ban user customer';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @param Customer $customers
     * @param CustomerDataValidate $dataValidate
     * @param CustomerBanAction $banAction
     */
    public function handle(
        Customer $customers, CustomerDataValidate $dataValidate, CustomerBanAction $banAction)
    {
        $fields = [];

        $fields['email'] = $this->askValid($dataValidate->choiceEmail($customers));

        $customer = Customer::where('email', $fields['email'])->first();

        $ban = $this->askValid($dataValidate->askBan());

        if ($ban === 'set ban'){
            $fields['ban'] = true;
            $message = $fields['email'] . ' banned Successfully';
        } else {
            $fields['ban'] = false;
            $message = $fields['email'] . ' unbanned Successfully';
        }

        $request = new Request($fields);

        $banAction->execute($customer, $request);

        $this->info($message);
    }

    /**
     * @param array $data
     * @return array|mixed|string
     */
    protected function askValid(array $data)
    {
        if (!empty($data['choice'])) {
            $value = $this->choice($data['ask'], $data['choice']);
        } else {
            $value = $this->ask($data['ask']);
        }

        if($message = $this->validateInput($data, $value)) {
            $this->error($message);

            return $this->askValid($data);
        }

        return $value;
    }

    /**
     * @param $data
     * @param $value
     * @return string|null
     */
    protected function validateInput($data, $value)
    {
        $validator = Validator::make([
            $data['field'] => $value
        ], [
            $data['field'] => $data['rules']
        ]);

        return $validator->fails()
            ? $validator->errors()->first($data['field'])
            : null;
    }
}
