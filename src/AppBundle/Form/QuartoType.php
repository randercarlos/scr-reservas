<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use AppBundle\Entity\Quarto;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class QuartoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->setMethod('PUT')
            ->add('nome', TextType::class, array('label'  => 'Nome:'))
            ->add('andar', TextType::class, array('label'  => 'Andar:'))
            ->add('descricao', TextType::class, array('label'  => 'Descrição:'));
    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Quarto::class,
        ));
    }
}
