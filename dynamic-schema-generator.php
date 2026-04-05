<?php
/**
 * Dynamic JSON-LD Schema Generator
 * Engineered for high-performance scaling across 50,000+ dynamic pages.
 * Note: Sensitive database queries have been removed for public display.
 */
class DynamicSchemaGenerator {
    private $schemaData = [];

    public function __construct($type = 'WebPage') {
        $this->schemaData['@context'] = 'https://schema.org';
        $this->schemaData['@type'] = $type;
    }

    public function addSchemaProperty($key, $value) {
        $this->schemaData[$key] = $value;
    }

    public function generateSchema() {
        // Unescaped slashes to keep URLs clean and ensure fast JSON encoding
        $json = json_encode($this->schemaData, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
        return '<script type="application/ld+json">' . PHP_EOL . $json . PHP_EOL . '</script>';
    }
}

/* // Usage Example (Demonstration only):
$seoSchema = new DynamicSchemaGenerator('Article');
$seoSchema->addSchemaProperty('headline', 'Optimizing PHP for 100/100 PageSpeed');
$seoSchema->addSchemaProperty('author', [
    '@type' => 'Person',
    'name'  => 'Vikas - Senior Web Developer'
]);
echo $seoSchema->generateSchema();
*/
?>
