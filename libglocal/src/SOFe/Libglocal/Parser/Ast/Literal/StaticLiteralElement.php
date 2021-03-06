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

namespace SOFe\Libglocal\Parser\Ast\Literal;

use SOFe\Libglocal\Parser\Ast\AstNode;
use SOFe\Libglocal\Parser\Ast\Literal\Component\LiteralStringComponentElement;
use function assert;

class StaticLiteralElement extends AbstractLiteralElement{
	protected function acceptComponent() : ?AstNode{
		return $this->acceptAnyChildren(LiteralStringComponentElement::class);
	}

	protected static function getNodeName() : string{
		return "static literal";
	}

	public function toString() : string{
		$output = "";
		foreach($this->components as $component){
			assert($component instanceof LiteralStringComponentElement);
			$output .= $component->toString();
		}
		return $output;
	}
}
