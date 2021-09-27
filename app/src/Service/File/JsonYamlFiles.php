<?php

namespace App\Service\File;

use App\Repository\LanguageRepository;
use App\Repository\TranslationRepository;
use Symfony\Component\HttpFoundation\UrlHelper;
use Symfony\Component\Serializer\Encoder\JsonEncode;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Yaml\Yaml;
use ZipArchive;


class JsonYamlFiles
{
	const FILENAME_JSON_BEGIN = 'TMS-JSON_';
	const FILENAME_YAML_BEGIN = 'TMS-YAML_';
	const PATH = 'tms/';
	const PUBLIC_PATH = '/tms/';


	private LanguageRepository $languageRepository;
	private TranslationRepository $translationRepository;
	private UrlHelper $urlHelper;

	public function __construct(
		LanguageRepository $languageRepository,
		TranslationRepository $translationRepository,
		UrlHelper $urlHelper
	)
	{
		$this->languageRepository = $languageRepository;
		$this->translationRepository = $translationRepository;
		$this->urlHelper = $urlHelper;
	}

    /**
     * Create download URLs for Zip files with all available Translations for all Keys in JSON and YAML versions
     *
     * @return array|null
     */
    public function __invoke(): ?array
    {
        // create a serializer for JSON conversion 
        $encoders = [new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];
        $serializer = new Serializer($normalizers, $encoders);

        // initial values
        $filenameYaml = 'translations.yaml';
        $languages = $this->languageRepository->findAll();
        $yaml = [];
        $uniqueId = uniqid();
        $zipJsonName = self::FILENAME_JSON_BEGIN . $uniqueId .'.zip';
        $zipYamlName = self::FILENAME_YAML_BEGIN . $uniqueId .'.zip';

        // Create new Zip archive for Json contents
        $zipJson = new \ZipArchive();
        $zipJson->open(self::PATH . $zipJsonName, ZipArchive::CREATE);

        // Create new Zip archive for Yaml contents
        $zipYaml = new \ZipArchive();
        $zipYaml->open(self::PATH . $zipYamlName, ZipArchive::CREATE);

        foreach($languages as $language) {
            $exportTranslations = [];
            $languageIso = $language->getIso();
            $languageName = $language->getName();
            // create a filename for each language
            $filenameJson = strtolower($languageName) .'-'. strtolower($languageIso) .'.json';
            $translations = $this->translationRepository->getTranslationFromLanguage($languageIso);
            foreach($translations as $translation) {
                $exportTranslations[$translation['name']] = $translation['translation'];
            }
            $yaml[strtolower($languageName)] =  $exportTranslations;
            $jsonContent = $serializer->serialize($exportTranslations, JsonEncoder::FORMAT, [JsonEncode::OPTIONS => JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT]);
            // try catch
            // add to Json Zip a new language contents with desired Json filename
            $zipJson->addFromString($filenameJson, $jsonContent);
        }

        // creating Zip file and public download link
        $zipJson->close();
        $zipJsonUrl = $this->urlHelper->getAbsoluteUrl(self::PUBLIC_PATH . $zipJsonName);

        // add to Yaml Zip all languages content with desired Yaml filename
        $yamlContent = Yaml::dump($yaml, 2);
        $zipYaml->addFromString($filenameYaml, $yamlContent);

        // creating Yaml file and public download link
        $zipYaml->close();
        $zipYamlUrl = $this->urlHelper->getAbsoluteUrl(self::PUBLIC_PATH . $zipYamlName);

        $message = array(
            "json" =>  $zipJsonUrl, 
            "yaml" => $zipYamlUrl
        );
        return [$message, null];
    }
}