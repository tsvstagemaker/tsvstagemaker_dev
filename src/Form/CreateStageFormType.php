<?php

namespace App\Form;

use App\Entity\Stage;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class CreateStageFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('stagename', TextType::class,[
                                    'label' => 'STAGE NAME',])
            ->add('stagenumber', ChoiceType::class,[
                                                'label' => 'STAGE NUMBER',
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
            ->add('StartOn', ChoiceType::class,[
                                                'label' => 'Ready Condition',
                                                'choices' =>[
                                                '1' => '00', 
                                                '2' => '10',
                                                '3' => '20',                                                        
                                                        ]])
             ->add('CourseId', ChoiceType::class,[
                                            'label' => 'Type of course',
                                            'choices' =>[
                                                        'SHORT COURSE' => '1', 
                                                        'EDIUM COURSE' => '2',
                                                        'LONG COURSE' => '3',                                                        
                                                         ]])
             // ->add('IcsStageId', IntegerType::class)
             ->add('MaxPoints',IntegerType::class, [
                                                    'label' => 'MaxPoints',
                                                ])
            ->add('MinRounds',IntegerType::class, [
                                                    'label' => 'MinRounds',
                                                ])  
            ->add('TrgtPaper',IntegerType::class, [
                                                    'label' => 'TrgtPaper',
                                                ])
            ->add('TrgtPopper',IntegerType::class, [
                                                    'label' => 'TrgtPopper',
                                                ])
            ->add('TrgtPlates',IntegerType::class, [
                                                    'label' => 'TrgtPlates',
                                                ])
             // ->add('TrgtVanish',IntegerType::class)
            ->add('TrgtPenlty',IntegerType::class, [
                                                    'label' => 'TrgtPenlty',
                                                ])
            ->add('bobber',IntegerType::class, [
                                                    'label' => 'bobber',
                                                ])

             ->add('StartPos', TextareaType::class, [
                                                    'label' => 'Start Position',
                                                ])
            ->add('Descriptn', TextareaType::class, [
                                                    'label' => 'Description',
                                                ])

            ->add('FirearmId', ChoiceType::class,[
                                                'choices' =>[
                                                          'Handgun' => '1', 
                                                          'Rifle' => '2',
                                                          'Shotgun' => '3',
                                                          'Action Air' => '5',
                                                          'Mini-Rifle' => '6',
                                                          'PCC' => '7',
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
            
            ->add('ReportOn', ChoiceType::class,[
                                                'choices' =>[
                                                        'Without' => '0', 
                                                        'With' => '1',                                                                                                        
                                                       ]])
                     
            
            ->add('StringCnt', ChoiceType::class,[
                                                'choices' =>[
                                                        'Without' => '0', 
                                                        'With' => '1',
                                                        ]])
           
            
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
            ->add('MatchsId',IntegerType::class, [
                                                    'label' => 'Selcte associate match',
                                                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Stage::class,
        ]);
    }
}
