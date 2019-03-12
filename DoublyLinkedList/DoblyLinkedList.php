<?php

namespace johnluxor\phpDataStructures\DoublyLinkedList;

use RuntimeException;

class DoblyLinkedList
{
    /**
     * @var DSlistNode
     */
    private $head;
    /**
     * @var int
     */
    private $size = 0;

    /**
     * @return int
     */
    public function getSize(): int
    {
        return $this->size;
    }

    /**
     * @return bool
     */
    public function isEmpty(): bool
    {
        return $this->head === null;
    }

    /**
     * @param $index
     * @return mixed
     */
    public function getValueAt($index)
    {
        if ($index > $this->size) {
            throw new RuntimeException('Index out of range');
        }

        $current = $this->head;
        for ($i = 1; $i < $index; $i++) {
            $current = $current->getNext();
        }

        return $current->getItem();
    }

    /**
     * @param $value
     */
    public function pushFront($value): void
    {
        $last = $this->head;
        $this->head = new DSListNode($value, null, $this->head);
        $last->setPrev($this->head);
        $this->size++;
    }

    /**
     * @return mixed
     */
    public function popFront()
    {
        $value = $this->head;
        $this->head = $value->getNext();
        $this->head->setPrev(null);
        $this->size--;

        return $value->getItem();
    }

    /**
     * @param $value
     */
    public function pushBack($value): void
    {
        if ($this->isEmpty()) {
            $this->pushFront($value);
        } else {
            $current = $this->head;
            while ($current->getNext()) {
                $current = $current->getNext();
            }
            $current->setNext(new DSlistNode($value, $current));
            $this->size++;
        }
    }

    /**
     * @return mixed
     */
    public function popBack()
    {
        if ($this->head === null) {
            throw new RuntimeException('List is empty');
        }

        $current = $this->head;
        $prev = null;
        while ($current->getNext()) {
            $prev = $current;
            $current = $current->getNext();
        }

        $value = $current->getItem();
        if ($prev !== null) {
            $prev->setNext(null);
        } else {
            $this->head = null;
        }
        $this->size--;

        return $value;
    }

    /**
     * @return mixed
     */
    public function front()
    {
        return $this->head->getItem();
    }

    /**
     * @return mixed
     */
    public function back()
    {
        $current = $this->head;
        while ($current->getNext()) {
            $current = $current->getNext();
        }

        return $current->getItem();
    }

    /**
     * @param $index
     * @param $value
     */
    public function insert(int $index, $value): void
    {
        if ($index > $this->size) {
            throw new RuntimeException('Index out of range');
        }

        $current = $this->head;
        $prev = null;
        for ($i = 1; $i < $index && $current; $i++) {
            $prev = $current;
            $current = $current->getNext();
        }
        if ($prev === null) {
            $this->pushFront($value);
        } else {
            $prev->setNext(new DSlistNode($value, $prev, $prev->getNext()));
            $this->size++;
        }
    }

    /**
     * @param $index
     */
    public function remove(int $index): void
    {
        if ($index > $this->size) {
            throw new RuntimeException('Index out of range');
        }
        $current = $this->head;
        $prev = null;
        for ($i = 1; $i < $index; $i++) {
            $prev = $current;
            $current = $current->getNext();
        }
        if ($prev === null) {
            $this->head = $current->getNext();
        } else {
            $prev->setNext($current->getNext());
        }
        $this->size--;
    }

    /**
     * @param $n
     * @return mixed
     */
    public function getNthFromEnd(int $n)
    {
        if ($n > $this->size) {
            return null;
        }
        $current = $this->head;
        for ($i = 1; $i <= $this->size - $n; $i++) {
            $current = $current->getNext();
        }

        return $current->getItem();
    }

    public function reverse(): void
    {
        if ($this->size === 1) {
            return;
        }

        $current = $this->head;
        $prev = null;
        $next = null;

        while ($current !== null) {
            $next = $current->getNext();
            $current->setNext($prev);
            $current->setPrev($next);
            $prev = $current;
            $current = $next;
        }

        $this->head = $prev;
    }

    /**
     * @param $value
     */
    public function removeValue($value): void
    {
        $current = $this->head;
        $prev = null;
        while ($current->getItem() !== $value) {
            $prev = $current;
            $current = $current->getNext();
        }
        if ($prev === null) {
            $this->head = $current->getNext();
        } else {
            $prev->setNext($current->getNext());
        }
        $this->size--;
    }

}
