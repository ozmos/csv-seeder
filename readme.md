# README
A helper class to seed databases from .csv files
## Dependencies
[Parsecsv/php-parscsv](https://github.com/parsecsv/parsecsv-for-php)
## Usage
- Place .csv file into *storage/app*
- Copy *CsvSeeder.php* to *database/seeders*
- Call in *DatabaseSeeder* `run()` method, adding `$table` and `$extension` (optional) parameters:

```php
// DatabaseSeeder.php
public function run()
{
    $this->call(CsvSeeder::class, false, ['table' => 'tablename']);
}
```