<?php
declare(strict_types=1);

namespace App\Command;

use App\Constant\Role;
use FOS\UserBundle\Model\UserManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class CreateAdminUserCommand extends Command
{
    public const NAME = 'user:create-admin';
    public const EMAIL_FIELD = 'email';
    public const PASSWORD_FIELD = 'password';

    /** @var UserManagerInterface */
    private $userManager;

    /** @var ValidatorInterface */
    private $validator;

    public function __construct(UserManagerInterface $userManager, ValidatorInterface $validator)
    {
        $this->userManager = $userManager;
        $this->validator = $validator;
        parent::__construct();
    }

    protected function configure(): void
    {
        $this->setName(self::NAME)
            ->setDescription('Command for creating admin user')
            ->setDefinition(array(
                new InputArgument(self::EMAIL_FIELD, InputArgument::REQUIRED, 'The email'),
                new InputArgument(self::PASSWORD_FIELD, InputArgument::REQUIRED, 'The password')
            ));
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     */
    protected function execute(InputInterface $input, OutputInterface $output): void
    {
        $email = $input->getArgument(self::EMAIL_FIELD);
        $password = $input->getArgument(self::PASSWORD_FIELD);
        $user = $this->userManager->createUser();

        $user->setEmail($email)
            ->setPlainPassword($password)
            ->addRole(Role::ROLE_ADMIN);
        $this->userManager->updateUser($user);

        $io = new SymfonyStyle($input, $output);

        $io->success(
            "\nCreated new admin\nEmail: $email"
        );
    }
}
