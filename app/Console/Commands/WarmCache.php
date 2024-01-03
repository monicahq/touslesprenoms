<?php

namespace App\Console\Commands;

use App\Models\Name;
use Illuminate\Console\Command;
use Illuminate\Http\Request;

class WarmCache extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'openname:warm';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $request = Request::create(route('home.index'), 'GET');

        foreach (Name::where('total', '>', 69000)->lazy() as $name) {
            $request = Request::create(route('name.show', [
                'id' => $name->id,
                'name' => $name->name,
            ]), 'GET');
            app()->handle($request);
        }
    }
}
