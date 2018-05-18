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

namespace SOFe\Libglocal\Component;

use RuntimeException;
use SOFe\Libglocal\Arg\MessageArg;
use SOFe\Libglocal\Translation;

class ArgRefTranslationComponent extends TranslationComponent{
	/** @var string */
	protected $argName;
	/** @var MessageArg */
	protected $arg;

	public function __construct(Translation $translation, string $argName){
		$this->myTranslation = $translation;
		$this->argName = $argName;
	}

	public function init() : void{
		$this->arg = $this->myTranslation->getMessage()->getArg($this->myTranslation->getLang(), $this->argName) ;
		if($this->arg === null){
			throw new RuntimeException("Unresolved argument reference \${{$this->argName}}");
		}
	}

	public function toString(array &$args) : string{
		return $this->arg->resolve($this->myTranslation->getLang(), $args);
	}
}
