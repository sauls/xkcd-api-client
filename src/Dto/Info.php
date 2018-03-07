<?php
/**
 * This file is part of the sauls/Xkcd-api-client package.
 *
 * @author    Saulius Vaičeliūnas <vaiceliunas@inbox.lt>
 * @link      http://saulius.vaiceliunas.lt
 * @copyright 2018
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sauls\Component\Xkcd\Api\Dto;

class Info
{
    private $month;
    private $num;
    private $link;
    private $year;
    private $news;
    private $safeTitle;
    private $transcript;
    private $alt;
    private $img;
    private $title;
    private $day;

    public function getMonth(): string
    {
        return $this->month;
    }

    public function setMonth(string $month): void
    {
        $this->month = $month;
    }

    public function getNum(): int
    {
        return $this->num;
    }

    public function setNum(int $num): void
    {
        $this->num = $num;
    }

    public function getLink(): string
    {
        return $this->link;
    }

    public function setLink(string $link): void
    {
        $this->link = $link;
    }

    public function getYear(): string
    {
        return $this->year;
    }

    public function setYear(string $year): void
    {
        $this->year = $year;
    }

    public function getNews(): string
    {
        return $this->news;
    }

    public function setNews(string $news): void
    {
        $this->news = $news;
    }

    public function getSafeTitle(): string
    {
        return $this->safeTitle;
    }

    public function setSafeTitle(string $safeTitle): void
    {
        $this->safeTitle = $safeTitle;
    }

    public function getTranscript(): string
    {
        return $this->transcript;
    }

    public function setTranscript(string $transcript): void
    {
        $this->transcript = $transcript;
    }

    public function getAlt(): string
    {
        return $this->alt;
    }

    public function setAlt(string $alt): void
    {
        $this->alt = $alt;
    }

    public function getImg(): string
    {
        return $this->img;
    }

    public function setImg(string $img): void
    {
        $this->img = $img;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getDay(): string
    {
        return $this->day;
    }

    public function setDay(string $day): void
    {
        $this->day = $day;
    }
}
