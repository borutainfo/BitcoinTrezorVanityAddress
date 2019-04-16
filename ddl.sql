CREATE TABLE private_keys
(
  id                    INT UNSIGNED AUTO_INCREMENT
  COMMENT 'record id'
    PRIMARY KEY,
  encrypted_private_key VARCHAR(128) NOT NULL
  COMMENT 'encrypted private key',
  CONSTRAINT private_keys_encrypted_private_key_uindex
  UNIQUE (encrypted_private_key)
)
  COMMENT 'encrypted private keys for addresses'
  ENGINE = InnoDB;

CREATE TABLE mnemonic_seeds
(
  id               INT UNSIGNED AUTO_INCREMENT
  COMMENT 'record id'
    PRIMARY KEY,
  encrypted_phrase VARCHAR(255)         NOT NULL
  COMMENT 'seed phrase encrypted',
  entropy_size     INT(3) DEFAULT '256' NOT NULL
  COMMENT 'entropy size in bits'
)
  COMMENT 'encrypted mnemonic seeds list'
  ENGINE = InnoDB;

CREATE TABLE addresses
(
  id             INT UNSIGNED AUTO_INCREMENT
  COMMENT 'record id'
    PRIMARY KEY,
  address        VARCHAR(42)  NOT NULL
  COMMENT 'bitcoin address',
  derived_path   VARCHAR(16)  NOT NULL
  COMMENT 'BIP32 derivation path',
  mnemonic_id    INT UNSIGNED NOT NULL
  COMMENT 'id of mnemonic seed to generate address',
  private_key_id INT UNSIGNED NOT NULL
  COMMENT 'id of private key to import address to any wallet',
  CONSTRAINT addresses_address_uindex
  UNIQUE (address),
  CONSTRAINT addresses_mnemonic_seeds_id_fk
  FOREIGN KEY (mnemonic_id) REFERENCES mnemonic_seeds (id),
  CONSTRAINT addresses_private_keys_id_fk
  FOREIGN KEY (private_key_id) REFERENCES private_keys (id)
)
  COMMENT 'bitcoin addresses'
  ENGINE = InnoDB;

CREATE TABLE words
(
  id    INT UNSIGNED AUTO_INCREMENT
  COMMENT 'entry id'
    PRIMARY KEY,
  word  VARCHAR(32)        NOT NULL
  COMMENT 'word that occurred in the address',
  value INT(2) DEFAULT '1' NOT NULL
  COMMENT 'value of the word',
  CONSTRAINT words_word_uindex
  UNIQUE (word)
)
  COMMENT 'dictionary of words found in addresses'
  ENGINE = InnoDB;

CREATE TABLE addresses_words
(
  address_id INT UNSIGNED NOT NULL
  COMMENT 'entry id for address',
  word_id    INT UNSIGNED NOT NULL
  COMMENT 'entry id for word',
  PRIMARY KEY (address_id, word_id),
  CONSTRAINT addresses_words_address_id_word_id_uindex
  UNIQUE (address_id, word_id),
  CONSTRAINT addresses_words_addresses_id_fk
  FOREIGN KEY (address_id) REFERENCES addresses (id),
  CONSTRAINT addresses_words_words_id_fk
  FOREIGN KEY (word_id) REFERENCES words (id)
)
  COMMENT 'junction table for addresses and words'
  ENGINE = InnoDB;

CREATE TABLE semaphore
(
  type      VARCHAR(16)  NOT NULL
  COMMENT 'semaphore type',
  locked_id INT UNSIGNED NOT NULL
  COMMENT 'locked entry id',
  instance  VARCHAR(40)  NOT NULL
  COMMENT 'worker instance id',
  PRIMARY KEY (locked_id, type),
  CONSTRAINT semaphore_locked_id_type_uindex
  UNIQUE (locked_id, type)
)
  COMMENT 'multiple processes synchronization table'
  ENGINE = InnoDB;

CREATE INDEX addresses_mnemonic_seeds_id_fk
  ON addresses (mnemonic_id);

CREATE INDEX addresses_private_keys_id_fk
  ON addresses (private_key_id);

INSERT INTO semaphore (type, locked_id, instance) VALUES ('word', 0, '-');