## About FancyBank back account
> Use this small program to explain about OOP, design pattern, SOLID principle, Law of demeter and PHPUnit.

### Design pattern:
* Strategy design pattern:
> In the Strategy Pattern a context will choose the appropriate concrete extension of a class interface

```php
interface OverdraftInterface {...}
```

> SilverOverdraft class encapsulates it's own algorithm which 
makes the algorithms interchangeable within that family.  
```php
class SilverOverdraft implements OverdraftInterface {...}
```


> To run the program, please read the follow:
### Requirements
* PHP 7.x

### Features
1. Open account
2. Apply overdraft
3. Deposit funds
4. Withdraw funds
5. Display balance
6. Close account


### Installation
```
$ composer install
```

### Unit Test
```
$ phpunit
```

### Manual Test
```
$ php src/index.php
```