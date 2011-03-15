<?php
namespace Funsational\CommonBundle;

use Symfony\Component\HttpFoundation\Session as BaseSession;

class Session extends BaseSession
{
	public function getStorage()
	{
		return $this->storage;
	}
}