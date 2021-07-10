<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use ParseCsv\Csv;

class CsvSeeder extends Seeder
{
    protected $file;
    protected $table;
    protected $csv;
    protected $cols;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(string $table, string $extension = '.csv')
    {
        // local vars
        $this->table = DB::table($table);;
        $this->file = Storage::get($table . $extension);
        $this->csv = new Csv();
        $this->cols = Schema::getColumnListing($table);
        // parse file
        $this->csv->parseFile($this->file);
        $this->csv->enclose_all = true;
        // get column names
        $this->cols = array_filter($this->cols, function($col) {
            $remove = ['id', 'created_at', 'updated_at'];
            return !in_array($col, $remove);
        });
        // add data to table
        foreach ($this->csv->data as $index) {
            $row = array_combine($this->cols, $index);
            $this->table->insert($row);
        }
    }
}
