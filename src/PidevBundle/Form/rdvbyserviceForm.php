<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 22/3/2018
 * Time: 3:46 م
 */

namespace PidevBundle\Form;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
class rdvbyserviceForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('type_service',ChoiceType::class, array(
                'choices' => array(
                    'Veterinaire' => 'Veterinaire',
                    'Animal_sitting' => 'Animal_sitting',
                    'Dresseur' => 'Dresseur',
                    'Toiletteur' => 'Toiletteur',
                )))
            ->add('adresse')

            ->add('chercher',submitType::class );

    }

    public function configureOptions(OptionsResolver $resolver)
    {

    }

    public function getName()
    {
        return 'Pidev_Bundle_Rdv_form';

    }
}