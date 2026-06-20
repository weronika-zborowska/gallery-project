<?php
/**
 * Application fixtures.
 */

namespace App\DataFixtures;

use App\Entity\Comment;
use App\Entity\Gallery;
use App\Entity\Photo;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

/**
 * Loads sample data for the application.
 */
class AppFixtures extends Fixture
{
    /**
     * Constructor.
     *
     * @param UserPasswordHasherInterface $passwordHasher Password hasher.
     */
    public function __construct(private readonly UserPasswordHasherInterface $passwordHasher)
    {
    }

    /**
     * Loads sample data.
     *
     * @param ObjectManager $manager Object manager.
     *
     * @return void
     */
    public function load(ObjectManager $manager): void
    {
        $admin = new User();
        $admin->setEmail('admin@example.com');
        $admin->setRoles(['ROLE_ADMIN']);
        $admin->setPassword(
            $this->passwordHasher->hashPassword($admin, 'admin123')
        );

        $manager->persist($admin);

        $galleryOne = new Gallery();
        $galleryOne->setTitle('Galeria 1');
        $galleryOne->setDescription('Przykładowa galeria ze zdjęciami kwiatów.');
        $galleryOne->setCreatedAt(new \DateTimeImmutable('2026-06-01 10:00:00'));

        $galleryTwo = new Gallery();
        $galleryTwo->setTitle('Galeria 2');
        $galleryTwo->setDescription('Przykładowa galeria ze zdjęciami kwiatów.');
        $galleryTwo->setCreatedAt(new \DateTimeImmutable('2026-06-02 12:00:00'));

        $manager->persist($galleryOne);
        $manager->persist($galleryTwo);

        $photoOne = new Photo();
        $photoOne->setFilename('6a36d10d58434.jpg');
        $photoOne->setTitle('Zdjęcie 1');
        $photoOne->setDescription('Przykładowe zdjęcie róży.');
        $photoOne->setCreatedAt(new \DateTimeImmutable('2026-06-03 09:00:00'));
        $photoOne->setGallery($galleryOne);

        $photoTwo = new Photo();
        $photoTwo->setFilename('6a0c97ab897d1.jpg');
        $photoTwo->setTitle('Zdjęcie 2');
        $photoTwo->setDescription('Przykładowe zdjęcie kwiatu.');
        $photoTwo->setCreatedAt(new \DateTimeImmutable('2026-06-04 18:30:00'));
        $photoTwo->setGallery($galleryOne);

        $photoThree = new Photo();
        $photoThree->setFilename('6a0d505d680f1.jpg');
        $photoThree->setTitle('Zdjęcie 3');
        $photoThree->setDescription('Przykładowe zdjęcie różowego kwiatu.');
        $photoThree->setCreatedAt(new \DateTimeImmutable('2026-06-05 14:15:00'));
        $photoThree->setGallery($galleryTwo);

        $photoFour = new Photo();
        $photoFour->setFilename('6a36d1c9cb68b.jpg');
        $photoFour->setTitle('Zdjęcie 4');
        $photoFour->setDescription('Przykładowe zdjęcie kwiatu.');
        $photoFour->setCreatedAt(new \DateTimeImmutable('2026-06-05 14:15:00'));
        $photoFour->setGallery($galleryTwo);

        $manager->persist($photoOne);
        $manager->persist($photoTwo);
        $manager->persist($photoThree);
        $manager->persist($photoFour);

        $commentOne = new Comment();
        $commentOne->setEmail('anna@example.com');
        $commentOne->setNickname('Anna');
        $commentOne->setContent('Bardzo ładne zdjęcie.');
        $commentOne->setCreatedAt(new \DateTimeImmutable('2026-06-06 10:00:00'));
        $commentOne->setPhoto($photoOne);

        $commentTwo = new Comment();
        $commentTwo->setEmail('jan@example.com');
        $commentTwo->setNickname('Jan');
        $commentTwo->setContent('Świetna galeria!');
        $commentTwo->setCreatedAt(new \DateTimeImmutable('2026-06-06 11:30:00'));
        $commentTwo->setPhoto($photoTwo);

        $manager->persist($commentOne);
        $manager->persist($commentTwo);

        $manager->flush();
    }
}
