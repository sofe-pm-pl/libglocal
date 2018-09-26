<?php

/*
 * libglocal
 *
 * Copyright (C) 2018 SOFe
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

declare(strict_types=1);

namespace SOFe\Libglocal\Argument\ObjectType;

use SOFe\Libglocal\Argument\ArgRef;
use SOFe\Libglocal\Argument\LocalArg;

class ObjectLocalArg extends LocalArg{
	/** @var ObjectArgType */
	protected $type;

	public function __construct(ObjectArgType $type){
		$this->type = $type;
	}

	public function getType() : ObjectArgType{
		return $this->type;
	}

	public function createRef(array $attributes) : ArgRef{
		return new ObjectArgRef($this, $attributes);
	}
}
