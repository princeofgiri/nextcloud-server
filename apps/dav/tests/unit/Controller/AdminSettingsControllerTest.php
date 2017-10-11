<?php
/**
 * @copyright 2017, Georg Ehrke <oc.list@georgehrke.com>
 *
 * @author Georg Ehrke <oc.list@georgehrke.com>
 *
 * @license GNU AGPL version 3 or any later version
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as
 * published by the Free Software Foundation, either version 3 of the
 * License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 */

namespace OCA\DAV\Tests\Unit\DAV\Settings;

use OCA\DAV\Controller\AdminSettingsController;
use OCP\IConfig;
use OCP\IRequest;
use Test\TestCase;

class AdminSettingsControllerTest extends TestCase  {

	/** @var IConfig|\PHPUnit_Framework_MockObject_MockObject */
	private $config;

	/** @var AdminSettingsController */
	private $controller;

	public function setUp() {
		parent::setUp();

		$this->config = $this->createMock(IConfig::class);
		/** @var IRequest $request */
		$request = $this->createMock(IRequest::class);

		$this->controller = new AdminSettingsController('dav', $request,
			$this->config);
	}

	public function testSendInvitationNull() {
		$this->config->expects($this->never())
			->method('setAppValue');

		$response = $this->controller->setSendInvitations(null);

		$this->assertInstanceOf('OCP\AppFramework\Http\JSONResponse', $response);
		$this->assertEquals(400, $response->getStatus());
		$this->assertEquals([], $response->getData());
	}

	public function testSendInvitationTrue() {
		$this->config->expects($this->once())
			->method('setAppValue')
			->with('dav', 'sendInvitations', 'yes');

		$response = $this->controller->setSendInvitations(true);

		$this->assertInstanceOf('OCP\AppFramework\Http\JSONResponse', $response);
		$this->assertEquals(200, $response->getStatus());
		$this->assertEquals([], $response->getData());
	}

	public function testSendInvitationFalse() {
		$this->config->expects($this->once())
			->method('setAppValue')
			->with('dav', 'sendInvitations', 'no');

		$response = $this->controller->setSendInvitations(false);

		$this->assertInstanceOf('OCP\AppFramework\Http\JSONResponse', $response);
		$this->assertEquals(200, $response->getStatus());
		$this->assertEquals([], $response->getData());
	}
}
