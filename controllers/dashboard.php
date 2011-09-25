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
		$this->config->load('google_analytics');

	}

	function index()
	{
		$this->ga_config = $this->config->item('google_analytics');
		try {
			$this->load->module_library('google_analytics', 'analytics', array(
				'username' => $this->ga_config['email'],
				'password' => $this->ga_config['password']
			));		
			$this->analytics->setProfileById('ga:' . $this->ga_config['profile_id']);
			$end_date = date('Y-m-d');
			$start_date = date('Y-m-d', strtotime('-1 month')); // Past month
			$this->analytics->setDateRange($start_date, $end_date);
			$visits = $this->analytics->getVisitors();
			$views = $this->analytics->getPageviews();
		}
		catch(Exception $e) {
			echo '<p class="dashboard_error">Error connecting to Google Analytics. Please check your settings.</p>';
			die();
		}
		// build tables 
		if (count($visits))
		{
			foreach ($visits as $date => $visit)
			{
				$year = substr($date, 0, 4);
				$month = substr($date, 4, 2);
				$day = substr($date, 6, 2);
				$utc = mktime(date('h') + 1, NULL, NULL, $month, $day, $year) * 1000;
				$flot_datas_visits[] = '[' . $utc . ',' . $visit . ']';
				$flot_datas_views[] = '[' . $utc . ',' . $views[$date] . ']';
			}
			$flot_data_visits = '[' . implode(',', $flot_datas_visits) . ']';
			$flot_data_views = '[' . implode(',', $flot_datas_views) . ']';
		}
		$data['analytic_visits'] = $flot_data_visits;
		$data['analytic_views'] = $flot_data_views;
		$this->load->view('graph.php', $data);
	}
}