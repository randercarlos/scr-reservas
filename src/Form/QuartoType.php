<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Entity\Quarto;

class QuartoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nome', null, array('label'  => 'quarto.nome.label'))
            ->add('andar', null, array('label'  => 'quarto.andar.label'))
            ->add('descricao', null, array('label'  => 'quarto.descricao.label'));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Quarto::class,
        ));
    }
}
