<?php

namespace johnluxor\phpDataStructures\DoublyLinkedList;

class DSListNode
{
    private $item;
    private $next;
    private $prev;

    public function __construct($item, DSListNode $prev = null, DSListNode $next = null)
    {
        $this->item = $item;
        $this->next = $next;
        $this->prev = $prev;
    }

    public function setItem($value): void
    {
        $this->item = $value;
    }

    public function setNext(DSListNode $next): void
    {
        $this->next = $next;
    }

    public function setPrev(DSListNode $prev): void
    {
        $this->prev = $prev;
    }

    public function getNext(): ?DSListNode
    {
        return $this->next;
    }

    public function getItem()
    {
        return $this->item;
    }

    public function getPrev(): ?DSListNode
    {
        return $this->prev;
    }
}