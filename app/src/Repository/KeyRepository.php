<?php

namespace App\Repository;

use App\Entity\Key;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Key|null find($id, $lockMode = null, $lockVersion = null)
 * @method Key|null findOneBy(array $criteria, array $orderBy = null)
 * @method Key[]    findAll()
 * @method Key[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @extends \Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository<Key>
 */
class KeyRepository extends ServiceEntityRepository
{
    private TranslationRepository $translationRepository;

    public function __construct(
        ManagerRegistry $registry,
        TranslationRepository $translationRepository
    ) {
        parent::__construct($registry, Key::class);
        $this->translationRepository = $translationRepository;
    }

    /**
     * Delete a Key
     *
     * @param Key $key
     * @return void
     */
    public function delete(Key $key)
    {
        $this->getEntityManager()->remove($key);
        $this->getEntityManager()->flush();
    }

    /**
     * Flush to DDBB
     *
     * @return void
     */
    public function flush()
    {
        $this->getEntityManager()->flush();
    }

    /**
     * Undocumented function
     * Detects if there is a previous Key with same name
     * @param string $name
     * @param integer|null $id
     * @return boolean
     */
    //
    public function isUnique(
        string $name,
        ?int $id = null
    ): bool {
        if (!$id) {
            $previousKey = $this->findOneBy(['name'=>$name]);
        } else {
            // create a QueryBuilder
            $qb = $this->getEntityManager()->createQueryBuilder();
            // looks for previous key names with different Id
            $qb->select('k')
                ->from(Key::class, 'k')
                ->where('k.name = :name')
                ->andWhere('k.id != :id')
                ->setParameter('name', $name)
                ->setParameter('id', $id);
            $previousKey = $qb->getQuery()->getResult();
        }
        if (empty($previousKey)) {
            return true;
        }
        return false;
    }

    /**
     * Find all Keys on DDBB
     *
     * @return void
     */
    public function listKeys()
    {
        $keys = $this->findAll();
        return $keys;
    }

    /**
     * Save a Key to DDBB
     *
     * @param Key $key
     * @return Key
     */
    public function save(Key $key): Key
    {
        $this->getEntityManager()->persist($key);
        $this->getEntityManager()->flush();
        return $key;
    }
}
