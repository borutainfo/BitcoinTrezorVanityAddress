<?php declare(strict_types=1);
/**
 * @author Sebastian Boruta <sebastian@boruta.info>
 */

use Boruta\BitcoinVanity\Command\DecryptDataCommand;
use Boruta\BitcoinVanity\DependencyInjection\DependencyInjection;
use Boruta\BitcoinVanity\ValueObject\RawString;

/* config: */

$dataToDecrypt = <<<DECRYPT
1234567890_SOME_ENCRYPTE_DATA
DECRYPT;

/* script: */

require __DIR__ . '/../vendor/autoload.php';

/** @var DecryptDataCommand $decryptDataCommand */
$decryptDataCommand = DependencyInjection::get(DecryptDataCommand::class);

echo $decryptDataCommand->execute(new RawString($dataToDecrypt))->value() . PHP_EOL;
