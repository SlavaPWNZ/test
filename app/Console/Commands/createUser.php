<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\MainModel;

class createUser extends Command
{
    protected $signature = 'createUser {--l= : login} {--p= : password}';

    protected $description = 'Create user';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $login = $this->option('l');
        $password = $this->option('p');

        if (!isset($login) || $login=='') $this->error("Miss login ( example: --l user123 )");
        if (!isset($password) || $password=='') $this->error("Miss password ( example: --p pass321 )");

        if (isset($login) && $login!='' && isset($password) && $password!='')
        {
            $result = MainModel::CreateUserModel($login, $password);
            $this->info($result);
        }
    }



}
