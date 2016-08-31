<?php
/**
 * User: casperlai
 * Date: 2016/8/31
 * Time: 下午5:15
 */

namespace Casperlaitw\LaravelFbMessenger\Collections;

use Casperlaitw\LaravelFbMessenger\Exceptions\ValidatorStructureException;
use Casperlaitw\LaravelFbMessenger\Messages\Element;
use pimax\Messages\MessageElement;

/**
 * Class ElementCollection
 * @package Casperlaitw\LaravelFbMessenger\Collections
 */
class ElementCollection extends BaseCollection
{
    /**
     * @param        $title
     * @param        $description
     * @param string $image
     * @param string $url
     *
     * @return Element
     */
    public function addElement($title, $description, $image = '', $url = '')
    {
        $element = new Element($title, $description, $image, $url);
        $this->elements[] = $element;

        return $element;
    }

    /**
     * @return array
     */
    public function toArray() : array
    {
        $elements = [];

        foreach ($this->elements as $element) {
            $elements[] = $element->toData();
        }

        return $elements;
    }

    /**
     * @param $elements
     *
     * @return bool
     * @throws \Casperlaitw\LaravelFbMessenger\Exceptions\ValidatorStructureException
     */
    public function validator($elements) : bool
    {
        if (!$elements instanceof MessageElement) {
            throw new ValidatorStructureException(
                'The `generic` structure item should be instance of `\\pimax\\Messages\\MessageElement`'
            );
        }

        return true;
    }
}