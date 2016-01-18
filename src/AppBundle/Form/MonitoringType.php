<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MonitoringType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('beginTime', 'datetime')
            ->add('endTime', 'date')
            ->add('unitId')
            ->add('type')
            ->add('min')
            ->add('max')
            ->add('sum')
            ->add('createdAt', 'datetime')
            ->add('updatedAt', 'datetime')
            ->add('enabled')
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Monitoring'
        ));
    }
}
