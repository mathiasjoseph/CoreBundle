<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 13/06/17
 * Time: 00:21
 */

namespace Miky\Bundle\CoreBundle\Form\Extension;


use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FormTypeExtension extends AbstractTypeExtension
{

    public function configureOptions(OptionsResolver $resolver)
    {
        // makes it legal for FileType fields to have an image_property option
        $resolver->setDefined(array('casper_group', 'casper_hide', 'casper_show', 'casper_name', 'row_attr', 'tab_collection', "tab"));
        $resolver->setDefaults(array("row_attr" => array()));
        $resolver->setAllowedTypes('casper_group', 'string')
            ->setAllowedTypes('casper_show', 'array')
            ->setAllowedTypes('casper_hide', 'array')
            ->setAllowedTypes('casper_name', 'string');
    }

    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        $view->vars['row_attr'] = $options['row_attr'];
        if (isset($options['casper_group'])) {
            $view->vars['row_attr']['data-casper-group'] = $options['casper_group'];
        }
        if (isset($options['casper_group'])) {
            $view->vars['row_attr']['data-casper-group'] = $options['casper_group'];
        }
        if (isset($options['casper_hide'])) {
            $view->vars['attr']['data-casper-hide'] = json_encode($options['casper_hide']);
        }
        if (isset($options['casper_name'])) {
            $view->vars['attr']['data-casper-name'] = $options['casper_name'];
        }
        if (isset($options['casper_show'])) {
            $view->vars['attr']['data-casper-show'] = json_encode($options['casper_show']);
        }
    }

    /**
     * Returns the name of the type being extended.
     *
     * @return string The name of the type being extended
     */
    public function getExtendedType()
    {
        // use FormType::class to modify (nearly) every field in the system
        return FormType::class;
    }
}