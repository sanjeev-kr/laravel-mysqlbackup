<?php

namespace Sanjeev\MySqlBackup\Console;

use \Illuminate\Console\Command as BaseCommand;

class MySqlBackup extends BaseCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:mysqlbackup {filename} {format}';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Mysql Database backup in sql or sql.gz';
    /**
     * Create a new command instance.
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $disabled = explode(',', ini_get('disable_functions'));

        if(in_array('exec', $disabled))
        {
           $this->error("exec function  is disabled.");
           return false;
        }

        $backupDir = storage_path().'/backup';

        if (!is_dir($backupDir)) {
            mkdir($backupDir, 0777, true);
        }

        $filename = $this->argument('filename');
        $filename = sprintf("%s_%s",$filename,(new \DateTime())->format('Y_m_d'));
        $format = $this->argument('format');
        if($format != 'sql.gz')
            $format = 'sql';
        $host = \Config::get('database.connections.mysql.host');
        $database = \Config::get('database.connections.mysql.database');
        $username = \Config::get('database.connections.mysql.username');
        $password = \Config::get('database.connections.mysql.password');

        if(!empty($password)) 
            $password = '-p'.$password;
        $filename = sprintf("%s/%s.%s",$backupDir,$filename,$format);
        $command = "mysqldump -h $host -u $username $password $database ";
        if ($format == 'sql.gz')
           $command .= " | gzip -9 > $filename";
       else
           $command .= " > $filename";

        exec($command);

        $this->info('Backup completed successfully.');

        return true;
    }
}
