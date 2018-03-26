# Ptypes [WIP]
[![Packagist](https://img.shields.io/packagist/v/symfony/symfony.svg)](https://packagist.org/packages/howz1t/ptypes) [![license](https://img.shields.io/github/license/mashape/apistatus.svg)](https://github.com/HOWZ1T/Ptypes/blob/master/LICENSE.md)
## This package is currently a Work In Progress.
This package provides useful data types for use in PHP.

## Install
You can install this package via composer:
```bash
composer require howz1t/Ptypes
```

## License
You're free to use this package which is licensed under the [MIT-LICENSE](LICENSE.md)

## Documentation
Detailed documentation is available [here](https://dylan-randall.com/documentation/ptypes/)

## Current Data Types
- Stack

## Stack Usage
First you must create a Stack object:
```php
$stack = new Stack(2);
```
Stacks have a minimum size of 2.

From here you have access to the methods of the stack object.
Note: the push and pop methods can be chained, however all other methods will end the chain.
e.g:
```php
$stack->push(1)->push(2)->pop()->size(); // returns the size of the stack after the pushes and pops.
```

## Stack Methods

### push
```php
/**
 * Push (add) the item to the Stack.
 *
 * @param object $item
 */
public function push($item)
```

Example:
```php
$stack->push(1);
```

### pop
```php
/**
 * Pop (remove) the top item from the Stack.
 */
public function pop()
```

Example:
```php
$stack->pop();
```


### is_empty
```php
/**
 * is_empty tests whether the stack is empty.
 *
 * @return boolean
 */
public function is_empty()
```

Example:
```php
$stack->is_empty();
```

### size
```php
/**
 * Size, returns the size of the stack.
 *
 * @return int
 */
public function size()
```

Example:
```php
$stack->size();
```

### peek
```php
/**
 * Peek returns the top element of the stack, returns null if the stack is empty.
 * 
 * @return object
 */
public function peek()
```

Example:
```php
$stack->peek();
```

### count
```php
/**
 * Count, same functionality as Size.
 * Overrides the default count function call on this class.
 *
 * @return int
 */
public function count()
```

Example:
```php
count($stack);
```

### __toString
```php
/**
 * Overrides the default toString call on this class.
 *
 * @return string
 */
public function __toString()
```

Example:
```php
echo $stack;
```

## Contributing

Contribution is always appreciated. 
If you are contributing please remember to update the README and provide test units.
Any contributions WITHOUT test units will NOT be accepted.


## Author
[Dylan Randall aka HOWZ1T](https://github.com/howz1t)
