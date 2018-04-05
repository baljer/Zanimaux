<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 25/3/2018
 * Time: 10:11 م
 */

namespace PidevBundle\Form;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class ajoutRubriqueForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre')
            ->add('date',DateType::class)
            ->add('contenu')
            ->add('image',FileType::class,array('label'=>'inserer une image'))
            ->add('brochure', FileType::class, array('label' => 'Brochure (PDF file)'))
            ->add('Ajouter',submitType::class );

    }

    public function configureOptions(OptionsResolver $resolver)
    {

    }

    public function getName()
    {
        return 'Pidev_Bundle_Rubrique_form';

    }

}