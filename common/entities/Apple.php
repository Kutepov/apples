<?php

namespace common\entities;

use common\models\AppleRecord;
use Exception;

class Apple extends AppleRecord
{
    private const DEFAULT_SIZE = 1;
    public const ROTTEN_TIME = 5 * 60 * 60;

    public const STATUS_ON_TREE = 1;
    public const STATUS_FELL = 0;
    public const STATUS_ROTTEN = -1;

    public const STATUSES = [
        self::STATUS_ON_TREE,
        self::STATUS_FELL,
    ];

    public const COLOR_GREEN = 'green';
    public const COLOR_RED = 'red';
    public const COLOR_YELLOW = 'yellow';

    public const COLORS = [
        self::COLOR_GREEN,
        self::COLOR_RED,
        self::COLOR_YELLOW
    ];

    public const COLORS_VALUES = [
        self::COLOR_GREEN => 'Зеленое',
        self::COLOR_RED => 'Красное',
        self::COLOR_YELLOW => 'Желтое',
    ];

    public const STATUSES_VALUES = [
        self::STATUS_ON_TREE => 'На дереве',
        self::STATUS_FELL => 'Упало',
    ];

    public const STATES_VALUES = [
        self::STATUS_ON_TREE => 'На дереве',
        self::STATUS_FELL => 'Упало',
        self::STATUS_ROTTEN => 'Гнилое',
    ];

    public static function create(?string $color = null): self
    {
        $apple = new self();
        $apple->color = $color ?? self::COLORS[
            array_rand(self::COLORS)
        ];
        $apple->status = self::STATUS_ON_TREE;
        $apple->size = self::DEFAULT_SIZE;
        return $apple;
    }

    public function eat(int $part): void
    {
        $part /= 100;
        if ($this->status === self::STATUS_ON_TREE) {
            throw new Exception('Нельзя съесть яблоко, которое на дереве.');
        } elseif ($this->isRotten()) {
            throw new Exception('Нельзя съесть яблоко, которое испорчено.');
        } elseif ($this->size < $part) {
            throw new Exception('Нельзя съесть больше, чем оставшаяся часть.');
        }

        $this->size -= $part;
    }

    public function isEaten(): bool
    {
        return $this->size === 0.0;
    }

    private function isRotten(): bool
    {
        return $this->getState() === self::STATUS_ROTTEN;
    }

    public function getState(): int
    {
        if ($this->fell_at && time() - $this->fell_at > self::ROTTEN_TIME) {
            return self::STATUS_ROTTEN;
        }

        return $this->status;
    }

    public function fallToGround(): void
    {
        if ($this->getState() !== self::STATUS_ON_TREE) {
            throw new Exception('Яблоко не может упасть, оно уже ' . mb_strtolower(self::STATES_VALUES[$this->getState()]) . '.');
        }
        $this->fell_at = time();
        $this->status = self::STATUS_FELL;
    }
}