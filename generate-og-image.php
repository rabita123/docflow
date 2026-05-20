<?php
// Run once: php generate-og-image.php
// Generates public/og-image.png (1200x630)

$w = 1200; $h = 630;
$img = imagecreatetruecolor($w, $h);

// Colors
$bg1      = imagecolorallocate($img, 7,   7,  13);
$bg2      = imagecolorallocate($img, 15,  15, 26);
$accent   = imagecolorallocate($img, 91,  92, 255);
$green    = imagecolorallocate($img, 0,  229, 160);
$white    = imagecolorallocate($img, 238,238, 248);
$gray     = imagecolorallocate($img, 136,136, 168);
$darkgray = imagecolorallocate($img, 68,  68,  90);
$yellow   = imagecolorallocate($img, 255,204,  68);
$dark2    = imagecolorallocate($img, 22,  22,  42);

// Background gradient (top to bottom)
for ($y = 0; $y < $h; $y++) {
    $ratio = $y / $h;
    $r = (int)(7  + (15 - 7)  * $ratio);
    $g = (int)(7  + (15 - 7)  * $ratio);
    $b = (int)(13 + (26 - 13) * $ratio);
    $c = imagecolorallocate($img, $r, $g, $b);
    imageline($img, 0, $y, $w, $y, $c);
}

// Subtle grid lines
$gridColor = imagecolorallocatealpha($img, 255, 255, 255, 120);
for ($gx = 200; $gx < $w; $gx += 200) imageline($img, $gx, 0, $gx, $h, $gridColor);
for ($gy = 105; $gy < $h; $gy += 105) imageline($img, 0, $gy, $w, $gy, $gridColor);

// Glow effect left (accent circle)
for ($r = 200; $r > 0; $r -= 5) {
    $alpha = (int)(127 - ($r / 200) * 20);
    $c = imagecolorallocatealpha($img, 91, 92, 255, min(127, $alpha + 110));
    imagearc($img, 160, 315, $r*2, $r*2, 0, 360, $c);
}

// Logo box (rounded rect approximation)
imagefilledrectangle($img, 80, 205, 148, 265, $accent);

// Logo text "PDFTash"
$font = 5; // built-in largest font
imagestring($img, $font, 168, 215, 'PDFTash', $white);

// Accent underline
imagefilledrectangle($img, 168, 240, 400, 244, $accent);

// Main headline
imagestring($img, 5, 80, 300, 'Free PDF Tools with AI', $white);
imagestring($img, 5, 80, 325, '  for Everyone', $white);

// Subheadline
imagestring($img, 3, 80, 380, 'Compress  Merge  Translate to Bengali  Chat  Sign', $gray);

// Pills
imagefilledrectangle($img, 80,  420, 220, 450, $dark2);
imagestring($img, 2, 95,  430, 'No signup needed', $accent);

imagefilledrectangle($img, 230, 420, 320, 450, $dark2);
imagestring($img, 2, 243, 430, '100% Free', $green);

imagefilledrectangle($img, 330, 420, 480, 450, $dark2);
imagestring($img, 2, 343, 430, 'Bengali Support', $yellow);

// Right side tool list box
imagefilledrectangle($img, 800, 150, 1120, 490, $dark2);
imagerectangle($img,       800, 150, 1120, 490, imagecolorallocate($img,40,40,80));

$tools = ['Compress PDF','Merge PDF','Split PDF','Translate PDF','Chat with PDF','Sign PDF','AI Summarizer'];
$ty = 170;
foreach ($tools as $i => $tool) {
    $dot = ($i % 2 === 0) ? $accent : $green;
    imagefilledellipse($img, 820, $ty + 7, 10, 10, $dot);
    imagestring($img, 3, 840, $ty, $tool, $white);
    $ty += 46;
    if ($ty < 490) imageline($img, 810, $ty - 8, 1110, $ty - 8, $darkgray);
}

// URL at bottom
imagestring($img, 2, 80, 590, 'pdftash.com', $darkgray);

// Save
$out = __DIR__ . '/public/og-image.png';
imagepng($img, $out, 9);
imagedestroy($img);

echo "og-image.png created at: $out\n";
echo "Size: " . round(filesize($out)/1024) . " KB\n";
