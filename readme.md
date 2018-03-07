## About FancyBank back account
> Using this small program to explain about the OOP, design pattern, SOLID principle, Law of demeter and PHPUnit.

### Design Patterns:
* Strategy design pattern:
> In the Strategy Pattern a context will choose the appropriate concrete extension of a class interface

```php
interface OverdraftInterface {...}
```

> **SilverOverdraft** class encapsulates it's own algorithm which 
makes the algorithms interchangeable within that family.  
```php
class SilverOverdraft implements OverdraftInterface {...}
```
* Null Object design pattern:
> The intent of a Null Object is to encapsulate the absence of an object by providing a substitutable alternative that offers suitable default do nothing behavior. In short, a design where "nothing will come of nothing", **NoOverdraft** class is the real example of using null object design pattern. 

```php
class NoOverdraft implements OverdraftInterface {...}
```
---

### Law of Demeter LoD:
* Tell, Don't Ask
> You should endeavor to tell objects what you want them to do; do not ask them questions about their state, make a decision, and then tell them what to do. The idea is to avoid coupling the internal structure of an object to clients.
In this example shows the chaining to ask something.
```php
return ($newBalance < 0 && !$bankAccount
                ->getOverdraft()
                ->isGrantOverdraftFunds($newBalance));
```

---

> To run the program, please read the follow:
#### Requirements
* PHP 7.x

#### Features
1. Open account
2. Apply overdraft
3. Deposit funds
4. Withdraw funds
5. Display balance
6. Close account


#### Installation
```
$ composer install
```

#### Unit Test
```
$ phpunit
```

#### Manual Test
```
$ php src/index.php
```