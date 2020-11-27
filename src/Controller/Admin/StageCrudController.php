<?php

namespace App\Controller\Admin;

use App\Entity\Stage;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;

class StageCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Stage::class;
    }

      public function configureFields(string $pageName): iterable
    {

        return [
            IntegerField::new('id', 'ID')->onlyOnIndex(),
            AssociationField::new('user'),
            AssociationField::new('MatchsId'),
            TextField::new('stagename'),
             ChoiceField::new('stagenumber')->setChoices(['1' => '1', 
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
                                                        '32' => '32',
                                                        ]),

            IntegerField::new('MinRounds'),
            IntegerField::new('MaxPoints'),

            DateTimeField::new('created_at'),
            DateTimeField::new('updated_at'),   

            IntegerField::new('TrgtPaper'), 
            IntegerField::new('TrgtPopper'), 
            IntegerField::new('TrgtPlates'), 
            IntegerField::new('bobber'), 
            IntegerField::new('TrgtVanish'), 
            IntegerField::new('TrgtPenlty'),     

            TextField::new('filename'),
            TextField::new('fileurl'),
            TextField::new('filenameimg'),
            TextField::new('fileurlimg'),  
            
            TextEditorField::new('Descriptn'),
            TextEditorField::new('StartPos'),  

              ChoiceField::new('CourseId')->setChoices(['SHORT COURSE' => '1', 
                                                        'MEDIUM COURSE' => '2',
                                                        'LONG COURSE' => '3',                                                        
                                                        ]),

              ChoiceField::new('StartOn')->setChoices(['1' => '00', 
                                                        '2' => '10',
                                                        '3' => '20',                                                        
                                                        ]), 

              ChoiceField::new('ScoringId')->setChoices(['Comstock' => '1', 
                                                        'Fixed Time' => '2',
                                                        'Virginia Count' => '3',                                                        
                                                        ]),          

            ChoiceField::new('ReportOn')->setChoices(['Without' => '0', 
                                                        'With' => '1',                                                                                                        
                                                        ]),

            ChoiceField::new('StringCnt')->setChoices(['Without' => '0', 
                                                        'With' => '1',                                                                                                        
                                                        ]),

            ChoiceField::new('showall')->setChoices(['Non partagé' => '0', 
                                                        'partagé' => '1',                                                                                                        
                                                        ]),

            ChoiceField::new('TrgtTypeId')->setChoices(['Classic' => '2', 
                                                        'Metric' => '1',                                                                                                        
                                                        ]),
         

            ChoiceField::new('FirearmId')->setChoices([ 'Handgun' => '1', 
                                                          'Rifle' => '2',
                                                          'Shotgun' => '3',
                                                          'Action Air' => '5',
                                                          'Mini-Rifle' => '6',
                                                          'PCC' => '7',
                                                        ]), 
            TextField::new('datastage'), 
            IntegerField::new('IcsStageId'),
        ];
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
