<?php

namespace App\Console\Commands;

use App\Models\Admin;
use App\Models\AdminMessage;
use Illuminate\Console\Command;

class AdminReset extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:reset';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '重置 admin 账号和密码 ';

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
     * @return mixed
     */
    public function handle()
    {
        Admin::truncate();
        AdminMessage::truncate();

        $admin = Admin::create([
            'phone' => env('ADMIN_PHONE'),
            'email' => env('ADMIN_EMAIL'),
            'password' => bcrypt(env('ADMIN_PASSWORD'))
        ]);

        AdminMessage::create([
            'user_name' => env('ADMIN_NAME'),
            'user_id' => $admin->id
        ]);

        print_r("admin 账号重置 OK\n");
    }
}
