<?php
/**
 * Auto WebP Image Compressor
 * Engineered to drastically reduce image payload and achieve 90+ Core Web Vitals.
 * Perfect for E-commerce platforms with heavy product galleries.
 */
class ImageOptimizer {
    
    /**
     * Converts standard images to next-gen WebP format.
     */
    public static function convertToWebP($sourceImage, $destinationImage, $quality = 80) {
        $extension = strtolower(pathinfo($sourceImage, PATHINFO_EXTENSION));
        
        if ($extension === 'jpeg' || $extension === 'jpg') {
            $image = imagecreatefromjpeg($sourceImage);
        } elseif ($extension === 'png') {
            $image = imagecreatefrompng($sourceImage);
            // Preserve transparency for PNGs
            imagepalettetotruecolor($image);
            imagealphablending($image, true);
            imagesavealpha($image, true);
        } else {
            return false; // Unsupported format
        }
        
        // Generate WebP and free up server memory
        $success = imagewebp($image, $destinationImage, $quality);
        imagedestroy($image);
        
        return $success;
    }
}

/* // Usage Example:
$source = '/uploads/heavy-product-image.jpg';
$destination = '/uploads/optimized-product-image.webp';
ImageOptimizer::convertToWebP($source, $destination, 85);
*/
?>
