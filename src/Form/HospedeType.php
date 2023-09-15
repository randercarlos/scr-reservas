<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Entity\Hospede;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class HospedeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        // choice_translation_domain = false => desabilita tradução para o select
        $builder
            ->add('titulo', ChoiceType::class, array(
                'label'  => 'hospede.titulo.label',
                'choice_translation_domain' => false,
                'choices' => array(
                    'Selecione uma opção...' => null,
                    'Sr(ª).' => 'Sr(ª).',
                    'Dr(a).' => 'Dr(a).',
                    'Seu' => 'Seu',
                    'Dona' => 'Dona',
                    'PhD.' => 'PhD.',
                    'V.S.ª' => 'V.S.ª',
                    'V. Ex.ª' => 'V. Ex.ª',
                    'V.Mag.ª' => 'V.Mag.ª',
                    'V.Rev.ª' => 'V.Rev.ª',
                    'V.Em.ª' => 'V.Em.ª',
                    'V. S.' => 'V. S.',
                    'V. S.ª (s)' => 'V. S.ª (s)',
                )
            ))
            ->add('nome', null, array('label'  => 'hospede.nome.label'))
            ->add('email', EmailType::class, array('label'  => 'hospede.email.label'))
            ->add('endereco', null, array('label'  => 'hospede.endereco.label'))
            ->add('cep', null, array('label'  => 'hospede.cep.label'))
            ->add('cidade', null, array('label'  => 'hospede.cidade.label'))
            ->add('estado', ChoiceType::class, array(
                'label'  => 'hospede.estado.label',
                'choice_translation_domain' => false,
                'choices' => array(
                    'Selecione uma opção...' => null,
                    'Acre (AC)' => 'AC',
                    'Alagoas (AL)' => 'AL',
                    'Amapá (AP)' => 'AP',
                    'Amazonas (AM)' => 'AM',
                    'Bahia (BA)' => 'BA',
                    'Ceará (CE)' => 'CE',
                    'Distrito Federal (DF)' => 'DF',
                    'Espírito Santo (ES)' => 'ES',
                    'Goiás (GO)' => 'GO',
                    'Maranhão (MA)' => 'MA',
                    'Mato Grosso (MT)' => 'MT',
                    'Mato Grosso do Sul (MS)' => 'MS',
                    'Minas Gerais (MG)' => 'MG',
                    'Pará (PA)' => 'PA',
                    'Paraíba (PB)' => 'PB',
                    'Paraná (PR)' => 'PR',
                    'Pernambuco (PE)' => 'PE',
                    'Piauí (PI)' => 'PI',
                    'Rio de Janeiro (RJ)' => 'RJ',
                    'Rio Grande do Norte (RN)' => 'RN',
                    'Rio Grande do Sul (RS)' => 'RS',
                    'Rondônia (RO)' => 'RO',
                    'Roraima (RR)' => 'RR',
                    'Santa Catarina (SC)' => 'SC',
                    'São Paulo (SP)' => 'SP',
                    'Sergipe (SE)' => 'SE',
                    'Tocantins (TO)' => 'TO'
                )
            ));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Hospede::class,
        ));
    }
}
