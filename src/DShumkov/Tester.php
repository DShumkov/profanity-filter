<?php

namespace DShumkov\ProfaneFilter;


/**
 * Class Tester
 * @package DShumkov\ProfaneFilter
 */
class Tester {

    /**
     * @var array
     */
    protected $matchers = [
        'regex'     => ['regex1', 'regex2'],
        'word'      => ['word1', 'word2'],
        'phrase'    => ['phrase one', 'phrase two']
    ];

    /**
     * @param null|array $matchers
     * Look above to know $matchers format.
     */
    function __construct(array $matchers = null) {
        if (null === $matchers)
        {
            $this->loadPredifined();
            return;
        }

        $this->matchers = $matchers;


    }

    /**
     * @return void
     */
    protected function loadPredifined()
    {
        $this->matchers = json_decode(file_get_contents(__DIR__.'/../config/en.json'),true);
    }

    /**
     * @param string $string
     * @return bool
     */
    public function profane($string)
    {

        return $this->isInPhrase($string) OR $this->isInRegex($string) OR $this->isInWord($string);
    }


    /**
     * @param string $string
     * @return bool
     */
    protected function isInRegex($string)
    {
        if (!isset($this->matchers['regex']))
        {
            return false;
        }

        foreach ( $this->matchers['regex'] as $regex)
        {
            if (0 !== preg_match($regex, $string))
            {
                return true;
            }
        }

        return false;
    }

    /**
     * @param string $string
     * @return bool
     */
    protected function isInWord($string)
    {
        if (!isset($this->matchers['word']))
        {
            return false;
        }


        $words = preg_split('/[\W]+/', $string);

        foreach ($this->matchers['word'] as $bad_word)
        {
            foreach($words as $word)
            {
                if (strtolower($word) === strtolower($bad_word))
                {
                    return true;
                }
            }
        }
        return false;
    }

    /**
     * @param string $string
     * @return bool
     */
    protected function isInPhrase($string)
    {
        if (!isset($this->matchers['phrase']))
        {
            return false;
        }

        foreach ( $this->matchers['phrase'] as $phrase )
        {
            if (false !== stristr($string, $phrase))
            {
                return true;
            }
        }
        return false;

    }




}
