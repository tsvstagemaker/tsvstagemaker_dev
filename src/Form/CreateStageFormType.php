<?php

namespace App\Form;

use App\Entity\Stage;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class CreateStageFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('stagename', TextType::class)
            ->add('stagenumber', ChoiceType::class,[
                                                'choices' =>[
                                                            '1' => '1',
                                                            '2' => '2',
                                                            '3' => '3',
                                                            '4' => '4',
                                                            '5' => '5',
                                                            '6' => '6',
                                                            '7' => '7',
                                                            '8' => '8',
                                                            '9' => '9',
                                                            '10' => '10',
                                                            '11' => '11', 
                                                            '12' => '12',
                                                            '13' => '13',
                                                            '14' => '14',
                                                            '15' => '15',
                                                            '16' => '16',
                                                            '17' => '17',
                                                            '18' => '18',
                                                            '19' => '19',
                                                            '20' => '20',
                                                            '21' => '21', 
                                                            '22' => '22',
                                                            '23' => '23',
                                                            '24' => '24',
                                                            '25' => '25',
                                                            '26' => '26',
                                                            '27' => '27',
                                                            '28' => '28',
                                                            '29' => '29',
                                                            '30' => '30',
                                                            '31' => '31',
                                                            '31' => '32',
                                                            ]])
            ->add('FirearmId', ChoiceType::class,[
                                                'choices' =>[
                                                          'Handgun' => '1', 
                                                          'Rifle' => '2',
                                                          'Shotgun' => '3',
                                                          'Action Air' => '5',
                                                          'Mini-Rifle' => '6',
                                                          'PCC' => '7',
                                                      ]])
            ->add('CourseId', ChoiceType::class,[
                                            'choices' =>[
                                                        'SHORT COURSE' => '1', 
                                                        'EDIUM COURSE' => '2',
                                                        'LONG COURSE' => '3',                                                        
                                                         ]])
            ->add('ScoringId', ChoiceType::class,[
                                                'choices' =>[
                                                        'Comstock' => '1', 
                                                        'Fixed Time' => '2',
                                                        'Virginia Count' => '3',                                                        
                                                        ]])
            ->add('TrgtTypeId', ChoiceType::class,[
                                                'choices' =>[
                                                        'Classic' => '2', 
                                                        'Metric' => '1',                                                                                                        
                                                        ]])
            // ->add('IcsStageId', IntegerType::class)
            ->add('TrgtPaper',IntegerType::class)
            ->add('TrgtPopper',IntegerType::class)
            ->add('TrgtPlates',IntegerType::class)
            ->add('TrgtVanish',IntegerType::class)
            ->add('TrgtPenlty',IntegerType::class)
            ->add('MinRounds',IntegerType::class)
            ->add('ReportOn', ChoiceType::class,[
                                                'choices' =>[
                                                        'Without' => '0', 
                                                        'With' => '1',                                                                                                        
                                                       ]])
            ->add('MaxPoints',IntegerType::class)
            ->add('StartPos',IntegerType::class)
            ->add('StartOn', ChoiceType::class,[
                                                'choices' =>[
                                                '1' => '00', 
                                                '2' => '10',
                                                '3' => '20',                                                        
                                                        ]])
            ->add('StringCnt', ChoiceType::class,[
                                                'choices' =>[
                                                        'Without' => '0', 
                                                        'With' => '1',
                                                        ]])
            ->add('Descriptn', TextType::class)
            ->add('bobber',IntegerType::class)
            // ->add('showall')
            // ->add('Location')
            // ->add('createdAt')
            // ->add('updatedAt')
            // ->add('filename', TextType::class)
            // ->add('fileurl', TextType::class)
            // ->add('filenameimg', TextType::class)
            // ->add('fileurlimg', TextType::class)
            // ->add('datastage', TextType::class)
            // ->add('user')
            ->add('MatchsId',IntegerType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Stage::class,
        ]);
    }
}
