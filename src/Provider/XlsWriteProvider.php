<?php

namespace Hxh\XlsWrite\Provider;



use Hxh\XlsWrite\XlsWrite;

class XlsWriteProvider extends \Illuminate\Support\ServiceProvider
{

    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../Config/xlswrite.php' => config_path('xlswrite.php'),
            ],'config');
        }
    }

    public function register()
    {
        $this->app->bind('XlsWrite', function () {
            return new XlsWrite();
        });
    }

    /**
     * register the commands
     */
    private function registerCommands()
    {

    }
}
