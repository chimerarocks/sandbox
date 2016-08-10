<?php

namespace TargetMkt\Domain\Service;

interface FlashMessageInterface {
	public function setMessage($key, $value);

	public function getMessage($key);

	public function setNamespace($name);
}