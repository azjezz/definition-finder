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

function constant_from_ast(
  ConsumerContext $context,
  HHAST\ConstDeclaration $outer,
  HHAST\ConstantDeclarator $inner,
): ScannedConstant {
  return (
    new ScannedConstantBuilder(
      $inner,
      decl_name_in_context($context, name_from_ast($inner->getName())),
      context_with_node_position($context, $inner)['definitionContext'],
      null, // FIXME: value
      typehint_from_ast($context, $outer->getTypeSpecifier()),
      $outer->getAbstract() instanceof HHAST\AbstractToken
        ? AbstractnessToken::IS_ABSTRACT
        : AbstractnessToken::NOT_ABSTRACT,
    )
  )
    ->build();
}
