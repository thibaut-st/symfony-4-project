<?php

namespace App\Form;

use App\Entity\Acme;
use App\Entity\AcmeParent;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AcmeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('fieldA')
            ->add('fieldB')
            ->add('acmeParent', EntityType::class, array(
                'class' => AcmeParent::class
            ));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Acme::class,
        ]);
    }
}
