# Dominoes
A simple implementation of a Dominoes Game

## Installing :clapper:
### Prerequisites

To run this application you will need PHP installed on your machine.

Composer will be required to generate the autoload file, you can find information on how to install it [here](https://getcomposer.org/).

### Dependencies

There are no required dependencies to run the applications.

Some libraries are yoused to run the tests and style the project correctly.

### Setup

To run the application, first clone it:

```bash
  $ git clone git@github.com:pgoodjohn/domino.git
```

Then  cd  in the new directory, generate the autoload file by running:

```bash
  $ cd domino
  $ composer install --no-dev
```

You can then run the application, once again, via composer:

```bash
  $ composer run
```

If you want the output to be stored to a file rather than on `stdout`, you can run:

```bash
  $ composer run:to-file
```

Which will pipe the output of the program to `output`.

## Running the tests

The tests are contained in the `tests/` folder.
To run the suite you will need to install the development dependencies, you can do so by re-running Composer:

```bash
  $ composer install
```

You can then run the tests using:

```bash
  $ composer test
```

If you'd like the tests to automatically re-run when a file is changed, you can run:

```bash
  $ composer test:watch
```

## Coding style

This project follows the [`PSR-2` coding style](https://www.php-fig.org/psr/psr-2/) and it is enforced using `php-cs-fixer`,

To fix the style of your project, simply run:

```bash
  $ composer style:fix
```