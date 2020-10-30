<?php


namespace App\Console\Admins\Commands;


use App\Console\Admins\AdminDataValidate;
use Domain\Admins\Actions\AdminRegisterAction;
use Domain\Admins\Models\Admin;
use Illuminate\Console\Command;
use Illuminate\Http\Request;
use Validator;

/**
 * Class AdminRegisterCommand
 * @package App\Console\Admins\Commands
 */
class AdminRegisterCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:register';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Register new user for Admin panel';

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
     * Execute the console command.
     *
     * @param AdminRegisterAction $registerAction
     * @param Admin $admin
     * @param AdminDataValidate $dataValidate
     * @return void
     */
    public function handle(AdminRegisterAction $registerAction,
                           Admin $admin,
                           AdminDataValidate $dataValidate)
    {
        $fields = [];
        date_default_timezone_set('Europe/Moscow');

        $fields['name'] = $this->askValid($dataValidate->askName());
        $fields['email'] = $this->askValid($dataValidate->askEmail());
        $fields['role'] = $this->askValid($dataValidate->choiceRole());
        $fields['password'] = $this->askValid($dataValidate->askPassword());
        $fields['email_verified_at'] = date('d-m-Y H:i:s');
        $fields['remember_token'] = \Str::random(10);
        $fields['created_at'] = date('d-m-Y H:i:s');
        $fields['updated_at'] = date('d-m-Y H:i:s');

        $request = new Request($fields);

//        $dataRequest = AdminData::fromRequest($request);

//        $registerAction->execute($admin, $dataRequest);
        $registerAction->execute($request);

        $this->info('Admin Create Successfully');
        $this->info('Your password is ' . $fields['password']);
    }

    /**
     * @param array $data
     * @return mixed
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
     * @param $rules
     * @param $fieldName
     * @param $value
     * @return string|null
     */
    protected function validateInput(array $data, $value)
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
