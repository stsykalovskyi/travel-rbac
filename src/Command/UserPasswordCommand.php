<?php

namespace App\Command;

use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserPasswordCommand extends Command
{
    protected static $defaultName = 'user:password';
    protected static string $defaultDescription = 'Set user password command';
    private EntityManagerInterface $em;
    private UserRepository $userRepository;
    private UserPasswordEncoderInterface $passwordEncoder;

    public function __construct(
        EntityManagerInterface $em,
        UserRepository $userRepository,
        UserPasswordEncoderInterface $passwordEncoder
    ) {
        parent::__construct();
        $this->em               = $em;
        $this->userRepository   = $userRepository;
        $this->passwordEncoder  = $passwordEncoder;
    }

    protected function configure()
    {
        $this
            ->setDescription(self::$defaultDescription)
            ->addOption('email', null, InputOption::VALUE_REQUIRED, 'User email')
            ->addOption('password', null, InputOption::VALUE_REQUIRED, 'User password')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $email = $input->getOption('email');
        if (empty($email)) {
            $io->error('Email should be specified');
            return Command::FAILURE;
        }
        $user = $this->userRepository->findOneBy(['email' => $email]);
        if (!empty($user)) {
            $password = $input->getOption('password');
            if (empty($password)) {
                $io->error('Password should be specified');
                return Command::FAILURE;
            }
            $password = $this->passwordEncoder->encodePassword($user, $password);
            $user->setPassword($password);
            $this->em->flush();
        } else {
            $io->warning(sprintf('User %s does not exists', $email));
            return Command::FAILURE;
        }

        $io->success(sprintf('User %s password updated', $email));

        return Command::SUCCESS;
    }
}
