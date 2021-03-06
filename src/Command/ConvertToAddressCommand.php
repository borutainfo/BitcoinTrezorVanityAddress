<?php declare(strict_types=1);
/**
 * @author Sebastian Boruta <sebastian@boruta.info>
 */

namespace Boruta\BitcoinVanity\Command;


use BitWasp\Bitcoin\Address\AddressCreator;
use BitWasp\Bitcoin\Key\Deterministic\HierarchicalKey;
use BitWasp\Bitcoin\Script\P2shScript;
use BitWasp\Bitcoin\Script\ScriptFactory;
use BitWasp\Bitcoin\Script\WitnessProgram;
use Boruta\BitcoinVanity\Exception\AddressConversionException;
use Boruta\BitcoinVanity\ValueObject\Address;
use Exception;
use InvalidArgumentException;

/**
 * Class ConvertToAddressCommand
 * @package Boruta\BitcoinVanity\Command
 */
class ConvertToAddressCommand
{
    /**
     * @var AddressCreator
     */
    protected $addressCreator;

    /**
     * ConvertToAddressCommand constructor.
     * @param AddressCreator $addressCreator
     */
    public function __construct(AddressCreator $addressCreator)
    {
        $this->addressCreator = $addressCreator;
    }

    /**
     * @param HierarchicalKey $key
     * @param int $purpose
     * @return Address
     * @throws AddressConversionException
     */
    public function execute(HierarchicalKey $key, int $purpose): Address
    {
        try {
            switch ($purpose) {
                case 44:
                    $script = ScriptFactory::scriptPubKey()->p2pkh($key->getPublicKey()->getPubKeyHash());
                    break;
                case 49:
                    $rs = new P2shScript(ScriptFactory::scriptPubKey()->p2wkh($key->getPublicKey()->getPubKeyHash()));
                    $script = $rs->getOutputScript();
                    break;
                case 84:
                    $p2wpkh = new WitnessProgram(0, $key->getPublicKey()->getPubKeyHash());
                    $script = $p2wpkh->getScript();
                    break;
                default:
                    throw new InvalidArgumentException('Invalid purpose');
            }

            return new Address($this->addressCreator->fromOutputScript($script)->getAddress());
        } catch (Exception $exception) {
            throw new AddressConversionException('Unable to make address conversion.');
        }
    }
}
