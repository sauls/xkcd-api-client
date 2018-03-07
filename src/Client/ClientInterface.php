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

namespace Sauls\Component\Xkcd\Api\Client;

use Psr\SimpleCache\CacheInterface;
use Sauls\Component\Xkcd\Api\Dto\Info;

interface ClientInterface
{
    public function get(int $num): Info;
    public function getLatest(): Info;
    public function getRandom(): Info;
    public function setCache(CacheInterface $cache): void;
}
