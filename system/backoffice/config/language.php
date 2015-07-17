<?php

if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
	
	/*
 * |--------------------------------------------------------------------------
 * | Supported Languages
 * |--------------------------------------------------------------------------
 * |
 * | Contains all languages your site will store data in. Other languages can
 * | still be displayed via language files, thats totally different.
 * |
 * | Check for HTML equivilents for characters such as ï¿½ with the URL below:
 * | http://htmlhelp.com/reference/html40/entities/latin1.html
 * |
 * |
 * | array('en'=> 'English', 'fr'=> 'French', 'de'=> 'German')
 * |
 */
	// $config['supported_languages'] = array(
	// 'en' => array(
	// 'name' => 'English',
	// 'folder' => 'english',
	// 'direction' => 'ltr',
	// 'codes' => array('en', 'english', 'en_US'),
	// 'ckeditor' => null
	// ),
	// 'fa' => array(
	// 'name' => 'Ù¾Ø§Ø±Ø³ÛŒ',
	// 'folder' => 'persian',
	// 'direction' => 'rtl',
	// 'codes' => array('fa', 'persian', 'fa_IR'),
	// 'ckeditor' => null
	// ),
	// 'de' => array(
	// 'name' => 'Deutsch',
	// 'folder' => 'german',
	// 'direction' => 'ltr',
	// 'codes' => array('de', 'german', 'de_DE'),
	// 'ckeditor' => null
	// ),
	// 'ar' => array(
	// 'name' => 'Ø§Ù„Ø¹Ø±Ø¨ÙŠØ©',
	// 'folder' => 'arabic',
	// 'direction' => 'rtl',
	// 'codes' => array('ar', 'arabic', 'ar_SA'),
	// 'ckeditor' => null
	// ),
	// 'cs' => array(
	// 'name' => 'ÄŒesky',
	// 'folder' => 'czech',
	// 'direction' => 'ltr',
	// 'codes' => array('csy', 'czech', 'cs_CZ'),
	// 'ckeditor' => null
	// ),
	// 'el' => array(
	// 'name' => 'Î•Î»Î»Î·Î½Î¹ÎºÎ¬',
	// 'folder' => 'greek',
	// 'direction' => 'ltr',
	// 'codes' => array('ell', 'greek', 'el_GR'),
	// 'ckeditor' => null
	// ),
	// 'es' => array(
	// 'name' => 'Espa&ntilde;ol',
	// 'folder' => 'spanish',
	// 'direction' => 'ltr',
	// 'codes' => array('esp', 'spanish', 'es_ES'),
	// 'ckeditor' => null
	// ),
	// 'fr' => array(
	// 'name' => 'FranÃ§ais',
	// 'folder' => 'french',
	// 'direction' => 'ltr',
	// 'codes' => array('fra', 'french', 'fr_FR'),
	// 'ckeditor' => null
	// ),
	// 'it' => array(
	// 'name' => 'Italiano',
	// 'folder' => 'italian',
	// 'direction' => 'ltr',
	// 'codes' => array('ita', 'italian', 'it_IT'),
	// 'ckeditor' => null
	// ),
	// 'nl' => array(
	// 'name' => 'Nederlands',
	// 'folder' => 'dutch',
	// 'direction' => 'ltr',
	// 'codes' => array('dutch', 'nld', 'nl-NL'),
	// 'ckeditor' => null
	// ),
	// 'se' => array(
	// 'name' => 'Svenska',
	// 'folder' => 'swedish',
	// 'direction' => 'ltr',
	// 'codes' => array('se', 'swedish', 'se_SE'),
	// 'ckeditor' => null
	// ),
	// 'sl' => array(
	// 'name' => 'Slovensko',
	// 'folder' => 'slovenian',
	// 'direction' => 'ltr',
	// 'codes' => array('sl', 'slovenian', 'sl_SI'),
	// 'ckeditor' => null
	// ),
	// 'pl' => array(
	// 'name' => 'Polski',
	// 'folder' => 'polish',
	// 'direction' => 'ltr',
	// 'codes' => array('plk', 'polish', 'pl_PL'),
	// 'ckeditor' => null
	// ),
	// 'pt' => array(
	// 'name' => 'Portugu&ecirc;s de Portugal',
	// 'folder' => 'portuguese',
	// 'direction' => 'ltr',
	// 'codes' => array('ptb', 'portuguese-portugal', 'pt_PT'),
	// 'ckeditor' => 'pt-pt'
	// ),
	// 'br' => array(
	// 'name' => 'Portugu&ecirc;s do Brasil',
	// 'folder' => 'brazilian',
	// 'direction' => 'ltr',
	// 'codes' => array('ptb', 'portuguese-brazil', 'pt_BR'),
	// 'ckeditor' => 'pt-br'
	// ),
	// 'ru' => array(
	// 'name' => 'Ð ÑƒÑ�Ñ�ÐºÐ¸Ð¹',
	// 'folder' => 'russian',
	// 'direction' => 'ltr',
	// 'codes' => array('rus', 'russian', 'ru_RU'),
	// 'ckeditor' => null
	// ),
	// 'cn' => array(
	// 'name' => 'ç®€ä½“ä¸­æ–‡',
	// 'folder' => 'chinese_simplified',
	// 'direction' => 'ltr',
	// 'codes' => array('cn', 'chinese-simplified', 'zh_CN'),
	// 'ckeditor' => null
	// ),
	// 'tw' => array(
	// 'name' => 'ç¹�é«”ä¸­æ–‡',
	// 'folder' => 'chinese_traditional',
	// 'direction' => 'ltr',
	// 'codes' => array('tw', 'chinese-traditional', 'zh_TW'),
	// 'ckeditor' => null
	// ),
	// 'he' => array(
	// 'name' => '×¢×‘×¨×™×ª',
	// 'folder' => 'hebrew',
	// 'direction' => 'rtl',
	// 'codes' => array('he', 'hebrew', 'he_IL'),
	// 'ckeditor' => null
	// ),
	// 'lt' => array(
	// 'name' => 'LietuviÅ³',
	// 'folder' => 'lithuanian',
	// 'direction' => 'ltr',
	// 'codes' => array('lt', 'lithuanian', 'lt_LT'),
	// 'ckeditor' => null
	// ),
	// 'fi' => array(
	// 'name' => 'Suomi',
	// 'folder' => 'finnish',
	// 'direction' => 'ltr',
	// 'codes' => array('fi', 'finnish', 'fi_FI'),
	// 'ckeditor' => null
	// ),
	// 'da' => array(
	// 'name' => 'Dansk',
	// 'folder' => 'danish',
	// 'direction' => 'ltr',
	// 'codes' => array('da', 'danish', 'da_DK'),
	// 'ckeditor' => null
	// ),
	// 'id' => array(
	// 'name' => 'Bahasa Indonesia',
	// 'folder' => 'indonesian',
	// 'direction' => 'ltr',
	// 'codes' => array('id', 'indonesian' ,'id_ID'),
	// 'ckeditor' => null
	// ),
	// 'hu' => array(
	// 'name' => 'Magyar',
	// 'folder' => 'hungarian',
	// 'direction' => 'ltr',
	// 'codes' => array('hu', 'hu_HU'),
	// 'ckeditor' => null
	// ),
	// 'th' => array(
	// 'name' => 'à¹„à¸—à¸¢',
	// 'folder' => 'thai',
	// 'direction' => 'ltr',
	// 'codes' => array('th', 'thai', 'th_TH'),
	// 'ckeditor' => null
	// ),
	// 'hi' => array(
	// 'name' => 'à¤¹à¤¿à¤¨à¥�à¤¦à¥€',
	// 'folder' => 'hindi',
	// 'direction' => 'ltr',
	// 'codes' => array('hi', 'hindi', 'hi_IN'),
	// 'ckeditor' => null
	// )
	// );
	
/*
 * |--------------------------------------------------------------------------
 * | Default Language
 * |--------------------------------------------------------------------------
 * |
 * | If no language is specified, which one to use? Must be in the array above
 * |
 * | en
 * |
 */

$config ['supported_languages'] = array (
		'en' => array (
				'name' => 'English',
				'folder' => 'english',
				'direction' => 'ltr',
				'codes' => array (
						'en',
						'english',
						'en_US' 
				),
				'ckeditor' => null 
		),
		'vi' => array (
				'name' => 'Việt Nam',
				'folder' => 'vietnamese',
				'direction' => 'ltr',
				'codes' => array (
						'vi',
						'vietnamese',
						'vi_VI' 
				),
				'ckeditor' => null 
		)
		 
);

$config ['default_language'] = 'en';

/*
 * |--------------------------------------------------------------------------
 * | Detect language using Accept-Language
 * |--------------------------------------------------------------------------
 * |
 * | Whether or not to take into account the Accept-Language client header
 * |
 * | Only turn it on for admin panel:
 * | $config['check_http_accept_language'] = (bool) preg_match('@\/admin(\/.+)?$@', $_SERVER['REQUEST_URI']);
 * |
 */
$config ['check_http_accept_language'] = TRUE;
