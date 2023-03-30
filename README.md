The following language constructs and technologies are used in the code:

- PHP constants (const) to set parameters for connecting to the database;
- PDO (PHP Data Objects) class, which provides an abstract layer between PHP code and the database and is used to extract data from the crxranks table in the database using SQL queries;
- Pagination that uses the Bootstrap style. It comes with a limit of 10 items per page with next, previous, last and first page buttons.
- HTML, Bootstrap, and Font Awesome to build the web page with the table and pagination.

Overall, this code is used for connecting to a database, extracting and presenting data on a web page, using PHP for database connection and data retrieval, and HTML, Bootstrap, and Font Awesome to present the data on the web page in the form of a table.

### Information

How do I connect the database? 
You can change it from the first few lines:

```php
const DB_HOST = 'localhost'; // Don't touch, it always is localhost
const DB_NAME = 'amxx'; // The name of your database
const DB_USER = 'amxx'; // The user of youre database
const DB_PASSWORD = ''; // The password of youre database
```

How do I change the item display limit?

```php
$results_per_page = 10; // 10 is how many items it will display on a page.
```
