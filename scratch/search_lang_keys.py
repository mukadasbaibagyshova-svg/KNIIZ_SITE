with open(r"c:\Users\Asylzat\Desktop\ssssssssss\htdocs\KNIIZ_SITE\includes\lang.php", "r", encoding="utf-8") as f:
    lines = f.readlines()

for i, line in enumerate(lines):
    if "structure_detail_sugarbeet" in line or "structure_detail_wheat" in line or "structure_detail_barley" in line:
        print(f"Line {i+1}: {line.strip()}")
