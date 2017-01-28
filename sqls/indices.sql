ALTER table `trabalho` ADD FULLTEXT KEY `title` (`TITLE`,`TEXT`);
ALTER table `trabalho` ADD FULLTEXT KEY `title_stemmer` (`title_stemmer`,`text_stemmer`);

ALTER table `trabalho` ADD FULLTEXT KEY `teste1` (`TITLE`);
ALTER table `trabalho` ADD FULLTEXT KEY `teste2` (`TEXT`);