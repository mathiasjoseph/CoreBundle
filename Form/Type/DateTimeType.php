<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 08/06/17
 * Time: 23:43
 */

namespace Miky\Bundle\CoreBundle\Form\Type;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class DateTimeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add("date", DateType::class)
        ->add("time", TimeType::class);
        $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {
            $data = $event->getData();
            $date['date'] = $data;
            $date['time'] = $data;
            $event->setData($date);
        });
            $builder->addEventListener(FormEvents::SUBMIT, function (FormEvent $event) {
                $data = $event->getData();
                $data = new \DateTime($data['date']->format('Y-m-d') .' ' .$data['time']->format('H:i:s'));
                $event->setData($data);
            });
    }


    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'miky_date_time_type';
    }
}