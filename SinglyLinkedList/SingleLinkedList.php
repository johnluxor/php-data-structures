<?php

namespace johnluxor\phpDataStructure\SinglyLinkedList;

use RuntimeException;

/**
 * Class SingleLinkedList
 * @package johnluxor\phpDataStructure\SinglyLinkedList
 */
class SingleLinkedList
{
    /**
     * @var SListNode
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
        $this->head = new SListNode($value, $this->head);
        $this->size++;
    }

    /**
     * @return mixed
     */
    public function popFront()
    {
        $value = $this->head;
        $this->head = $value->getNext();
        $this->size--;

        return $value->getItem();
    }

    /**
     * @param $value
     */
    public function pushBack($value): void
    {
        $current = $this->head;
        while ($current->getNext()) {
            $current = $current->getNext();
        }
        $current->setNext(new SListNode($value));
        $this->size++;
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
    public function getFront()
    {
        return $this->head->getItem();
    }

    /**
     * @return mixed
     */
    public function getBack()
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
            $prev->setNext(new SListNode($value, $prev->getNext()));
            $this->size++;
        }
    }

    /**
     * @param int $index
     */
    public function remove(int $index)
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
     * @param int $n
     * @return null
     */
    public function getNthValueFromEnd(int $n)
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

    /**
     * Reverse linked list
     */
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
            $prev = $current;
            $current = $next;
        }

        $this->head = $prev;
    }

    /**
     * @param $value
     */
    public function removeValue($value)
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

