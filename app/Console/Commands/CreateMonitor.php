<?php

namespace App\Console\Commands;

use Spatie\Url\Url;
use Illuminate\Support\Str;
use Spatie\UptimeMonitor\Models\Monitor;
use Spatie\UptimeMonitor\Commands\BaseCommand;

class CreateMonitor extends BaseCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'monitor:create {url : URL of the monitor}
                                           {--label= : The label of the monitor}
                                           {--tags= : The tags of the monitor}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a monitor';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $url = Url::fromString($this->argument('url'));

        $label = $this->option('label') ?? Str::of($url->getHost())->replace('.', ' ')->title();
        $tags = $this->option('tags');

        if (! in_array($url->getScheme(), ['http', 'https'])) {
            if ($scheme = $this->choice("Which protocol needs to be used for checking `{$url}`?", [1 => 'https', 2 => 'http'], 1)) {
                $url = $url->withScheme($scheme);
            }
        }

        if ($this->confirm('Should we look for a specific string on the response?')) {
            $lookForString = $this->ask('Which string?');
        }

        $monitor = Monitor::create([
            'user_id' => auth()->user()->id ?? 1,
            'url' => trim($url, '/'),
            'label' => $label,
            'tags' => $tags,
            'look_for_string' => $lookForString ?? '',
            'uptime_check_method' => isset($lookForString) ? 'get' : 'head',
            'certificate_check_enabled' => $url->getScheme() === 'https',
            'uptime_check_interval_in_minutes' => config('uptime-monitor.uptime_check.run_interval_in_minutes'),
        ]);

        $this->warn("{$monitor->url} will be monitored!");
    }
}
