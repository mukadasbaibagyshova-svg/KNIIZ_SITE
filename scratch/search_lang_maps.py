with open(r"C:\Users\Asylzat\Desktop\ssssssssss\htdocs\KNIIZ_SITE\includes\lang.php", "r", encoding="utf-8") as f:
    lines = f.readlines()

for i, line in enumerate(lines):
    if "maps_title" in line:
        print(f"Line {i+1}: {line.strip()}")
