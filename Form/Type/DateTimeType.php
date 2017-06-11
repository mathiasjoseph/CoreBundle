<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 08/06/17
 * Time: 23:43
 */

namespace Miky\Bundle\CoreBundle\Form\Type;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class DateTimeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add("date", DateType::class);
        $builder->add("time", TimeType::class);
    }


    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'miky_date_time_type';
    }
}