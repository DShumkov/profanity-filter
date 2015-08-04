# profanity-filter
Profanity filter based on PHP Swearjar library
## Installation
composer require dshumkov/profanity-filter
## Usage
### Predefined dictionary
```
$tester = new DShumkov\ProfaneFilter\Tester();

if ($tester->profane('son-of-a-bitch'))
  {
    return 'bad word detected';
  }
```
### Custom dictionary
```
$dictionary = [
	'regex'     => ['regex1', 'regex2'],
    'word'      => ['word1', 'word2'],
    'phrase'    => ['phrase one', 'phrase two']
];
$tester = new DShumkov\ProfaneFilter\Tester($dictionary);

if ($tester->profane('some string with word1') OR $tester->profane('phrase two'))
{
return 'bad word detected';
}
```