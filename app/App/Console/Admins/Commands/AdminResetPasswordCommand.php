<?php


namespace App\Console\Admins\Commands;


use App\Console\Admins\AdminDataValidate;
use Domain\Admins\Actions\AdminResetPasswordAction;
use Domain\Admins\Models\Admin;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Validator;

/**
 * Class AdminResetPasswordCommand
 * @package App\Console\Admins\Commands
 */
class AdminResetPasswordCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:reset-password';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update user for Admin panel';

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
     * @param Admin $admins
     * @param AdminDataValidate $dataValidate
     * @param AdminResetPasswordAction $resetPasswordAction
     * @return void
     */
    public function handle(
        Admin $admins, AdminDataValidate $dataValidate, AdminResetPasswordAction $resetPasswordAction)
    {
        $fields = [];

        $fields['email'] = $this->askValid($dataValidate->choiceEmail($admins));

        $admin = Admin::where('email', $fields['email'])->first();

        $fields['password'] = $this->askValid($dataValidate->askPassword());
        $fields['name'] = $admin->name;
//        $fields['role'] = $admin->role;
        $fields['email_verified_at'] = $admin->email_verified_at;
        $fields['remember_token'] = $admin->remember_token;
        $fields['created_at'] = $admin->created_at;
        $fields['updated_at'] = $admin->updated_at;

        $request = new Request($fields);

//        $dataRequest = AdminData::fromRequest($request);

        $resetPasswordAction->execute($admin, $request);

        $this->info('Admin Create Successfully');
        $this->info('Your password is ' . $fields['password']);

    }

    /**
     * @param $question
     * @param $field
     * @param $rules
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
