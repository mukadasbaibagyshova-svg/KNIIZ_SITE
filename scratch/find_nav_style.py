with open(r"C:\Users\Asylzat\Desktop\ssssssssss\htdocs\KNIIZ_SITE\assets\css\style.css", "r", encoding="utf-8") as f:
    lines = f.readlines()

for i, line in enumerate(lines):
    if "nav" in line or "header" in line or "menu" in line:
        print(f"Line {i+1}: {line.strip()}")
