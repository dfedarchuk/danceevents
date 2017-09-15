<?php

/*==================================================================*\
	######################################################################
	#                                                                    #
	# Copyright 2015 Arca Solutions, Inc. All Rights Reserved.           #
	#                                                                    #
	# This file may not be redistributed in whole or part.               #
	# eDirectory is licensed on a per-domain basis.                      #
	#                                                                    #
	# ---------------- eDirectory IS NOT FREE SOFTWARE ----------------- #
	#                                                                    #
	# http://www.edirectory.com | http://www.edirectory.com/license.html #
	######################################################################
	\*==================================================================*/

# ----------------------------------------------------------------------------------------------------
# * FILE: /classes/class_Symfony.php
# ----------------------------------------------------------------------------------------------------

use GuzzleHttp\Exception\RequestException;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Yaml\Dumper;
use Symfony\Component\Yaml\Parser;

/**
 *
 * Class to integration of the symfony and edirectory
 *
 * @copyright Copyright 2015 Arca Solutions, Inc.
 * @author    Arca Solutions, Inc.
 * @version   10.5.0
 * @package   Classes
 * @name Symfony
 * @access    Public
 */
class Symfony
{
    /**
     * @var string
     */
    private $configFile;

    /**
     * @var array
     */
    private $fileValue;

    /**
     * Depth of yaml
     *
     * @var int
     */
    private $depth = 10;

    /**
     * @var array
     */
    private $value = [];

    /**
     * The constructor
     *
     * @param string $file
     */
    public function __construct($file)
    {
        $path = EDIRECTORY_ROOT.'/../app/config/';
        $this->configFile = $path.$file;

        // Checks if file exist
        $fs = new Filesystem();
        if (!$fs->exists($this->configFile)) {
            $fs->dumpFile($this->configFile, '');
        }

        $yml = new Parser();
        $this->fileValue = (array)$yml->parse(file_get_contents($this->configFile));
    }

    function __destruct()
    {
        $this->cacheClear();
        $this->cleanCacheLiipImagine();
    }

    /**
     * Clean env cache folder to solve the problem for yml cache
     */
    private function cacheClear()
    {
        $extensions = [
            'php',
            'meta',
            'xml',
            'log',
        ];

        $fs = new Filesystem();
        $path = SymfonyCore::getContainer()->getParameter('kernel.cache_dir');
        foreach ($extensions as $ext) {
            foreach (glob($path.'/*.'.$ext) as $file) {
                $fs->remove($file);
            }
        }
    }

    /**
     * Clean image's cache that liip generate
     */
    private function cleanCacheLiipImagine()
    {
        $fieldsToExclude = ['domain.favicon', 'android.screen.image.path', 'domain.noimage', 'domain.header.image'];
        $fieldsThatExist = [];
        foreach ($fieldsToExclude as $key) {
            if ($value = static::recursiveSearchInArray($key, $this->value)) {
                $fieldsThatExist[$key] = $value;
            }
        }

        if (count($fieldsThatExist) == 0) {
            return;
        }

        $container = SymfonyCore::getContainer();

        foreach ($fieldsThatExist as $value) {
            $filterNames = array_keys($container->getParameter("liip_imagine.filter_sets"));

            foreach ($filterNames as $name) {
                $container->get('liip_imagine.cache.manager')->remove($value, $name);
            }
        }

        return;
    }

    public static function recursiveSearchInArray($key, $array)
    {
        foreach ($array as $item => $val) {
            if ($item === $key) {
                return $val;
            }

            if (is_array($val)) {
                if ($val = static::recursiveSearchInArray($key, $val)) {
                    return $val;
                }
            }
        }

        return false;
    }

    /**
     * Retrieve the settings of the yaml files
     *
     * @param string $type
     *
     * @return array|mixed
     */
    public function getConfig($type = null)
    {
        if (!is_null($type)) {
            return $this->fileValue[$type];
        }

        return $this->fileValue;
    }

    /**
     * Saves the config in the yaml file
     *
     * @param       $type
     * @param array $value
     */
    public function save($type, array $value)
    {
        $function = 'save'.$this->to_camel_case($type, true);
        $this->$function($value);
        $this->value = $value;

        $dumper = new Dumper();
        // Second parameter is sent to avoid the content be parsed inline in yml file
        $yaml = $dumper->dump($this->fileValue, $this->depth);

        file_put_contents($this->configFile, $yaml);
    }

    /**
     * Translates a string with underscores
     * into camel case (e.g. first_name -> firstName)
     *
     * @param string $str String in underscore format
     * @param bool $capitalise_first_char If true, capitalise the first char in $str
     *
     * @return string $str translated into camel caps
     */
    private function to_camel_case($str, $capitalise_first_char = false)
    {
        if ($capitalise_first_char) {
            $str[0] = strtoupper($str[0]);
        }
        $func = create_function('$c', 'return strtoupper($c[1]);');

        return preg_replace_callback('/_([a-z])/', $func, $str);
    }

    /**
     * Remove config of the yaml file
     *
     * @param       $type
     * @param       $value
     */
    public function remove($type, $value)
    {
        $function = 'remove'.$this->to_camel_case($type, true);
        $this->$function($value);

        $dumper = new Dumper();
        // Second parameter is sent to avoid the content be parsed inline in yml file
        $yaml = $dumper->dump($this->fileValue, $this->depth);

        file_put_contents($this->configFile, $yaml);
    }

    /**
     * Translates a camel case string into a string with
     * underscores (e.g. firstName -> first_name)
     *
     * @param string $str String in camel case format
     *
     * @return string $str Translated into underscore format
     */
    private function from_camel_case($str)
    {
        $str[0] = strtolower($str[0]);
        $func = create_function('$c', 'return "_" . strtolower($c[1]);');

        return preg_replace_callback('/([A-Z])/', $func, $str);
    }

    /**
     * Save Domain
     * This function is used when saves New Domain
     *
     * @param array $value
     *
     * @return array
     */
    private function saveMultiDomain(array $value)
    {
        $config = $this->fileValue['multi_domain'];
        $newDomain = isset($value['newDomain']) ? $value['newDomain'] : false;
        unset($value['newDomain']);
        $rebuildElastic = isset($value['rebuildElastic']) ? $value['rebuildElastic'] : false;
        unset($value['rebuildElastic']);

        if (isset($config['hosts'])) {
            $config['hosts'] = array_replace_recursive($config['hosts'], $value);
        } else {
            $config = ['hosts' => $value];
        }

        /* Creates a new domain routing */
        if ($newDomain === true) {
            /* Duplicates config files */
            $path = EDIRECTORY_ROOT.'/../app/config/domains';
            $fs = new Filesystem();
            $fs->copy($path.'/domain.configs.yml.sample', $path.'/'.key($value).'.configs.yml');
            $fs->copy($path.'/domain.payment.yml.sample', $path.'/'.key($value).'.payment.yml');
            $fs->copy($path.'/domain.route.yml.sample', $path.'/'.key($value).'.route.yml');
        }

        if ($newDomain === true || $rebuildElastic === true) {
            /* Creates elastic index */
            $_conf = $config['hosts'][key($value)];

            if (array_key_exists("locale", $_conf) and array_key_exists("elastic", $_conf)) {
                $language = array_key_exists("locale", $_conf) ? $_conf['locale'] : null;
                $indexName = array_key_exists("elastic", $_conf) ? $_conf['elastic'] : null;

                $synchronization = SymfonyCore::getContainer()->get("elasticsearch.synchronization");
                $synchronization->createIndex($language, $indexName);
                $synchronization->synchronizeAll();
            } else {
                SymfonyCore::getContainer()->get("logger")->critical("");
            }
        }

        $this->fileValue['multi_domain'] = $config;
    }

    /**
     * @param $index
     * @param $rivers
     */
    private function removeElastic($index, $rivers = null)
    {
        SymfonyCore::getContainer()->get("elasticsearch.synchronization")->deleteIndex();
        if ($rivers === null) {
            // Path of rivers files
            $jsonBasePath = EDIRECTORY_ROOT.'/../ElasticConfigs/RiverConfigs/JSON';

            /* Files of rivers */
            $rivers = [
                'badges'     => $jsonBasePath.'/badges.json',
                'categories' => $jsonBasePath.'/categories.json',
                'modules'    => $jsonBasePath.'/modules.json',
            ];
        }

        // Gets the configuration elasticsearch
        $elasticConfig = SymfonyCore::getContainer()->getParameter('search.config');
        $host = $elasticConfig['elasticsearch']['servers']['server1']['host'];
        $port = $elasticConfig['elasticsearch']['servers']['server1']['port'];
        $url = "http://{$host}:{$port}/{$index}";
        $riverUrl = "http://{$host}:{$port}/_river/{$index}";

        foreach ($rivers as $river => $file) {
            $this->elasticExec('delete', $riverUrl.$river, 'Error on delete rivers ['.$river.']');
        }

        $this->elasticExec('delete', $url, 'Error on delete elasticsearch index ['.$index.']');
    }

    /**
     *
     * @param string $type
     * @param string $url
     * @param string $error Message of exception
     * @param array $options Request options
     */
    private function elasticExec($type, $url, $error, array $options = [])
    {
        $guzzleClient = new \GuzzleHttp\Client();

        try {
            switch ($type) {
                case 'get':
                    $guzzleClient->get($url, $options);
                    break;
                case 'post':
                    $guzzleClient->post($url, $options);
                    break;
                case 'delete':
                    $guzzleClient->delete($url);
                    break;
                default:
                    break;
            }
        } catch (RequestException $e) {
            SymfonyCore::getContainer()->get('logger')
                ->critical($error.' ['.$e->getMessage().']');
        }
    }

    /**
     * Remove Domain
     * This function is used when remove a Domain
     *
     * @param string $key
     * @return array
     * @throws Exception
     */
    private function removeMultiDomain($key)
    {
        $config = $this->fileValue['multi_domain']['hosts'];

        if (array_key_exists($key, $config)) {
            /* Removes old config files */
            $path = EDIRECTORY_ROOT.'/../app/config/domains';
            $fs = new Filesystem();
            $fs->remove([
                $path.'/'.$key.'.configs.yml',
                $path.'/'.$key.'.payment.yml',
                $path.'/'.$key.'.route.yml',
            ]);

            $this->removeElastic($config[$key]['elastic']);

            unset($config[$key]);
            $this->fileValue['multi_domain']['hosts'] = $config;
        }
    }

    /**
     * Merge two arrays for save in yml file
     * This function is used when for save ConfigChecker settings
     *
     * @param array $value
     *
     * @return void
     */
    private function saveConfigs(array $value)
    {
        $this->fileValue = array_replace_recursive($this->fileValue, $value);
    }

    private function saveMenu(array $value)
    {
        $menu_name_parameter = key(current($value));

        if (!array_key_exists($menu_name_parameter, current($this->fileValue))) {
            return $this->fileValue;
        }

        unset($this->fileValue['parameters'][$menu_name_parameter]);

        return $this->fileValue = array_replace_recursive($this->fileValue, $value);
    }

    /**
     * Save Parameters
     *
     * @param array $value
     */
    private function saveApiTokens(array $value)
    {
        $domain = key($value);
        if ($tokens = $this->fileValue['parameters']['api_tokens']) {
            $tokens[$domain] = $value[$domain];
        } else {
            $tokens = $value;
        }

        $this->fileValue['parameters']['api_tokens'] = $tokens;
    }

    /**
     * Save Parameters
     *
     * @param array $value
     */
    private function saveApiPin(array $value)
    {
        $domain = key($value);
        if ($tokens = $this->fileValue['parameters']['api_pin']) {
            $tokens[$domain] = $value[$domain];
        } else {
            $tokens = $value;
        }

        $this->fileValue['parameters']['api_pin'] = $tokens;
    }
}
