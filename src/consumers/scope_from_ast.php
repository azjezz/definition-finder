<?hh // strict
/*
 *  Copyright (c) 2015-present, Facebook, Inc.
 *  All rights reserved.
 *
 *  This source code is licensed under the MIT license found in the
 *  LICENSE file in the root directory of this source tree.
 *
 */

namespace Facebook\DefinitionFinder;

use namespace Facebook\HHAST;
use namespace HH\Lib\{Dict, Vec};

function scope_from_ast(
  ConsumerContext $context,
  HHAST\EditableList $ast,
): ScannedScope {
  return new ScannedScope(
    $context['definitionContext'],
    vec[], // classes
    vec[], // interfaces
    vec[], // traits
    Vec\map(
      $ast->getItemsOfType(HHAST\FunctionDeclaration::class),
      $node ==> function_from_ast($context, $node),
    ),
    vec[], // methods
    vec[], // used traits
    vec[], // properties
    vec[], // constants
    vec[], // type constants
    vec[], // enums
    vec[], // types
    vec[], // newtypes
  );
}
