<?php declare(strict_types=1);
/**
 * @author Sebastian Boruta <sebastian@boruta.info>
 */

namespace Boruta\BitcoinVanity\Repository;


use Boruta\BitcoinVanity\Entity\MnemonicSeedEntity;
use Boruta\CommonAbstraction\Exception\RepositoryException;
use Boruta\BitcoinVanity\Extractor\MnemonicSeedEntityExtractor;
use Boruta\BitcoinVanity\Gateway\MnemonicSeedGateway;
use Boruta\CommonAbstraction\ValueObject\UnsignedNumber;

/**
 * Class MnemonicSeedRepository
 * @package Boruta\BitcoinVanity\Repository
 */
class MnemonicSeedRepository
{
    /**
     * @var MnemonicSeedGateway
     */
    protected $gateway;

    /**
     * MnemonicSeedRepository constructor.
     * @param MnemonicSeedGateway $gateway
     */
    public function __construct(MnemonicSeedGateway $gateway)
    {
        $this->gateway = $gateway;
    }

    /**
     * @param MnemonicSeedEntity $entity
     */
    public function addNewMnemonicSeed(MnemonicSeedEntity $entity): void
    {
        $extractor = new MnemonicSeedEntityExtractor();
        $data = $extractor->extract($entity);

        $result = $this->gateway->addNewMnemonicSeed($data);

        if (!$result) {
            throw new RepositoryException('Unable to add new mnemonic seed - operation was unsuccessful.');
        }

        $entity->setId(new UnsignedNumber($result));
    }
}
