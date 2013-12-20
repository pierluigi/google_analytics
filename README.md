# Google Analytics - FuelCMS Module

FuelCMS Website (http://getfuelcms.com/)
Version: 1

## Author
Initial port from PyroCMS by Pierlo (http://getfuelcms.com/forums/profile/710/pierlo)

## Credits
This module is a port of the Google Analytics widget provided by PyroCMS. 
It also makes use of the Analytics lib by Vincent Kleijnendorst.

## Description
Use this module to access Google Analytics stats directly inside the FuelCMS dashboard.

## Installation
Copy the google_analytics folder inside your /fuel/modules/ folder and edit the config/google_analytics.php file.

This module is designed for the dashboard and you need to add it do the 'dashboards' key in your MY_fuel.php config, eg

> $config['dashboards'] = array('google_analytics');



## FAQ
Q. Where can I find my GA numeric profile ID?
A. Here: [http://productforums.google.com/forum/#!topic/analytics/dRuAr1K4waI](http://productforums.google.com/forum/#!topic/analytics/dRuAr1K4waI)

Q. What about the Tracking Code?
A. See [http://support.google.com/analytics/bin/answer.py?hl=en&answer=1032385](http://support.google.com/analytics/bin/answer.py?hl=en&answer=1032385)
