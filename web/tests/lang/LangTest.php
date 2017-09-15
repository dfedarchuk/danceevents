<?php

/**
 * Class LangTest
 */
class LangTest extends \PHPUnit_Framework_TestCase
{
    private $langs = [
        'en_us',
        'es_es',
        'fr_fr',
        'ge_ge',
        'it_it',
        'pt_br',
        'tr_tr',
    ];

    private $path = '/../../lang/';

    public function testPredefinedLanguageFilesExist()
    {
        foreach ($this->langs as $lang) {
            $fileLang = sprintf('%s%s.php', __DIR__.$this->path, $lang);
            $fileLangSitemgr = sprintf(
                '%s%s_sitemgr.php',
                __DIR__.$this->path,
                $lang
            );
            $this->assertTrue(
                file_exists($fileLang),
                sprintf('File %s does not exists', $fileLang)
            );
            $this->assertTrue(
                file_exists($fileLangSitemgr),
                sprintf('File %s does not exists', $fileLang)
            );
        }
    }

    public function constantsLanguageFiles()
    {
        $array = [];

        $this->dependencyLanguageFiles();

        // includes en_us file
        include sprintf('%s%s.php', __DIR__.$this->path, 'en_us');

        $constantsEnUs = get_defined_constants(true)['user'];

        foreach ($this->langs as $lang) {
            $array[] = [
                $lang,
                sprintf('%s%s.php', __DIR__.$this->path, $lang),
                $constantsEnUs,
            ];
        }

        return $array;
    }

    /**
     * @runInSeparateProcess
     * @preserveGlobalState disabled
     * @dataProvider constantsLanguageFiles
     * @param $lang
     * @param $path
     * @param $expected
     */
    public function testCompareEnglishLanguageConstantsWithOthersLanguages(
        $lang,
        $path,
        $expected
    ) {
        $this->dependencyLanguageFiles();

        include $path;

        $constants = get_defined_constants(true)['user'];

        foreach ($expected as $key => $row) {
            $this->assertTrue(
                array_key_exists($key, $constants),
                sprintf('Key %s does not exists in %s', $key, $lang)
            );
        }
    }

    /**
     * @runInSeparateProcess
     * @preserveGlobalState disabled
     * @dataProvider constantsLanguageFiles
     * @param $lang
     * @param $path
     * @param $expected
     */
    public function testCompareOthersLanguagesWithEnglishLanguageConstants(
        $lang,
        $path,
        $expected
    ) {
        $this->dependencyLanguageFiles();

        include $path;

        $constants = get_defined_constants(true)['user'];

        unset($constants['STDOUT'],
            $constants['STDERR'],
            $constants['RANDOM_COMPAT_READ_BUFFER'],
            $constants['PHPUNIT_COMPOSER_INSTALL'],
            $constants['EDIR_CHARSET']
        );

        foreach ($constants as $key => $row) {
            $this->assertTrue(
                array_key_exists($key, $expected),
                sprintf(
                    'Key %s in %s, does not exists in %s',
                    $key,
                    $lang,
                    'en_us'
                )
            );
        }
    }

    private function dependencyLanguageFiles()
    {
        /* I have to do this, because if not it will stop because of edir logic */
        error_reporting(E_ERROR | E_PARSE | E_WARNING);
        /* the lang files uses a function that use this constant(sorry) */
        define("EDIR_CHARSET", "UTF-8");

        /* that function, which I mentioned above, it is here */
        return include_once __DIR__.'/../../functions/string_funct.php';
    }

    /**
     * Last method called
     */
    public static function tearDownAfterClass()
    {
        /* I have to do this, because if not it will stop because of edir logic */
        error_reporting(E_ALL);
    }
}
