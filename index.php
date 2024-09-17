<?php

namespace florianboegner\sa11y;

/**
 * Kirby sa11y
 *
 * @version   3.2.3
 * @author    Florian Bögner <kontakt@florianboegner.com>
 * @copyright Florian Bögner <kontakt@florianboegner.com>
 * @link      https://github.com/FlorianBoe/kirby-sa11y
 * @license   GPLv2
 */

\Kirby::plugin('florianboegner/kirby-sa11y', [

	'snippets' => [
		'sa11y'	=> __DIR__ . '/snippets/sa11y.php'
	],

]);
