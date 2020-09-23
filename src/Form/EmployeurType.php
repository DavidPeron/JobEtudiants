<?php

namespace App\Form;

use App\Entity\Employeur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EmployeurType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', null, ['attr' => ['autofocus' => true]])
            ->add('adresse')
            ->add('code_postal')
            ->add('domaine')
            ->add('nb_employe')
            ->add('ville')
            ->add('email')
            ->add('Valider', SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Employeur::class,
        ]);
    }
}
