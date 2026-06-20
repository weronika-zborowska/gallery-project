<?php
/**
 * Create administrator command.
 */

namespace App\Command;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

/**
 * Console command used for creating administrator account.
 */
#[AsCommand(
    name: 'app:create-admin',
    description: 'Creates an administrator account.',
)]
class CreateAdminCommand extends Command
{
    /**
     * Constructor.
     *
     * @param EntityManagerInterface      $entityManager  Entity manager.
     * @param UserPasswordHasherInterface $passwordHasher Password hasher.
     */
    public function __construct(private readonly EntityManagerInterface $entityManager, private readonly UserPasswordHasherInterface $passwordHasher)
    {
        parent::__construct();
    }

    /**
     * Executes the command.
     *
     * @param InputInterface  $input  Console input.
     * @param OutputInterface $output Console output.
     *
     * @return int Command status code.
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $user = new User();
        $user->setEmail('admin@example.com');
        $user->setRoles(['ROLE_ADMIN']);
        $user->setPassword(
            $this->passwordHasher->hashPassword($user, 'admin123')
        );

        $this->entityManager->persist($user);
        $this->entityManager->flush();

        $output->writeln('Admin created.');

        return Command::SUCCESS;
    }
}
