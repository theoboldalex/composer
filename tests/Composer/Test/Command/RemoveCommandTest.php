<?php declare(strict_types=1);

/*
 * This file is part of Composer.
 *
 * (c) Nils Adermann <naderman@naderman.de>
 *     Jordi Boggiano <j.boggiano@seld.be>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Composer\Test\Command;

use Composer\Test\TestCase;
use Symfony\Component\Console\Exception\InvalidArgumentException;

class RemoveCommandTest extends TestCase
{
    public function testExceptionThrownIfNoPackagesProvided(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Not enough arguments (missing: "packages")');
        $appTester = $this->getApplicationTester();
        $appTester->run(['command' => 'remove']);
    }

    public function testExceptionThrownWhereNoLockFileIsFoundAndUnusedCommandPassed(): void
    {
        $this->expectException(UnexpectedValueException::class);
        $this->expectExceptionMessage('A valid composer.lock file is required to run this command with --unused');
        $this->initTempComposer([]);
        $appTester = $this->getApplicationTester();
        $appTester->run(['command' => 'remove', '--unused' => true]);
    }
}
