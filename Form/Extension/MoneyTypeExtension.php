<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 13/06/17
 * Time: 00:21
 */

namespace Miky\Bundle\CoreBundle\Form\Extension;


use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;

class MoneyTypeExtension extends AbstractTypeExtension
{

    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        $view->vars['currency'] = $options['currency'];

    }

    /**
     * Returns the name of the type being extended.
     *
     * @return string The name of the type being extended
     */
    public function getExtendedType()
    {
        // use FormType::class to modify (nearly) every field in the system
        return MoneyType::class;
    }
}