<?php

namespace Drupal\ev_client_endpoint\Form;

use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Form controller for Ev_token edit forms.
 *
 * @ingroup ev_client_endpoint
 */
class ev_tokenForm extends ContentEntityForm {

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    /* @var $entity \Drupal\ev_client_endpoint\Entity\ev_token */
    $form = parent::buildForm($form, $form_state);
    $entity = $this->entity;

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {
    $entity = $this->entity;
    $status = parent::save($form, $form_state);

    switch ($status) {
      case SAVED_NEW:
        drupal_set_message($this->t('Created the %label Ev_token.', [
          '%label' => $entity->label(),
        ]));
        break;

      default:
        drupal_set_message($this->t('Saved the %label Ev_token.', [
          '%label' => $entity->label(),
        ]));
    }
    $form_state->setRedirect('entity.ev_token.canonical', ['ev_token' => $entity->id()]);
  }

}
