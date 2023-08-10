<?php

namespace common\helpers;

class Common {

	public static function printDate($timestamp) {
		return date('jS M Y', $timestamp);
	}

	public static function calculatePercentage(int $value, int $total) {
		if ($total == 0 || $value == 0) {
			return 0.0;
		}

		return (100.0 / (float) $total) * (float) $value;
	}

	public static function getPlaceholderUrl($width = 300, $height = 300, $text = '') {
		return 'https://via.placeholder.com/' . $width . 'x' . $height . '.png?text=' . $text;
	}
}
