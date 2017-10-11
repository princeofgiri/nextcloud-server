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

namespace OCA\DAV\Controller;

use OCP\AppFramework\Controller;
use OCP\AppFramework\Http;
use OCP\AppFramework\Http\JSONResponse;
use OCP\IConfig;
use OCP\IRequest;
use OCP\JSON;

class AdminSettingsController extends Controller {

	/** @var IConfig */
	private $config;

	/**
	 * AdminSettingsController constructor.
	 *
	 * @param string $appName
	 * @param IRequest $request
	 * @param IConfig $config
	 */
	public function __construct($appName,
								IRequest $request,
								IConfig $config) {
		parent::__construct($appName, $request);

		$this->config = $config;
	}

	/**
	 * @param boolean $sendInvitations
	 * @return JSONResponse
	 */
	public function setSendInvitations($sendInvitations)  {
		if ($sendInvitations === null) {
			return new JSONResponse([], Http::STATUS_BAD_REQUEST);
		}

		$this->config->setAppValue('dav', 'sendInvitations', $sendInvitations ? 'yes' : 'no');

		return new JSONResponse([]);
	}
}
