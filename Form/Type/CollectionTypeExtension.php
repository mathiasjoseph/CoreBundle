<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 13/06/17
 * Time: 00:21
 */

namespace Miky\Bundle\CoreBundle\Form\Type;


use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CollectionTypeExtension extends AbstractTypeExtension
{

    public function configureOptions(OptionsResolver $resolver)
    {
        // makes it legal for FileType fields to have an image_property option
        $resolver->setDefined(array('reference_property'));
    }

//    public function buildView(FormView $view, FormInterface $form, array $options)
//    {
//        if (isset($options['image_property'])) {
//            // this will be whatever class/entity is bound to your form (e.g. Media)
//            $parentData = $form->getParent()->getData();
//
//            $imageUrl = null;
//            if (null !== $parentData) {
//                $accessor = PropertyAccess::createPropertyAccessor();
//                $imageUrl = $accessor->getValue($parentData, $options['image_property']);
//            }
//
//            // set an "image_url" variable that will be available when rendering this field
//            $view->vars['image_url'] = $imageUrl;
//        }
//    }

    /**
     * Returns the name of the type being extended.
     *
     * @return string The name of the type being extended
     */
    public function getExtendedType()
    {
        // use FormType::class to modify (nearly) every field in the system
        return CollectionType::class;
    }
}