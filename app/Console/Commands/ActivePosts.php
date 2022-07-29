<?php

namespace App\Console\Commands;

use App\Models\Post;
use Illuminate\Console\Command;

class ActivePosts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'active:posts';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Active all posts in table';

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
     * @return int
     */
    public function handle()
    {
        $posts = Post::query()->update(  ['status' => 1] );
        return 'Update Status';
    }
}
