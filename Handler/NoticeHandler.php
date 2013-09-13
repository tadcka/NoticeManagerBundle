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

namespace Tadcka\NoticeManagerBundle\Handler;

use Symfony\Bundle\TwigBundle\TwigEngine;
use Symfony\Component\HttpFoundation\Session\Session;
use Tadcka\NoticeManagerBundle\Container\NoticeContainerInterface;
use Tadcka\NoticeManagerBundle\Type;

class NoticeHandler
{
    /**
     * @var TwigEngine
     */
    private $twig;

    /**
     * @var Session
     */
    private $session;

    public function __construct($twig, $session)
    {
        $this->twig = $twig;
        $this->session = $session;
    }

    public function getHtml(NoticeContainerInterface $container, $type = null)
    {
        $html = '';
        if ($type === null) {
            $html = $this->generateHtml($container, Type::NOTICE_SUCCESS);
            $html .= $this->generateHtml($container, Type::NOTICE_INFORMATION);
            $html .= $this->generateHtml($container, Type::NOTICE_WARNING);
            $html .= $this->generateHtml($container, Type::NOTICE_ERROR);
        } else {
            $html = $this->generateHtml($container, $type);
        }

        return $html;
    }

    private function generateHtml(NoticeContainerInterface $container, $type)
    {
        $notices = $container->getNoticesByType($type);
        if (count($notices) > 0) {
            $templateInfo = $this->managerTemplateInfo($type);

            if (($templateInfo['template_path'] !== null) && ($templateInfo['key'] !== null)) {
                return $this->twig->render(
                    $templateInfo['template_path'],
                    array($templateInfo['key'] => $notices)
                );
            }
        }

        return null;
    }

    private function managerTemplateInfo($type)
    {
        $templatePath = null;
        $key = null;
        switch ($type) {
            case Type::NOTICE_SUCCESS:
                $templatePath = 'TadckaNoticeManagerBundle:Notice:success.html.twig';
                $key = 'successes';
                break;
            case Type::NOTICE_INFORMATION:
                $templatePath = 'TadckaNoticeManagerBundle:Notice:information.html.twig';
                $key = 'informations';
                break;
            case Type::NOTICE_WARNING:
                $templatePath = 'TadckaNoticeManagerBundle:Notice:warning.html.twig';
                $key = 'warnings';
                break;
            case Type::NOTICE_ERROR:
                $templatePath = 'TadckaNoticeManagerBundle:Notice:error.html.twig';
                $key = 'errors';
                break;
        };

        return array('template_path' => $templatePath, 'key' => $key);
    }

    public function save(NoticeContainerInterface $container, $type = null)
    {
        $this->session->getFlashBag()->add('flash_messages', $this->getHtml($container, $type));
    }
}
