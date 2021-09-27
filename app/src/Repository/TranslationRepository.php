<?php

namespace App\Repository;

use App\Entity\Key;
use App\Entity\Language;
use App\Entity\Translation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Translation|null find($id, $lockMode = null, $lockVersion = null)
 * @method Translation|null findOneBy(array $criteria, array $orderBy = null)
 * @method Translation[]    findAll()
 * @method Translation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @extends \Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository<Translation>
 */
class TranslationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Translation::class);
    }

    /**
     * Delete Transaction
     *
     * @param Translation $translation
     * @return void
     */
    public function delete(Translation $translation)
    {
        $this->getEntityManager()->remove($translation);
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
     * returns a all Translations from given Language ISO code
     *
     * @param string|null $languageIso
     * @return array
     */
     public function getTranslationFromLanguage(?string $languageIso): array {
        // create a QueryBuilder
        $qb = $this->getEntityManager()->createQueryBuilder();
        if($languageIso) {
            // look for Translations from each Key for Language
            $qb->select('k.name, t.translation')
                ->from(Translation::class, 't')
                ->innerJoin(Key::class, 'k', 'WITH', 't.key_id = k.id')
                ->innerJoin(Language::class, 'l', 'WITH', 't.language_id=l.id')
                ->where('l.iso = :iso')
                ->setParameter('iso', $languageIso);
        }
        $translations = $qb->getQuery()->getResult();
        return $translations;
    }

    /**
     * Return a Translation with given Key/Language pair
     *
     * @param integer|null $keyId
     * @return array
     */
    public function getTranslationFromKey(?int $keyId): array {
        // create a QueryBuilder
        $qb = $this->getEntityManager()->createQueryBuilder();
        if($keyId) {
            // look for Translation with Key Id and Language ISO code
            $qb->select('t.id as translation_id, t.key_id, l.iso as language_iso, t.translation, t.created, t.created_by, t.updated, t.updated_by')
                ->from(Translation::class, 't')
                ->innerJoin(Language::class, 'l', 'WITH', 't.language_id = l.id')
                ->where('t.key_id = :keyId')
                ->setParameter('keyId', $keyId);
        }
        $translations = $qb->getQuery()->getResult();
        return $translations;
    }

    /**
     * Returns a Translation with given Key/Language pair
     *
     * @param integer $keyId
     * @param integer $languageId
     * @return Translation|null
     */
    public function getTranslationFromKeyLanguage(
        int $keyId,
        int $languageId
    ): ?Translation {
        // create a QueryBuilder
        $qb = $this->getEntityManager()->createQueryBuilder();
        // look for Translation with Key Id and Language ISO code
        $qb->select('t')
            ->from(Translation::class, 't')
            ->where('t.key_id = :keyId')
            ->andWhere('t.language_id = :langId')
            ->setParameter('keyId', $keyId)
            ->setParameter('langId', $languageId);
        $translation = $qb->getQuery()->getResult();

        if (empty($translation)) {
            return null;
        }
        return $translation[0];
    }

    /**
     * Save Translation
     *
     * @param Translation $translation
     * @return Translation
     */
    public function save(Translation $translation): Translation
    {
        $this->getEntityManager()->persist($translation);
        $this->getEntityManager()->flush();
        return $translation;
    }
}
