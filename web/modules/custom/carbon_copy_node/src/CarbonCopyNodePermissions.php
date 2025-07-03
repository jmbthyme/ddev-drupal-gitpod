<?php

namespace Drupal\carbon_copy_node;

use Drupal\Core\Entity\BundlePermissionHandlerTrait;
use Drupal\Core\StringTranslation\StringTranslationTrait;
use Drupal\node\Entity\NodeType;

/**
 * Module permissions.
 */
class CarbonCopyNodePermissions {
  use BundlePermissionHandlerTrait;
  use StringTranslationTrait;

  /**
   * Returns an array of permissions.
   *
   * @return array
   *   The permissions.
   *
   * @see \Drupal\user\PermissionHandlerInterface::getPermissions()
   */
  public function carbonCopyNodeTypePermissions() {
    return $this->generatePermissions(NodeType::loadMultiple(), [$this, 'buildPermissions']);
  }

  /**
   * Returns a list of node permissions for a given node type.
   *
   * @param \Drupal\node\Entity\NodeType $type
   *   The node type.
   *
   * @return array
   *   An associative array of permission names and descriptions.
   */
  protected function buildPermissions(NodeType $type) {
    $type_id = $type->id();
    $type_params = ['%type_name' => $type->label()];

    return [
      "carbon copy node $type_id content" => [
        'title' => $this->t('%type_name: carbon copy node contents', $type_params),
      ],
      "carbon copy node own $type_id content" => [
        'title' => $this->t('%type_name: carbon copy own node content', $type_params),
      ],
    ];
  }

}
