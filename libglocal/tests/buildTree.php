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

use SOFe\Libglocal\Parser\Ast\AstRoot;
use SOFe\Libglocal\Parser\Ast\LibglocalFile;
use SOFe\Libglocal\Parser\Lexer\LibglocalLexer;

require_once __DIR__ . "/autoload.php";

for($trials = 0; $trials < 100; $trials++){
$start = microtime(true);
$data = file_get_contents(__DIR__ . "/../LibglocalExample/resources/lang/en_US.lang");
$lexer = new LibglocalLexer("LibglocalExample/.../en_US.lang", $data);
$parser = new LibglocalFile($lexer);
//echo yaml_emit(json_decode(json_encode($parser), true)); // f*** yaml
$end = microtime(true);
printf("Time token: %g ms\n", ($end - $start) * 1000);
//printf("Time per effective token: %g ms\n", ($end - $start) * 1000 / $number);
}
