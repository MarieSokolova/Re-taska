<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class UserCreateCommand extends Command
{
    protected static $defaultName = 'user:create';
    
    private $entityManager;
    private $passwordEncoder;
    
    public function __construct(EntityManagerInterface $entityManager, UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->entityManager = $entityManager;
        $this->passwordEncoder = $passwordEncoder;
        parent::__construct();
        
    }
    protected function configure()
    {
        $this
            ->setDescription('Add a short description for your command')
            ->addArgument('username', InputArgument::REQUIRED)
            ->addArgument('password', InputArgument::REQUIRED)
            //->addOption('option1', null, InputOption::VALUE_NONE, 'Option description')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);
        $username = $input->getArgument('username');
        $password = $input->getArgument('password');
        $user = new User;
        $encodedPassword = $this->passwordEncoder->encodePassword($user, $password);
        $user->setPassword($encodedPassword);
        $user->setUsername($username);
        $this->entityManager->persist($user);
         $this->entityManager->flush($user);
        
    }
}
