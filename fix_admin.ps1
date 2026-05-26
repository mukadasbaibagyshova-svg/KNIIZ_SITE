$file = 'C:\Users\Asylzat\Desktop\ssssssssss\htdocs\KNIIZ_SITE\administration.php'
$lines = [System.IO.File]::ReadAllLines($file)
# Keep lines 1-25 (index 0-24) and lines 932+ (index 931+)
$header = $lines[0..24]
$footer = $lines[931..($lines.Length-1)]
$newLines = $header + $footer
[System.IO.File]::WriteAllLines($file, $newLines)
Write-Host "Done. Old: $($lines.Length) lines, New: $($newLines.Length) lines"
