<?php
require_once(FUEL_PATH.'/libraries/Fuel_base_controller.php');
 
 /**
 *	
 * Google Analytics - a FuelCMS Module
 * The dashboard controller will add a graph inside the dashboard 
 * displaying the profile's last month page views / unique visits.
 * This module is a port of PyroCMS's own stock GA widget.
 * Please visit http://pyrocms.com/ for more information and read the
 * shipped LICENSE file to know more.
 *
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 * Credits: http://www.pyrocms.com/
 *
 *
 * @author: Pierlo - http://getfuelcms.com/forums/profile/710/pierlo
 * @version 0.1
 */


class Dashboard extends Fuel_base_controller {
	
	function __construct()
	{
		parent::__construct();

	}

	function index()
	{
		if ($this->fuel->auth->has_permission('google_analytics'))
		{
			try {

				$visits = $this->fuel->google_analytics->visits();
				$views = $this->fuel->google_analytics->views();

			}
			catch(Exception $e) {
				echo '<p class="dashboard_error">'.lang('google_analytics_connect_error').'</p>';
				die();
			}
			$data['analytic_visits'] = json_encode($visits);
			$data['analytic_views'] = json_encode($views);
			$this->load->view('_admin/graph', $data);
		}
		
	}
}