<?php

// logged-in users only
if (!kirby()->user()) {
	return false;
}

// if set, limit to certain templates only
if (!empty($templates) && !in_array(page()->intendedTemplate(), $templates)) {
	return false;
}

// if set, limit to certain user ids only
if (!empty($users) && !in_array(kirby()->user()->id(), $users)) {
	return false;
}

// if set, limit to certain user roles only
if (!empty($roles) && !in_array(kirby()->user()->role()->id(), $roles)) {
	return false;
}

$language = kirby()->language();
$lang_code = $language->code();

// add all auxilliary js config files and libraries
$jsAux[] = 'media/plugins/florianboegner/kirby-sa11y/vendor/js/lang/' . $lang_code . '.umd.js';

// add props
if (empty($options) || !is_array($options)) {
	$options = [];
}
if (!isset($options['checkRoot'])) {
	$options['checkRoot'] = 'body';
}
$props = '';
foreach ($options as $key => $value) {
	$props .= $key . ': ' . (is_string($value) ? '"' . $value . '"' : $value) . ',';
}

// instantiate
$script = '<script>
			Sa11y.Lang.addI18n(Sa11yLang' . ucfirst($lang_code) .  '.strings);
			const sa11y = new Sa11y.Sa11y({' . $props . '});
		</script>';

// the core library and style sheet
$jsMain = 'media/plugins/florianboegner/kirby-sa11y/vendor/js/sa11y.umd.min.js';
$css = 'media/plugins/florianboegner/kirby-sa11y/vendor/css/sa11y.min.css';

// echo the required script and style tags
echo css($css ?? []) . js($jsAux ?? []) . js($jsMain) . ($script ?? '');
