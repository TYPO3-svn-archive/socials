<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2011 Georg Ringer <georg.ringer@cyberhouse.at>
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
 * Hook to display verbose information about pi1 plugin in Web>Page module
 *
 * @package TYPO3
 * @subpackage tx_socials
 */
class Tx_Socials_Hooks_CmsLayout {

	/**
	 * Extension key
	 */
	const extKey = 'socials';

	/**
	 * Path to the locallang file
	 * @var string
	 */
	protected $llPath;

	/**
	 * Returns information about this extension's pi1 plugin
	 *
	 * @param array $params Parameters to the hook
	 * @param mixed $pObj A reference to calling object
	 * @return string Information about pi1 plugin
	 */
	public function getExtensionSummary(array $params, $pObj) {
		$result = '';

		$this->llPath = 'LLL:EXT:' . self::extKey . '/Resources/Private/Language/locallang_be.xml';

		if ($params['row']['list_type'] == self::extKey . '_pi1') {
			$data = t3lib_div::xml2array($params['row']['pi_flexform']);

			if (is_array($data)) {
				$result .= '<table>' .
							$this->getSelectedSites($data) .
							$this->get2ClickSettings($data) .
						'</table>';
			}
		}

		return $result;
	}

	/**
	 * Render template layout configuration
	 *
	 * @param array $data flexform data
	 * @return string
	 */
	private function get2ClickSettings(array $data) {
		$content = '';

		$value = $this->getFieldFromFlexform($data, 'settings.2clickPrivacy');

		if ($value) {
			$content = $this->renderLine(
							$GLOBALS['LANG']->sL($this->llPath . ':flexforms_general.2clickPrivacy')
						);
		}

		return $content;
	}


	/**
	 * Render template layout configuration
	 *
	 * @param array $data flexform data
	 * @return string
	 */
	private function getSelectedSites(array $data) {
		$content = '';

		$items = t3lib_div::trimExplode(',', $this->getFieldFromFlexform($data, 'settings.items'), TRUE);

		if (count($items) > 0) {
			$itemTranslations = array();

			foreach($items as $item) {
				$itemTranslations[] = $GLOBALS['LANG']->sL($this->llPath . ':flexforms_general.items.' . $item, TRUE);
			}

			$content = implode(', ', $itemTranslations);
		} else {
			$content = '<div class="typo3-message message-warning">
							<div class="message-body">' . $GLOBALS['LANG']->sL($this->llPath . ':flexforms_general.items.nothing_selected', TRUE) . '
						</div></div>';
		}

		$content = $this->renderLine(
							$GLOBALS['LANG']->sL($this->llPath . ':flexforms_general.items'),
							$GLOBALS['LANG']->sL($content)
						);

		return $content;
	}

	/**
	 * Render a configuration line with a tr/td
	 *
	 * @param string $head
	 * @param string $content
	 * @return string rendered configuration
	 */
	protected function renderLine($head, $content = '') {
		if (empty($content)) {
			$content = '<tr>
							<td colspan="2" style="font-weight:bold;width:100px;">' . $head .	'</td>
						</tr>';
		} else {
			$content = '<tr>
							<td style="font-weight:bold;width:100px;">' . $head .	'</td>
							<td>' . $content . '</td>
						</tr>';
		}

		return $content;
	}

	/**
	 * Get field value from flexform configuration,
	 * including checks if flexform configuration is available
	 *
	 * @param array $flexform flexform configuration
	 * @param string $key name of the key
	 * @param string $sheet name of the sheet
	 * @return NULL if nothing found, value if found
	 */
	protected function getFieldFromFlexform($flexform, $key, $sheet = 'sDEF') {
		$flexform = $flexform['data'];
		if (is_array($flexform) && is_array($flexform[$sheet]) && is_array($flexform[$sheet]['lDEF'])
				&& is_array($flexform[$sheet]['lDEF'][$key]) && isset($flexform[$sheet]['lDEF'][$key]['vDEF'])
		) {
			return $flexform[$sheet]['lDEF'][$key]['vDEF'];
		}

		return NULL;
	}
}


if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/socials/Classes/Hooks/CmsLayout.php']) {
	require_once ($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/socials/Classes/Hooks/CmsLayout.php']);
}

?>