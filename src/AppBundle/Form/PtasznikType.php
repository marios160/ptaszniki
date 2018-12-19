<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class PtasznikType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                ->add('id',TextType::class)
                ->add('kodEan',TextType::class)
                ->add('nazwaLacinska',TextType::class)
                ->add('lpWPartii',TextType::class)
                ->add('uwagi',TextType::class)
                ->add('nazwaPolska',TextType::class)
                ->add('kodDostawy',TextType::class)
                ->add('zakupRozmiar',TextType::class)
                ->add('plec',TextType::class)
                ->add('aktualnyRozmiar',TextType::class)
                ->add('wydrukEtykiety',TextType::class)
                ->add('magazyn',TextType::class)
                ->add('terrarium',TextType::class);
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Ptasznik'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_ptasznik';
    }


}
