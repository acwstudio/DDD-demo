<?php


namespace App\Console\Admins\Commands;


use App\Console\Admins\AdminDataValidate;
use Domain\Admins\Actions\AdminBanAction;
use Domain\Admins\Models\Admin;
use Illuminate\Console\Command;
use Illuminate\Http\Request;
use Validator;

/**
 * Class AdminBanCommand
 * @package App\Console\Admins\Commands
 */
class AdminBanCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:ban-admin';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Ban user admin';

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
     * @param AdminBanAction $banAction
     * @return void
     */
    public function handle(
        Admin $admins, AdminDataValidate $dataValidate, AdminBanAction $banAction)
    {
        $fields = [];

        $fields['email'] = $this->askValid($dataValidate->choiceEmail($admins));

        $admin = Admin::where('email', $fields['email'])->first();

        $ban = $this->askValid($dataValidate->askBan());

        if ($ban === 'set ban'){
            $fields['ban'] = true;
        } else {
            $fields['ban'] = false;
        }

        $fields['password'] = $admin->password;
        $fields['name'] = $admin->name;

        $request = new Request($fields);

        $banAction->execute($admin, $request);

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
