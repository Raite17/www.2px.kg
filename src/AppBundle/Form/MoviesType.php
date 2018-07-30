<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\HttpFoundation\File\File;
class MoviesType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->
                  add('title')->
                  add('poster', FileType::class,array('data_class' => null,'label'=> 'Выберите постер'))->
                  add('genre')->
                  add('country')->
                  add('premier')->
                  add('actors')->
                  add('director')->
                  add('description')->
                  add('trailer')->
                  add('screenshots', FileType::class,array('multiple'=> true, 'data_class' => null,'label'=> 'Кадры из фильма'))->
                  add('createdAt');
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Movies'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_movies';
    }


}
