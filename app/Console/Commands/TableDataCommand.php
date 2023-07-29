<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class TableDataCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'table:data {name} {page=0}';

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
    public function handle(): mixed
    {
        try {
            $data = DB::table($this->argument('name'))
                ->skip($this->argument('page') * 10)
                ->take(10)
                ->orderBy('id', 'DESC')
                //->select($this->argument('select'))
                ->get()->toArray();
            print_r($data);
        } catch (\Exception $e) {
            echo "Tables don't or column exits \n";
        }
    }

}

/**
 * Error: Call to a member function update() on null in /Users/tao/Documents/GitHub/v10/app/Jobs/FightJob.php:33
Stack trace:
#0 /Users/tao/Documents/GitHub/v10/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): App\Jobs\FightJob->handle(Object(App\Http\Services\Bet\FightService))
#1 /Users/tao/Documents/GitHub/v10/vendor/laravel/framework/src/Illuminate/Container/Util.php(41): Illuminate\Container\BoundMethod::Illuminate\Container\{closure}()
#2 /Users/tao/Documents/GitHub/v10/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(93): Illuminate\Container\Util::unwrapIfClosure(Object(Closure))
#3 /Users/tao/Documents/GitHub/v10/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(35): Illuminate\Container\BoundMethod::callBoundMethod(Object(Illuminate\Foundation\Application), Array, Object(Closure))
#4 /Users/tao/Documents/GitHub/v10/vendor/laravel/framework/src/Illuminate/Container/Container.php(662): Illuminate\Container\BoundMethod::call(Object(Illuminate\Foundation\Application), Array, Array, NULL)
#5 /Users/tao/Documents/GitHub/v10/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(128): Illuminate\Container\Container->call(Array)
#6 /Users/tao/Documents/GitHub/v10/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(141): Illuminate\Bus\Dispatcher->Illuminate\Bus\{closure}(Object(App\Jobs\FightJob))
#7 /Users/tao/Documents/GitHub/v10/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(116): Illuminate\Pipeline\Pipeline->Illuminate\Pipeline\{closure}(Object(App\Jobs\FightJob))
#8 /Users/tao/Documents/GitHub/v10/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(132): Illuminate\Pipeline\Pipeline->then(Object(Closure))
#9 /Users/tao/Documents/GitHub/v10/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(123): Illuminate\Bus\Dispatcher->dispatchNow(Object(App\Jobs\FightJob), false)
#10 /Users/tao/Documents/GitHub/v10/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(141): Illuminate\Queue\CallQueuedHandler->Illuminate\Queue\{closure}(Object(App\Jobs\FightJob))
#11 /Users/tao/Documents/GitHub/v10/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(116): Illuminate\Pipeline\Pipeline->Illuminate\Pipeline\{closure}(Object(App\Jobs\FightJob))
#12 /Users/tao/Documents/GitHub/v10/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(122): Illuminate\Pipeline\Pipeline->then(Object(Closure))
#13 /Users/tao/Documents/GitHub/v10/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(70): Illuminate\Queue\CallQueuedHandler->dispatchThroughMiddleware(Object(Illuminate\Queue\Jobs\RedisJob), Object(App\Jobs\FightJob))
#14 /Users/tao/Documents/GitHub/v10/vendor/laravel/framework/src/Illuminate/Queue/Jobs/Job.php(98): Illuminate\Queue\CallQueuedHandler->call(Object(Illuminate\Queue\Jobs\RedisJob), Array)
#15 /Users/tao/Documents/GitHub/v10/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(439): Illuminate\Queue\Jobs\Job->fire()
#16 /Users/tao/Documents/GitHub/v10/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(389): Illuminate\Queue\Worker->process('redis', Object(Illuminate\Queue\Jobs\RedisJob), Object(Illuminate\Queue\WorkerOptions))
#17 /Users/tao/Documents/GitHub/v10/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(176): Illuminate\Queue\Worker->runJob(Object(Illuminate\Queue\Jobs\RedisJob), 'redis', Object(Illuminate\Queue\WorkerOptions))
#18 /Users/tao/Documents/GitHub/v10/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(137): Illuminate\Queue\Worker->daemon('redis', 'default', Object(Illuminate\Queue\WorkerOptions))
#19 /Users/tao/Documents/GitHub/v10/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(120): Illuminate\Queue\Console\WorkCommand->runWorker('redis', 'default')
#20 /Users/tao/Documents/GitHub/v10/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): Illuminate\Queue\Console\WorkCommand->handle()
#21 /Users/tao/Documents/GitHub/v10/vendor/laravel/framework/src/Illuminate/Container/Util.php(41): Illuminate\Container\BoundMethod::Illuminate\Container\{closure}()
#22 /Users/tao/Documents/GitHub/v10/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(93): Illuminate\Container\Util::unwrapIfClosure(Object(Closure))
#23 /Users/tao/Documents/GitHub/v10/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(35): Illuminate\Container\BoundMethod::callBoundMethod(Object(Illuminate\Foundation\Application), Array, Object(Closure))
#24 /Users/tao/Documents/GitHub/v10/vendor/laravel/framework/src/Illuminate/Container/Container.php(662): Illuminate\Container\BoundMethod::call(Object(Illuminate\Foundation\Application), Array, Array, NULL)
#25 /Users/tao/Documents/GitHub/v10/vendor/laravel/framework/src/Illuminate/Console/Command.php(208): Illuminate\Container\Container->call(Array)
#26 /Users/tao/Documents/GitHub/v10/vendor/symfony/console/Command/Command.php(326): Illuminate\Console\Command->execute(Object(Symfony\Component\Console\Input\ArgvInput), Object(Illuminate\Console\OutputStyle))
#27 /Users/tao/Documents/GitHub/v10/vendor/laravel/framework/src/Illuminate/Console/Command.php(177): Symfony\Component\Console\Command\Command->run(Object(Symfony\Component\Console\Input\ArgvInput), Object(Illuminate\Console\OutputStyle))
#28 /Users/tao/Documents/GitHub/v10/vendor/symfony/console/Application.php(1081): Illuminate\Console\Command->run(Object(Symfony\Component\Console\Input\ArgvInput), Object(Symfony\Component\Console\Output\ConsoleOutput))
#29 /Users/tao/Documents/GitHub/v10/vendor/symfony/console/Application.php(320): Symfony\Component\Console\Application->doRunCommand(Object(Illuminate\Queue\Console\WorkCommand), Object(Symfony\Component\Console\Input\ArgvInput), Object(Symfony\Component\Console\Output\ConsoleOutput))
#30 /Users/tao/Documents/GitHub/v10/vendor/symfony/console/Application.php(174): Symfony\Component\Console\Application->doRun(Object(Symfony\Component\Console\Input\ArgvInput), Object(Symfony\Component\Console\Output\ConsoleOutput))
#31 /Users/tao/Documents/GitHub/v10/vendor/laravel/framework/src/Illuminate/Foundation/Console/Kernel.php(201): Symfony\Component\Console\Application->run(Object(Symfony\Component\Console\Input\ArgvInput), Object(Symfony\Component\Console\Output\ConsoleOutput))
#32 /Users/tao/Documents/GitHub/v10/artisan(35): Illuminate\Foundation\Console\Kernel->handle(Object(Symfony\Component\Console\Input\ArgvInput), Object(Symfony\Component\Console\Output\ConsoleOutput))
#33 {main}
 */
