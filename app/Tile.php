<?php

class Tile
{
    const LEFT = 0;
    const RIGHT = 1;
    protected $values;

    public function __construct($rightValue, $leftValue)
    {
        $this->values[self::LEFT] = $leftValue;
        $this->values[self::RIGHT] = $rightValue;
    }

    /**
     * Print the instanciated tile
     *
     * @return void
     */
    public function print()
    {
        printf("<%s;%s> ", $this->values[self::LEFT], $this->values[self::RIGHT]);
    }

    /**
     * Perform conversion to string
     *
     * @return string
     */
    public function __toString()
    {
        $string = "<" . $this->values[self::LEFT] . ";" . $this->values[self::RIGHT] . ">";
        return $string;
    }

    /**
     * Get the left value of the tile
     *
     * @return void
     */
    public function getLeft()
    {
        return $this->values[self::LEFT];
    }

    /**
     * Get the right value of the tile
     *
     * @return void
     */
    public function getRight()
    {
        return $this->values[self::RIGHT];
    }

    /**
     * Set the left value of the tile
     *
     * @return void
     */
    public function setLeft($value)
    {
        $this->values[self::LEFT] = $value;
    }
    
    /**
     * Set the right value of the tile
     *
     * @return void
     */
    public function setRight($value)
    {
        $this->values[self::RIGHT] = $value;
    }

    /**
     * Invert the tile switching left and right values
     *
     * @return void
     */
    public function invert()
    {
        $this->setLeft($this->getLeft() + $this->getRight());
        $this->setRight($this->getLeft() - $this->getRight());
        $this->setLeft($this->getLeft() - $this->getRight());
    }
}
