ALTER table `trabalho` ADD FULLTEXT KEY `title` (`TITLE`,`TEXT`);
ALTER table `trabalho` ADD FULLTEXT KEY `title_stemmer` (`title_stemmer`,`text_stemmer`);