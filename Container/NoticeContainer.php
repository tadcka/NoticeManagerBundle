<?php
/*
 * The MIT License (MIT)
 *
 * Copyright (c) 2013 Tadas Gliaubicas <tadcka89@gmail.com>
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy of
 * this software and associated documentation files (the "Software"), to deal in
 * the Software without restriction, including without limitation the rights to
 * use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of
 * the Software, and to permit persons to whom the Software is furnished to do so,
 * subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS
 * FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR
 * COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER
 * IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN
 * CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 */

namespace Tadcka\NoticeManagerBundle\Container;

class NoticeContainer implements NoticeContainerInterface
{
    private $container = array();

    /**
     * Add notice
     *
     * @param string $notice
     * @param string $type
     * @return NoticeContainer
     */
    public function add($notice, $type)
    {
        $this->container[$type][] = $notice;

        return $this;
    }

    /**
     * Set notices
     *
     * @param array $notices
     * @param string $type
     * @return NoticeContainer
     */
    public function setNotices(array $notices, $type)
    {
        $this->container[$type] = $notices;

        return $this;
    }

    /**
     * Get notices by type
     *
     * @param string $type
     * @return array
     */
    public function getNoticesByType($type)
    {
        if (isset($this->container[$type])) {
            return $this->container[$type];
        }

        return array();
    }

    /**
     * Get notices
     *
     * @return array
     */
    public function getNotices()
    {
        return $this->container;
    }

    /**
     * Remove notices by type
     *
     * @param string $type
     * @return NoticeContainer
     */
    public function removeNoticesByType($type)
    {
        if (isset($this->container[$type])) {
            unset($this->container[$type]);
        }

        return $this;
    }

    /**
     * Remove notices
     *
     * @return NoticeContainer
     */
    public function removeNotices()
    {
        $this->container = array();

        return $this;
    }
}
