<?php

namespace Medology\Behat\Mink\Models\Geometry;

/**
 * Class Rectangle.
 */
class Rectangle
{
    /** @var int left x position */
    public $left = 0;

    /** @var int top y position */
    public $top = 0;

    /** @var int right x position */
    public $right = 0;

    /** @var int bottom y position */
    public $bottom = 0;

    /**
     * Rectangle constructor.
     * Corner one is the top left corner.
     * Corner three is the bottom left corner.
     *
     * @param int $left   left x position
     * @param int $top    top y position
     * @param int $right  right x position
     * @param int $bottom bottom y position
     */
    public function __construct($left, $top, $right, $bottom)
    {
        $this->left = $left;
        $this->top = $top;
        $this->right = $right;
        $this->bottom = $bottom;
    }

    /**
     * Checks if this is|is not inside another rectangle.
     *
     * @param  Rectangle $rectangle Rectangle to check if this one is inside of
     * @param  bool      $not       Changes to not fully in
     * @return bool      true if the specified rectangle is fully within this one, or false if not.
     */
    public function isFullyIn(Rectangle $rectangle, $not = false)
    {
        if (
            $not &&
            $this->left >= $rectangle->left &&
            $this->right <= $rectangle->right &&
            $this->top >= $rectangle->top &&
            $this->bottom <= $rectangle->bottom
        ) {
            return false;
        } elseif (
            !$not &&
            (
                $this->left < $rectangle->left ||
                $this->right > $rectangle->right ||
                $this->top < $rectangle->top ||
                $this->bottom > $rectangle->bottom
            )
        ) {
            return false;
        }

        return true;
    }
}
