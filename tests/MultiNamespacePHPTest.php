<?hh // strict
/*
 *  Copyright (c) 2015-present, Facebook, Inc.
 *  All rights reserved.
 *
 *  This source code is licensed under the MIT license found in the
 *  LICENSE file in the root directory of this source tree.
 *
 */

use function Facebook\FBExpect\expect;
use type Facebook\DefinitionFinder\FileParser;

final class MultiNamespacePHPTest extends Facebook\HackTest\HackTest {
  <<__LateInit>>
  private FileParser $parser;

  <<__Override>>
  public async function beforeEachTestAsync(): Awaitable<void> {
    $this->parser =
      FileParser::fromFile(__DIR__.'/data/multi_namespace_php.php');
  }

  public function testClasses(): void {
    expect($this->parser->getClassNames())->toBeSame(
      vec['Foo\\Bar', 'Herp\\Derp', 'EmptyNamespace'],
    );
  }

  public function testContentOutsideOfNamespaceBlock(): void {
    // only valid in HNI files
    expect($this->parser->getFunctionNames())->toBeSame(
      vec['no_namespace_block', "Foo\\myfunc", "Herp\\myfunc", 'myfunc'],
    );
  }

  public function testMultipleNamespaceStatements(): void {
    $parser =
      FileParser::fromFile(__DIR__.'/data/multi_namespace_statement.php');
    expect($parser->getFunctionNames())->toBeSame(
      vec["Foo\\bar", "Herp\\derp"],
    );
  }
}
