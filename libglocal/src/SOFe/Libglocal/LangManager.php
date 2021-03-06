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

namespace SOFe\Libglocal;

use SOFe\Libglocal\Math\MathRule;
use SOFe\Libglocal\Message\Message;
use SOFe\Libglocal\Parser\Ast\LibglocalFile;
use SOFe\Libglocal\Parser\Lexer\LibglocalLexer;

class LangManager{
	/** @var LibglocalConfig */
	protected $config;

	/** @var LibglocalFile[] */
	protected $baseFiles = [];
	/** @var LibglocalFile[] */
	protected $auxFiles = [];

	/** @var Message[] */
	protected $globalMessages = [];
	/** @var Message[][] */
	protected $localMessages = [];
	/** @var MathRule[][] */
	protected $mathRules = [];


	public function __construct(LibglocalConfig $config){
		$this->config = $config;
	}

	public function getConfig() : LibglocalConfig{
		return $this->config;
	}

	public function loadLang(string $fileName, string $data) : void{
		$lexer = new LibglocalLexer($fileName, $data);
		$file = new LibglocalFile($lexer);
		if($file->getLang()->isBase()){
			$this->baseFiles[] = $file;
		}else{
			$this->auxFiles[] = $file;
		}
	}

	public function init() : void{

	}
}
