<?php

namespace johnluxor\phpDataStructure\SinglyLinkedList;

/**
 * Class SListNode
 * The node of linked list
 *
 * @package johnluxor\phpDataStructure\SinglyLinkedList
 */
class SListNode
{
    private $item;
    /**
     * @var SListNode
     */
    private $next;

    public function __construct($item, SListNode $next = null)
    {
        $this->item = $item;
        $this->next = $next;
    }

    public function setItem($value): void
    {
        $this->item = $value;
    }

    public function setNext(SListNode $next): void
    {
        $this->next = $next;
    }

    public function getNext(): ?SListNode
    {
        return $this->next;
    }

    public function getItem()
    {
        return $this->item;
    }
}