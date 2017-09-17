<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 08/06/17
 * Time: 23:43
 */

namespace Miky\Bundle\CoreBundle\Form\Type;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class TagsType extends AbstractType
{

    public function getParent()
    {
        return TextType::class;
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'tags_type';
    }
}