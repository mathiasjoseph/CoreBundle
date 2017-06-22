<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 21/06/17
 * Time: 23:45
 */

namespace Miky\Bundle\CoreBundle\Form\Factory;


use Symfony\Component\Form\FormFactoryInterface;

class FormFactory implements FactoryInterface
{
    /**
     * @var FormFactoryInterface
     */
    private $formFactory;

    /**
     * @var string
     */
    private $type;

    /**
     * @var array
     */
    private $validationGroups;

    /**
     * FormFactory constructor.
     *
     * @param FormFactoryInterface $formFactory
     * @param string               $type
     * @param array                $validationGroups
     */
    public function __construct(FormFactoryInterface $formFactory, $type, array $validationGroups = null)
    {
        $this->formFactory = $formFactory;
        $this->type = $type;
        $this->validationGroups = $validationGroups;
    }

    /**
     * {@inheritdoc}
     */
    public function createForm(array $options = array())
    {
        $options = array_merge(array('validation_groups' => $this->validationGroups), $options);

        return $this->formFactory->create($this->type, null, $options);
    }
}
