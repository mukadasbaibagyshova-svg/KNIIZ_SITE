with open(r"C:\Users\Asylzat\Desktop\ssssssssss\htdocs\KNIIZ_SITE\includes\lang.php", "r", encoding="utf-8") as f:
    lines = f.readlines()

for idx, line in enumerate(lines):
    if "naryn27" in line or "Нарын" in line or "katalog" in line or "сорт" in line:
        print(f"Line {idx+1}: {line.strip()}")
