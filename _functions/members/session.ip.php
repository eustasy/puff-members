<?php

function Puff_Member_Session_IP() {

	$Filter = FILTER_VALIDATE_IP;
	$Options = FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE;

	if (!empty(filter_input(INPUT_SERVER, 'HTTP_CF_CONNECTING_IP', $Filter, $Options))) {
		return filter_input(INPUT_SERVER, 'HTTP_CF_CONNECTING_IP', $Filter, $Options);
	}

	if (!empty(filter_input(INPUT_SERVER, 'HTTP_X_FORWARDED_FOR', $Filter, $Options))) {
		return filter_input(INPUT_SERVER, 'HTTP_X_FORWARDED_FOR', $Filter, $Options);
	}

	if (!empty(filter_input(INPUT_SERVER, 'HTTP_CLIENT_IP', $Filter, $Options))) {
		return filter_input(INPUT_SERVER, 'HTTP_CLIENT_IP', $Filter, $Options);
	}

	if (!empty(filter_input(INPUT_SERVER, 'REMOTE_ADDR', $Filter, $Options))) {
		return filter_input(INPUT_SERVER, 'REMOTE_ADDR', $Filter, $Options);
	}

	return false;
}
