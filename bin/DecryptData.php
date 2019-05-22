<?php declare(strict_types=1);
/**
 * @author Sebastian Boruta <sebastian@boruta.info>
 */

use Boruta\BitcoinVanity\Command\DecryptDataCommand;
use Boruta\CommonAbstraction\DependencyInjector\DependencyInjector;
use Boruta\CommonAbstraction\ValueObject\RawString;

/* config: */

$dataToDecrypt = <<<DECRYPT
1234567890_SOME_ENCRYPTE_DATA
DECRYPT;

/* script: */

require __DIR__ . '/../vendor/autoload.php';

/** @var DecryptDataCommand $decryptDataCommand */
$decryptDataCommand = DependencyInjector::get(DecryptDataCommand::class);

echo $decryptDataCommand->execute(new RawString($dataToDecrypt))->value() . PHP_EOL;
