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

use pocketmine\utils\TextFormat;
use RuntimeException;
use SOFe\Libglocal\LangParser;
use SOFe\Libglocal\Message;
use SOFe\Libglocal\Translation;

class MessageRefTranslationComponent extends TranslationComponent{
	/** @var LangParser */
	private $parser;
	/** @var string */
	protected $refMessageId;
	/** @var Message */
	protected $refMessage;
	/** @var \SOFe\Libglocal\ArgDefault\ArgDefault[] */
	protected $refArgs;

	protected $resolving = false;

	public function __construct(LangParser $parser, string $refMessageId, array $refArgs){
		$this->myTranslation = $parser->getCurrentTranslation();
		$this->parser = $parser;
		$this->refMessageId = $refMessageId;
		$this->refArgs = $refArgs;
	}

	public function init() : void{
		$this->refMessage = $this->myTranslation->getMessage()->getManager()->getMessages()[$this->refMessageId] ?? $this->parser->getLocalMessage($this->refMessageId);
		if($this->refMessage === null){
			throw new RuntimeException("Unresolved message reference #{{$this->refMessageId}}");
		}
	}

	public function toString(array &$args) : string{
		if($this->resolving){
			throw new RuntimeException("Circular reference to " . $this->refMessage->getId() . " in " . $this->myTranslation->getId() . " (" . $this->myTranslation->getLang() . ") detected");
		}

		$refArgs = [
			Translation::SPECIAL_ARG_STACK_COLOR => $args[Translation::SPECIAL_ARG_STACK_COLOR],
			Translation::SPECIAL_ARG_STACK_FONT => $args[Translation::SPECIAL_ARG_STACK_FONT],
		];
		foreach($this->refArgs as $argName => $default){
			$refArgs[$argName] = $default->resolve($this->myTranslation->getLang(), $args);
		}

		$this->resolving = true;
		$ret = $this->refMessage->translate($this->myTranslation->getLang(), $refArgs) .
			($args[Translation::SPECIAL_ARG_STACK_COLOR][0] ?? TextFormat::WHITE);
		$this->resolving = false;
		return $ret;
	}

	public function toHtml() : string{
		$out = '#{' . $this->refMessageId . ' ( ';
		foreach($this->refArgs as $name => $value){
			$out .= "$name = {$value->toHtml()} ";
		}
		$out .= ')}';
		return $out;
	}

	public function jsonSerialize() : array{
		return [
			"type" => "MessageRef",
			"refMessageId" => $this->refMessageId,
			"refArgs" => $this->refArgs,
		];
	}
}
