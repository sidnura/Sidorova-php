<?php

declare(strict_types=1);

abstract class Animal
{
    protected string $name;
    private int $age;

    public function __construct(string $name, int $age)
    {
        $this->name = $name;
        $this->age = $age;
    }

    public function eat(): void
    {
        echo "{$this->name} ест.<br/>";
    }

    public function sleep(): void
    {
        echo "{$this->name} спит.<br/>";
    }

    abstract public function makeSound(): void;

    public function getAge(): int
    {
        return $this->age;
    }

    public function getName(): string
    {
        return $this->name;
    }
}

class Cat extends Animal
{
    public function makeSound(): void
    {
        echo "{$this->name} говорит: Мяу!<br/>";
    }
}

class Dog extends Animal
{
    public function makeSound(): void
    {
        echo "{$this->name} говорит: Гав!<br/>";
    }
}

class Bird extends Animal
{
    public function makeSound(): void
    {
        echo "{$this->name} говорит: Чирик!<br/>";
    }
}

function getAgeString(int $age): string
{
    if ($age % 10 === 1 && $age % 100 !== 11) {
        return "{$age} год";
    }

    if (
        $age % 10 >= 2
        && $age % 10 <= 4
        && ($age % 100 < 10 || $age % 100 >= 20)
    ) {
        return "{$age} года";
    }

    return "{$age} лет";
}

function printAnimalInfo(Animal $animal): void
{
    echo 'Имя: ' . $animal->getName() . '<br/>';
    echo 'Возраст: ' . getAgeString($animal->getAge()) . '<br/>';
    $animal->eat();
    $animal->sleep();
    $animal->makeSound();
    echo '<br/>';
}

$cat = new Cat('Барсик', 3);
$dog = new Dog('Шарик', 5);
$bird = new Bird('Чижик', 1);

$animals = [$cat, $dog, $bird];

foreach ($animals as $animal) {
    printAnimalInfo($animal);
}
