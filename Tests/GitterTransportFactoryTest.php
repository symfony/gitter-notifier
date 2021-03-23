<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\Notifier\Bridge\Gitter\Tests;

use Symfony\Component\Notifier\Bridge\Gitter\GitterTransportFactory;
use Symfony\Component\Notifier\Test\TransportFactoryTestCase;
use Symfony\Component\Notifier\Transport\TransportFactoryInterface;

/**
 * @author Christin Gruber <c.gruber@touchdesign.de>
 */
final class GitterTransportFactoryTest extends TransportFactoryTestCase
{
    public function createFactory(): TransportFactoryInterface
    {
        return new GitterTransportFactory();
    }

    public function createProvider(): iterable
    {
        yield [
            'gitter://api.gitter.im?room_id=5539a3ee5etest0d3255bfef',
            'gitter://token@api.gitter.im?room_id=5539a3ee5etest0d3255bfef',
        ];
    }

    public function supportsProvider(): iterable
    {
        yield [true, 'gitter://token@host?room_id=5539a3ee5etest0d3255bfef'];
        yield [false, 'somethingElse://token@host?room_id=5539a3ee5etest0d3255bfef'];
    }

    public function incompleteDsnProvider(): iterable
    {
        yield 'missing token' => ['gitter://api.gitter.im?room_id=5539a3ee5etest0d3255bfef'];
    }

    public function missingRequiredOptionProvider(): iterable
    {
        yield 'missing option: room_id' => ['gitter://token@host'];
    }

    public function unsupportedSchemeProvider(): iterable
    {
        yield ['somethingElse://token@host?room_id=5539a3ee5etest0d3255bfef'];
        yield ['somethingElse://token@host'];
    }
}
