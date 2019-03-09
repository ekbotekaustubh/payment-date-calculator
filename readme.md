#Payment date calculator

A command line utility which generates csv file containing salary and bonus date from given month and year. 

- The base salaries are paid on the last day of the month unless that day is a
Saturday or a Sunday (weekend).
- On the 15th of every month bonuses are paid for the previous month, unless
that day is a weekend. In that case, they are paid the first Wednesday after the
15th.

Objective of project is to study following techniques in this project
- Code coverage
- Test quality (Proper asserts, logs, helpful message)
- Writing an testable code (Code quality)
- Mocking
- Data fixtures
- Test organization

## Prerequisites
- php >= 7.1
- Composer 

## Installation
- Clone the package
- Composer install

## Run application
php index.php <filename.csv> <month> <year>

Out of 3 parameters filename is mandatory. 
If month and year not given then it will take curreny month and current year.

## Run PHPUnit test
./vendor/bin/phpunit

## Code coverage
./vendor/bin/phpunit --coverage-html <path/to/directory>

## Author
Kaustubh Ekbote - <a href="https://github.com/ekbotekaustubh">ekbotekaustubh</a>

