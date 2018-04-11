<?php
/**
 * Created by PhpStorm.
 * User: lurivar
 * Date: 06/04/18
 * Time: 17:32
 */

namespace YTLinker\Form;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Thelia\Form\BaseForm;
use Symfony\Component\Validator\Constraints;

class YTLinkerCreateForm extends BaseForm
{

    /***
     * Build the form to add a video link
     *
     * @return null|void
     */
    protected function buildForm()
    {
        $this->formBuilder
            ->add(
                'ytlinker_title',
                'text',
                array(
                    "constraints"   => array(
                        new Constraints\NotBlank()
                    ),
                    "label" => 'Title',
                )
            )
            ->add(
                'ytlinker_link',
                'text',
                array(
                    "constraints"   => array(
                        new Constraints\NotBlank()
                    ),
                    "label" => 'Link',
                )
            )
            ->add(
                'ytlinker_description',
                TextareaType::class,
                array(
                    "label" => 'Description',
                )
            )
            ->add(
                'save',
                SubmitType::class,
                array(
                    'attr'      => array('class' => 'save'),
                    'label'     => 'Save'
                )
            );

    }

    /**
     * @return string the name of the form. This name need to be unique.
     */
    public function getName()
    {
        return "admin_ytlinker_create";
    }

}