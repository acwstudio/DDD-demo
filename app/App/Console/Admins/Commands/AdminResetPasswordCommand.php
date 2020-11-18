<?php


namespace App\Console\Admins\Commands;


use App\Console\Admins\AdminDataValidate;
use Domain\Admins\Actions\AdminResetPasswordAction;
use Domain\Admins\Models\Admin;
use Illuminate\Console\Command;
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
     * @param AdminDataValidate $dataValidate
     * @param AdminResetPasswordAction $resetPasswordAction
     * @return void
     */
    public function handle(AdminDataValidate $dataValidate, AdminResetPasswordAction $resetPasswordAction)
    {
        $fields = [];

        $fields['email'] = $this->askValid($dataValidate->choiceEmail());

        $admin = Admin::where('email', $fields['email'])->first();

        $fields['password'] = $this->askValid($dataValidate->askPassword());

        $request = new Request($fields);

        $resetPasswordAction->execute($admin->id, $request);

        $this->info($admin->name . ' your password is ' . $fields['password']);

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
