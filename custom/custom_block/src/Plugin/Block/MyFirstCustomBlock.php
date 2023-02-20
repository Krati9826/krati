<?php

namespace Drupal\custom_block\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a 'MY' Block.
 *
 * @Block(
 *   id = "hello_block",
 *   admin_label = @Translation("My_Block"),
 *   category = @Translation("Block"),
 * )
 */
class MyFirstCustomBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    return [
      '#markup' => $this->t('Hey!'),
    ];
  }

}
