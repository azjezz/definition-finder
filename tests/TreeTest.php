<?hh // strict
/*
 *  Copyright (c) 2015-present, Facebook, Inc.
 *  All rights reserved.
 *
 *  This source code is licensed under the MIT license found in the
 *  LICENSE file in the root directory of this source tree.
 *
 */

namespace Facebook\DefinitionFinder\Tests;

use type Facebook\DefinitionFinder\TreeParser;
use function Facebook\FBExpect\expect;

final class TreeTest extends \Facebook\HackTest\HackTest {
  public function testTreeDefs(): void {
    $parser = \HH\Asio\join(TreeParser::fromPathAsync(__DIR__.'/data/'));
    // From multiple files
    $classes = $parser->getClassNames();
    expect($classes)->toContain("SingleNamespace\\SimpleClass");
    expect($classes)->toContain("Namespaces\\AreNestedNow\\SimpleClass");
  }
}
