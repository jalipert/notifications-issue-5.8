<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SendNotifications extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:notifications';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        printf("Testing notifications..\n");
        $user1 = \App\User::firstOrCreate(['custom_id' => 'foo', 'name' => 'Foo', 'email' => 'foo@example.com']);
        $user2 = \App\User::firstOrCreate(['custom_id' => 'bar', 'name' => 'Bar', 'email' => 'bar@example.com']);

        try
        {
            printf("Calling notify on user " . $user1->name . " with email " . $user1->email . "...\n");
            $user1->notify( new \App\Notifications\TestNotification("private note only foo should see") );
        }
        catch( \Exception $e )
        {
            // ignore exception thrown since mail isn't configured for this test
        }

        printf("Done\n");
    }
}