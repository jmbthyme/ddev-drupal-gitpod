<?php

namespace Drupal\carbon_copy_node\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Module settings form.
 */
class CarbonCopyNodeNodeSettingsForm extends ConfigFormBase {

  /**
   * The machine name of the entity type.
   *
   * @var string
   *   The entity type id i.e. node
   */
  protected $entityTypeId = 'node';

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'carbon_copy_node_node_setting_form';
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['carbon_copy_node.settings'];
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {

        // Get the Admin Toolbar Search settings configuration.
    $settings = $this->config('carbon_copy_node.settings');

    $form['text_to_prepend_to_title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Text to prepend to title'),
      '#default_value' => $settings->get('text_to_prepend_to_title'),
      '#description' => $this->t('Enter text to add to the title of a carbon copied node to help content editors. A space will be added between this text and the title. Example: "Carbon Copy of"'),
    ];

    $default_carbon_copy_status = $settings->get('carbon_copy_status');
    $form['carbon_copy_status'] = [
      '#type' => 'radios',
      '#title' => $this->t('Publication status'),
      '#description' => $this->t('What should the carbon copied status be?'),
      '#default_value' => $default_carbon_copy_status,
      '#options' => [
        'published' => $this->t('Published'),
        'unpublished' => $this->t('Unpublished'),
      ],
    ];

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $form_state->cleanValues();
    $form_values = $form_state->getValues();

    $settings = $this->config('carbon_copy_node.settings');
    $settings
      ->set('text_to_prepend_to_title', $form_values['text_to_prepend_to_title'])
      ->set('carbon_copy_status', $form_values['carbon_copy_status'])
      ->save();

    parent::submitForm($form, $form_state);
  }

}
