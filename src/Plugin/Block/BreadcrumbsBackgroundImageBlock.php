<?php

namespace Drupal\breadcrumbs_background_image\Plugin\Block;

use Drupal\Core\Block\BlockBase;


/**
 * Provides a 'Breadcrumbs Background Image' Block.
 *
 * @Block(
 *   id = "breadcrumbs_background_image_block",
 *   admin_label = @Translation("Breadcrumbs Background Image"),
 *   category = @Translation("Custom"),
 * )
 */
class BreadcrumbsBackgroundImageBlock extends BlockBase {

  function breadcrumbs_background_image_preprocess_node(array &$variables) {
    foreach (Element::children($variables['elements']) as $key) {
      if ($variables['elements']['node']->field_images->entity) {
        $style = \Drupal::entityTypeManager()->getStorage('image_style')->load('tpc_1000_x_800');
        $variables['imageurl'] = $style->buildUrl($variables['elements']['node']->field_images->entity->getFileUri());
      }
    }
  }

  /**
 * Implements hook_preprocess_breadcrumb().
 */
function breadcrumbs_background_image_preprocess_breadcrumb(&$variables) {
  $variables['breadcrumb'] = [];
}

  /**
   * {@inheritdoc}
   */
  public function build() {
    return [
      '#theme' => 'breadcrumbs_background_image_block',
      '#imageurl' => $imageurl,
      '#breadcrumb' => $breadcrumb,
    ];
  }

}
