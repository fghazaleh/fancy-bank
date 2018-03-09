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

### SOLID Principles:
* Single-responsibility Principle:
> A class should have one and only one reason to change, meaning that a class should have only one job.

> The **BankAccount** class has only one job which it holds the state of the bank account (balance, account status ..etc), for the logic of transaction and overdarft funds will be in other classes. 

```php
class BankAccount implements BackAccountInterface {
  ...
  public function transaction(BankTransactionInterface $bankTransaction){...}
  public function applyOverdraft(OverdraftInterface $overdraft){...}
}
```

* Open-closed Principle:
> Objects or entities should be open for extension, but closed for modification.

```php
interface BankTransactionInterface{
  ....
  public function applyTransaction(BackAccountInterface $bankAccount);
}  
```

```php
class DepositTransaction extends BaseTransaction implements BankTransactionInterface {...}
```
Used in the client
```php
$bankaccount = new BankAccount(500);
$bankaccount->transaction(new DepositTransaction(200));
$bankaccount->transaction(new WithdrawTransaction(150));
```

* Liskov substitution principle:
> Child classes should never break the parent class' type definitions. More details [click here](https://scotch.io/bar-talk/s-o-l-i-d-the-first-five-principles-of-object-oriented-design#toc-liskov-substitution-principle)

* Interface segregation principle:
> A client should never be forced to implement an interface that it doesn't use or clients shouldn't be forced to depend on methods they do not use. More details [click here](https://scotch.io/bar-talk/s-o-l-i-d-the-first-five-principles-of-object-oriented-design#toc-interface-segregation-principle)

* Dependency Inversion principle:
> Entities must depend on abstractions not on concretions. It states that the high level module must not depend on the low level module, but they should depend on abstractions.

```php
class BankAccount ... {
  public function applyOverdraft(OverdraftInterface $overdraft){...}
  public function transaction(BankTransactionInterface $bankTransaction){...}
}
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

For more details about LoD, please [click here](https://github.com/fghazaleh/fancy-bank/wiki/Law-of-Demeter-(LoD)) 

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
