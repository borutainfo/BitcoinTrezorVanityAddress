<?php
/**
 * Created by PhpStorm.
 * User: boruta
 * Date: 08.01.19
 * Time: 17:11
 */

namespace Boruta\BitcoinVanity\Repository;


use Boruta\BitcoinVanity\Entity\WordEntity;
use Boruta\BitcoinVanity\Exception\RepositoryException;
use Boruta\BitcoinVanity\Extractor\WordEntityExtractor;
use Boruta\BitcoinVanity\Gateway\WordGateway;
use Boruta\BitcoinVanity\Hydrator\WordEntityHydrator;
use Boruta\BitcoinVanity\ValueObject\UnsignedNumber;

/**
 * Class WordRepository
 * @package Boruta\BitcoinVanity\Repository
 */
class WordRepository
{
    /**
     * @var WordGateway
     */
    protected $gateway;

    /**
     * WordRepository constructor.
     * @param WordGateway $gateway
     */
    public function __construct(WordGateway $gateway)
    {
        $this->gateway = $gateway;
    }

    /**
     * @param WordEntity $entity
     */
    public function addNewWord(WordEntity $entity): void
    {
        $extractor = new WordEntityExtractor();
        $data = $extractor->extract($entity);

        $result = $this->gateway->addNewWord($data);

        if ($result === null) {
            throw new RepositoryException('Unable to add new word - operation was unsuccessful.');
        }

        if ($result > 0) {
            $entity->setId(new UnsignedNumber($result));
        } else {
            /** @noinspection NullPointerExceptionInspection */
            $result = $this->gateway->getWord($entity->getWord()->value());
            if (!$result) {
                throw new RepositoryException('Unable to add new word - operation was unsuccessful.');
            }

            $hydrator = new WordEntityHydrator();
            $hydrator->hydrate($result, $entity);
        }
    }
}
