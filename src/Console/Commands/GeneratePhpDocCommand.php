<?php

declare(strict_types=1);

namespace Linchaker\DevCommands\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class GeneratePhpDocCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'gen:phpdoc {table} {connection=mysql}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Php doc generation for Model';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $table = $this->input->getArgument('table');
        DB::connection($this->argument('connection'))
            ->getDoctrineSchemaManager()
            ->getDatabasePlatform()
            ->registerDoctrineTypeMapping('enum', 'string');
        $columns = DB::connection($this->argument('connection'))->select('SELECT * from information_schema.columns 
                                where table_name = ? ORDER BY ORDINAL_POSITION ASC;', [$table]);
        $columns = collect($columns)->pluck('COLUMN_NAME')->toArray();

        $commentDoc = "/**\n";
        foreach ($columns as $column) {
            $columnType = Schema::connection($this->argument('connection'))->getColumnType($table, $column);

            if ($columnType == 'datetime') {
                if ($column == 'created_at' || $column == 'updated_at' || $column == 'deleted_at') {
                    $type = '\Carbon\Carbon';
                } else {
                    $type = 'string';
                }
            } elseif ($columnType == 'decimal' || $columnType == 'json') {
                $type = 'mixed';
            } elseif (in_array($columnType, ['smallint', 'bigint', 'boolean'])) {
                $type = 'int';
            } elseif (in_array($columnType, ['text', 'mediumtext'])) {
                $type = 'string';
            } else {
                $type = $columnType;
            }
            $commentDoc .= "* @property $type \$$column\n";
        }
        $commentDoc .= "*/\n";

        echo $commentDoc;
        return 0;
    }
}
