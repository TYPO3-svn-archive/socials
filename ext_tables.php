<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}

//t3lib_extMgm::addLLrefForTCAdescr(
//		'tt_content.pi_flexform.news_pi1.list', 'EXT:' . $_EXTKEY . '/Resources/Private/Language/locallang_csh_flexforms.xml');


/***************
 * Plugin
 */
Tx_Extbase_Utility_Extension::registerPlugin(
	$_EXTKEY,
	'Pi1',
		'LLL:EXT:' . $_EXTKEY . '/Resources/Private/Language/locallang_be.xml:pi1_title'
);


$extensionName = t3lib_div::underscoredToUpperCamelCase($_EXTKEY);
$pluginSignature = strtolower($extensionName) . '_pi1';

$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_excludelist'][$pluginSignature] = 'layout,recursive,select_key,pages';
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';
t3lib_extMgm::addPiFlexFormValue($pluginSignature, 'FILE:EXT:' . $_EXTKEY . '/Configuration/FlexForms/flexform.xml');


/***************
 * Default TypoScript
 */
t3lib_extMgm::addStaticFile($_EXTKEY, 'Configuration/TypoScript', 'Socials');

/***************
 * Wizard pi1
 */
if (TYPO3_MODE == 'BE') {
	$TBE_MODULES_EXT['xMOD_db_new_content_el']['addElClasses'][$pluginSignature . '_wizicon'] =
		t3lib_extMgm::extPath($_EXTKEY) . 'Resources/Private/Php/class.' . $_EXTKEY . '_wizicon.php';
}

?>