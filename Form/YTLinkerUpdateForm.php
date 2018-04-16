<?php
/**
 * Created by PhpStorm.
 * User: lurivar
 * Date: 09/04/18
 * Time: 15:11
 */

namespace YTLinker\Form;

use Thelia\Form\BaseForm;
use Thelia\Core\Translation\Translator;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Validator\Constraints;

class YTLinkerUpdateForm extends BaseForm
{
    /**
     *  Build form to add or update a video link
     */
    protected function buildForm()
    {
        $this->formBuilder
            ->add(
                'ytlinker_id',
                'text',
                array(
                    "constraints"   => array(
                        new Constraints\NotBlank()
                    ),
                    "label"         => 'YTLinker ID',
                    "read_only"      => true,
                    "required"      => false,
                )
            )
            ->add(
                'ytlinker_title',
                'text',
                array(
                    "constraints"   => array(
                        new Constraints\NotBlank()
                    ),
                    "label"         => Translator::getInstance()->trans('Title'),
                    "required"      => true,
                )
            )
            ->add(
                'ytlinker_link',
                'text',
                array(
                    "constraints"   => array(
                        new Constraints\NotBlank()
                    ),
                    "label"         =>Translator::getInstance()->trans('Link'),
                    "required"      => true,
                )
            )
            ->add(
                'ytlinker_description',
                TextareaType::class,
                array(
                    'attr'          => array('class' => 'tinymce'),
                    "label"         =>Translator::getInstance()->trans('Description'),
                    "required"      => false,
                )
            )
            ->add(
                'save_mode',
                SubmitType::class,
                array(
                    'attr'          => array('class' => 'save'),
                    'label'         =>'save',
                )
            )
            ->add(
                'save_mode',
                SubmitType::class,
                array(
                    'attr'          => array('class' => 'save_and_close'),
                    'label'         =>'save_and_close',
                )
            );
    }

    /**
     * @return string the name of the form. This name need to be unique.
     */
    public function getName()
    {
        return "admin_ytlinker_update";
    }
}