<?php

namespace johnluxor\phpDataStructures\DynamicArray;

use RuntimeException;
use SplFixedArray;

/**
 * Class DynamicArray
 *
 * Implementation of mutable array with automatic resizing with linear search
 *
 */
class DynamicArray
{
    /**
     * @var int
     */
    private $size = 0;
    /**
     * @var int
     */
    private $capacity;
    private $array;

    public function __construct(int $capacity)
    {
        if ($capacity < 1) {
            throw new RuntimeException('Cannot create array with capacity below 1');
        }
        $this->capacity = $capacity;
        $this->array = new SplFixedArray($capacity);
    }

    /**
     * Get number of elements in array
     *
     * @return int
     */
    public function getSize(): int
    {
        return $this->size;
    }

    /**
     * Get capacity size of array
     *
     * @return int
     */
    public function getCapacity(): int
    {
        return $this->capacity;
    }

    /**
     * Check if array is empty
     *
     * @return bool
     */
    public function isEmpty(): bool
    {
        return $this->size === 0;
    }

    /**
     * Get element of array by index
     *
     * @param int $index
     * @return mixed
     */
    public function get(int $index)
    {
        $this->checkIndexInRange($index);

        return $this->array[$index];
    }

    /**
     * Add element to the end of array.
     * If array is full then increase the capacity of array by 2
     *
     * @param mixed $value
     */
    public function push($value): void
    {
        if ($this->size === $this->capacity) {
            $this->resize($this->capacity * 2);
        }
        $this->array[$this->size] = $value;
        $this->size++;
    }

    /**
     * Add element in array in certain index with moving other elements
     * If array is full then increase the capacity by 2
     *
     * @param int $index
     * @param $value
     */
    public function insert(int $index, $value): void
    {
        $this->checkIndexInRange($index);

        if ($this->size === $this->capacity) {
            $this->resize($this->capacity * 2);
        }
        for ($i = $this->size; $i > $index; $i--) {
            $this->array[$i] = $this->array[$i - 1];
        }
        $this->array[$index] = $value;
        $this->size++;
    }

    /**
     * Add element in the front of array
     *
     * @param $value
     */
    public function prepend($value): void
    {
        $this->insert(0, $value);
    }

    /**
     * Return last element of array and remove ot from array
     * @return mixed
     */
    public function pop()
    {
        if ($this->isEmpty()) {
            throw new RuntimeException('Array is empty');
        }

        $value = $this->array[$this->size - 1];
        $this->delete($this->size - 1);

        return $value;
    }

    /**
     * Delete element by index
     *
     * @param int $index
     */
    public function delete(int $index): void
    {
        $this->checkIndexInRange($index);

        if ($index < $this->size - 1) {
            for ($i = $index; $i < $this->size - 1; $i++) {
                $this->array[$i] = $this->array[$i + 1];
            }
        }
        unset($this->array[$this->size - 1]);
        $this->size--;

        if (($this->capacity / $this->size) >= 4) {
            $this->resize($this->capacity / 2);
        }
    }

    /**
     * Return the key if element was found or -1
     * @param $value
     * @return int|string
     */
    public function find($value)
    {
        foreach ($this->array as $key => $item) {
            if ($item === $value) {
                return $key;
            }
        }

        return -1;
    }

    /**
     * @param int $newCapacity
     */
    private function resize(int $newCapacity): void
    {
        $newArray = new SplFixedArray($newCapacity);

        for ($i = 0; $i < $this->size; $i++) {
            $newArray[$i] = $this->array[$i];
        }
        $this->array = $newArray;
        $this->capacity = $newCapacity;
    }

    /**
     * @param int $index
     */
    private function checkIndexInRange(int $index): void
    {
        if ($index < 0 || $index >= $this->size) {
            throw new RuntimeException('Index out of range');
        }
    }
}