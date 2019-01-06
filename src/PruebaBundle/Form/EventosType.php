<?php

namespace PruebaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\ResetType;

class EventosType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                ->add('nombreEvento', TextType::class)
                ->add('fecha', DateType::class, array('label' => 'Fecha'))
                ->add('ciudad', TextType::class, array('label' => 'Ciudad del evento', 
                                                                        'label_attr' => array('class'=>'etiqueta'),
                                                                        'attr'=> array('class'=> 'etiqueta_elem')))
                ->add('poblacion', TextType::class)
                ->add('guardar', SubmitType::class)
                ->add('borrar', ResetType::class);      //limpia los campos
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'PruebaBundle\Entity\Eventos'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'pruebabundle_eventos';
    }


}
