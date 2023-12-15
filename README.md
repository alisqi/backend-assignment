# Context
[AlisQI's expression engine](https://help.alisqi.com/article/370-advanced-calculations) allows users to configure
calculated form fields. For example, the following expression calculates the sum of two fields' values: `a + b`.

The expression engine is powered by [Twig](https://twig.symfony.com/). AlisQI wraps the user's expression
in a barebones Twig template, which is then rendered with the form field values provided as context:

```php
$twig->render(
  '{{ a + b }}',
  ['a' => 1000, 'b' => 337]
);
```

## Special case: empty values
Consider what happens if the form field for `b` *has no value* (i.e., the user left the form field empty).

Internally, this leads to `$b = null` (not `$b = ''`).

Twig will compile the template `{{ a + b }}` to PHP code which boils down to
```php
return $a + $b;
```

However, `$a + null === $a` for *any* `int|float $a`, since `null` is cast to `0`:
```php
var_export(1337 + null);  // outputs '1337'
var_export(+null);        // outputs '0'
```

# Assignment
Your assignment is to change the Twig sandbox in such a way `a + b` evaluates to an empty string if either `a` or `b`
is empty (`null`).

The script `calculator.php` runs a suite of tests and outputs the failing ones (see "How to run" below).
Therefore, it should produce no output with a valid solution in place.

May the force be with you!

## Stretch goal
For bonus points, make the sandbox do the same trick for subtraction, multiplication and division.

# How to run
You may use any PHP runtime you want and run `php calculator.php`. Don't forget to `composer install` first.

Alternatively, you can use the [Lando](https://docs.lando.dev/) config (in `.lando.yml`)
to spin up a PHP 8.2 container that's ready to go.

```shell
lando start      # to start the container
lando calculate  # to run `php calculator.php` inside the container
```

# How to hand in your solution
Don't publish your code to a public repo and/or send a pull request. Your solution needs to remain private!

You can either send us the code over email or invite this repo's owner to your cloned repo.
