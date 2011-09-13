<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2011 Georg Ringer <typo3@ringerge.org>
*  All rights reserved
*
*  This script is part of the TYPO3 project. The TYPO3 project is
*  free software; you can redistribute it and/or modify
*  it under the terms of the GNU General Public License as published by
*  the Free Software Foundation; either version 2 of the License, or
*  (at your option) any later version.
*
*  The GNU General Public License can be found at
*  http://www.gnu.org/copyleft/gpl.html.
*
*  This script is distributed in the hope that it will be useful,
*  but WITHOUT ANY WARRANTY; without even the implied warranty of
*  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
*  GNU General Public License for more details.
*
*  This copyright notice MUST APPEAR in all copies of the script!
***************************************************************/

/**
 * Url Utitlity class
 *
 * @package TYPO3
 * @subpackage tx_socials
 */
class Tx_Socials_Utility_Url {

	/**
	 * Prepend current url if url is relative
	 *
	 * @param string $url given url
	 * @return string
	 */
	public static function prependDomain($url) {
		if (!t3lib_div::isFirstPartOfStr($url, t3lib_div::getIndpEnv('TYPO3_SITE_URL'))) {
			$url =  t3lib_div::getIndpEnv('TYPO3_SITE_URL') . $url;
		}

		return $url;
	}
}
?>