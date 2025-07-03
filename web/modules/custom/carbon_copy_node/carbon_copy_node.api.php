<?php

/**
 * @file
 * API documentation.
 */

use Drupal\node\NodeInterface;

/**
 * @file
 * Hooks related to carbon_copy_node module and it's plugins.
 */

/**
 * Called when a node is carbon copied.
 *
 * @param \Drupal\node\NodeInterface $node
 *   The node being carbon copied.
 */
function hook_carbon_copied_node_alter(NodeInterface &$node, NodeInterface $original_node) {
  $node->setTitle('Old node carbon copied');
  $node->save();
}
